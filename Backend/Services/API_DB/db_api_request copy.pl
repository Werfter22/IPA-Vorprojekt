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

# Datenbankverbindung
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
    
    # Prepare the SQL statement to get table names from the public schema
    my $sth = $dbh->prepare(
        "SELECT table_name 
         FROM information_schema.tables 
         WHERE table_schema = 'public'"
    );
    
    # Execute the query
    $sth->execute();
    
    # Fetch all table names
    while (my @row = $sth->fetchrow_array) {
        push @tables, $row[0];
    }

    return @tables;
}

# Whitelisted tables
my @allowed_tables = qw(devices home_office inventar_device inventar_liste_original machine_inventar machine_list phones user_device user_phone users workplace);

# Helper function to check if table is allowed
sub is_allowed_table {
    my $table = shift;
    return grep { $_ eq $table } @allowed_tables;
}

# Allow CORS (Cross-Origin Resource Sharing)
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

# GET-Endpunkt, um alle Datensätze aus einer beliebigen Tabelle abzurufen
get '/api/:table_name' => sub {
    my $c = shift;
    my $table_name = $c->stash('table_name');

    # Dynamically check if the table exists in the PostgreSQL public schema
    my @all_tables = get_all_tables();
    unless (grep { $_ eq $table_name } @all_tables) {
        return $c->render(json => { error => 'Invalid table name' }, status => 400);
    }

    # Prepare SQL statement to select all from the table
    my $sth = eval { $dbh->prepare("SELECT * FROM " . $dbh->quote_identifier($table_name)) };
    if ($@) {
        return $c->render(json => { error => "Failed to prepare SQL: $@" }, status => 500);
    }

    eval { $sth->execute() };
    if ($@) {
        return $c->render(json => { error => "Database error: $@" }, status => 500);
    }

    my @data;
    while (my $row = $sth->fetchrow_hashref) {
        push @data, $row;
    }

    $c->render(json => \@data);
};

# POST-Endpunkt, um einen neuen Datensatz zur angegebenen Tabelle hinzuzufügen
post '/api/:table_name' => sub {
    my $c = shift;
    my $table_name = $c->stash('table_name');
    my $json = $c->req->json;

    # Dynamically check if the table exists
    my @all_tables = get_all_tables();
    unless (grep { $_ eq $table_name } @all_tables) {
        return $c->render(json => { error => 'Invalid table name' }, status => 400);
    }

    # Ensure valid JSON input
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Validate that input columns match the table schema (optional but recommended)
    my $columns = join(", ", keys %$json);
    my $placeholders = join(", ", map { '?' } keys %$json);

    # Prepared statement for insert
    my $sth = eval { $dbh->prepare("INSERT INTO " . $dbh->quote_identifier($table_name) . " ($columns) VALUES ($placeholders)") };
    if ($@) {
        return $c->render(json => { error => "Insert failed: $@" }, status => 500);
    }

    eval { $sth->execute(values %$json) };
    if ($@) {
        return $c->render(json => { error => "Database error: $@" }, status => 500);
    }

    $c->render(json => { message => 'Datensatz erfolgreich hinzugefügt' });
};

# Server starten
app->start;
