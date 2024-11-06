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
use Apple_care;
use Device_images;
use Home_office;
use Inventar_device;
use Machine_inventar;
use User_device;
use User_phone;
use Workplace;

# Load OpenAPI (Swagger) specification
plugin OpenAPI => {url => 'swagger.yaml'};

# Database connection
my $dbh;
eval {
    $dbh = DBI->connect(
        "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
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

get '/api/:table_name' => {swagger => {operationId => 'getTableRecords'}} => sub {
    my $c = shift;
    my $table_name = $c->stash('table_name');

    app->log->debug("Fetching records for table: $table_name");

    # Ensure table exists
    my @all_tables = get_all_tables();
    unless (grep { $_ eq $table_name } @all_tables) {
        app->log->error("Invalid table name: $table_name");
        return $c->render(json => { error => 'Invalid table name' }, status => 400);
    }

    # Prepare SQL
    my $sth = eval { $dbh->prepare("SELECT * FROM " . $dbh->quote_identifier($table_name)) };
    if ($@ || !$sth) {
        app->log->error("Failed to prepare SQL for table $table_name: " . ($dbh->errstr || $@));
        return $c->render(json => { error => "Failed to prepare SQL" }, status => 500);
    }

    eval { $sth->execute() };
    if ($@) {
        app->log->error("Database execution error on fetching data for table $table_name: $@");
        return $c->render(json => { error => "Database error: $@" }, status => 500);
    }

    my @data;
    while (my $row = $sth->fetchrow_hashref) {
        push @data, $row;
    }

    $c->render(json => \@data);
};


# POST endpoint to add a new record to a table
post '/api/:table_name' => {swagger => {operationId => 'postTableRecord'}} => sub {
    my $c = shift;
    my $table_name = $c->stash('table_name');
    my $json = $c->req->json;

    # Check if table exists
    my @all_tables = get_all_tables();
    unless (grep { $_ eq $table_name } @all_tables) {
        return $c->render(json => { error => 'Invalid table name' }, status => 400);
    }

    # Ensure valid JSON input
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Prepare insert statement
    my $columns = join(", ", keys %$json);
    my $placeholders = join(", ", map { '?' } keys %$json);
    my $sth = eval { $dbh->prepare("INSERT INTO " . $dbh->quote_identifier($table_name) . " ($columns) VALUES ($placeholders)") };
    if ($@) {
        app->log->error("Insert preparation failed for table $table_name: $@");
        return $c->render(json => { error => "Insert preparation failed: $@" }, status => 500);
    }

    eval { $sth->execute(values %$json) };
    if ($@) {
        app->log->error("Database execution error on insert for table $table_name: $@");
        return $c->render(json => { error => "Database execution error: $@" }, status => 500);
    }

    $c->render(json => { message => 'Record successfully added' });
};


app->start;
