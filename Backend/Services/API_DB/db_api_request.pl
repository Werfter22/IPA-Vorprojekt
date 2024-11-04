#!/usr/bin/env perl
use Mojolicious::Lite;
use DBI;
use SQL::Abstract;
use JSON;

# Add the path to the Entity directory
use lib 'C:/xampp/htdocs/Web_Project_Vorprojekt_IPA/Backend/Entity';

use Devices;
use Users;
use Machines;
use Inventory;
use Phones;

# Load OpenAPI (Swagger) specification
plugin OpenAPI => {url => 'swagger.yaml'};

# Database connection
my $dbh;
eval {
    $dbh = DBI->connect(
        "dbi:Pg:dbname=neue_datenbank_angaben_werft;
        host=localhost;
        port=5432", 
        "postgres", 
        "Findus-7", 
        { RaiseError => 1, PrintError => 0 }
    );
};
if ($@) {
    die "Failed to connect to the database: $@";
}

# Define the function get_all_tables
sub get_all_tables {
    my @tables;
    my $sth = $dbh->prepare(
        "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'"
    );
    $sth->execute();
    while (my @row = $sth->fetchrow_array) {
        push @tables, $row[0];
    }
    return @tables;
}

# Allow CORS
hook before_dispatch => sub {
    my $c = shift;
    $c->res->headers->header('Access-Control-Allow-Origin' => '*');
    $c->res->headers->header('Access-Control-Allow-Methods' => 'GET, POST, OPTIONS');
    $c->res->headers->header('Access-Control-Allow-Headers' => 'Content-Type');
    if ($c->req->method eq 'OPTIONS') {
        $c->render(text => '', status => 200);
        return;
    }
};

# GET endpoint to fetch all records from a table
get '/api/:table_name' => {swagger => {operationId => 'getTable'}} => sub {
    my $c = shift;
    my $table_name = $c->stash('table_name');

    # Check if the table exists
    my @all_tables = get_all_tables();
    unless (grep { $_ eq $table_name } @all_tables) {
        return $c->render(openapi => { error => 'Invalid table name' }, status => 400);
    }

    # Prepare SQL statement
    my $sth = eval { $dbh->prepare("SELECT * FROM " . $dbh->quote_identifier($table_name)) };
    if ($@) {
        return $c->render(openapi => { error => "Failed to prepare SQL: $@" }, status => 500);
    }

    eval { $sth->execute() };
    if ($@) {
        return $c->render(openapi => { error => "Database error: $@" }, status => 500);
    }

    my @data;
    while (my $row = $sth->fetchrow_hashref) {
        push @data, $row;
    }

    $c->render(openapi => \@data);
};

# POST endpoint to add a new record to a table
post '/api/:table_name' => {swagger => {operationId => 'postTable'}} => sub {
    my $c = shift;
    my $table_name = $c->stash('table_name');
    my $json = $c->req->json;

    # Check if table exists
    my @all_tables = get_all_tables();
    unless (grep { $_ eq $table_name } @all_tables) {
        return $c->render(openapi => { error => 'Invalid table name' }, status => 400);
    }

    # Ensure valid JSON input
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(openapi => { error => 'Invalid JSON input' }, status => 400);
    }

    # Prepare insert statement
    my $columns = join(", ", keys %$json);
    my $placeholders = join(", ", map { '?' } keys %$json);
    my $sth = eval { $dbh->prepare("INSERT INTO " . $dbh->quote_identifier($table_name) . " ($columns) VALUES ($placeholders)") };
    if ($@) {
        return $c->render(openapi => { error => "Insert failed: $@" }, status => 500);
    }

    eval { $sth->execute(values %$json) };
    if ($@) {
        return $c->render(openapi => { error => "Database error: $@" }, status => 500);
    }

    $c->render(openapi => { message => 'Datensatz erfolgreich hinzugefügt' });
};

app->start;
