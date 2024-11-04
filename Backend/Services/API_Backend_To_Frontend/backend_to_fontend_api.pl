package Services::API_Backend_To_Frontend::backend_to_frontend_api;

use Mojolicious::Lite;
use DBI;
use lib 'C:/xampp/htdocs/Web_Project_Vorprojekt_IPA/Backend';  # Correct path

use Entity::Devices;
use Entity::Users;
use Entity::Machines;
use Entity::Inventory;
use Entity::Phones;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Helper function to fetch data and convert to entities
sub fetch_entities {
    my ($query, $entity_class) = @_;
    my $sth = $dbh->prepare($query);
    $sth->execute();
    
    my @entities;
    while (my $row = $sth->fetchrow_hashref) {
        push @entities, $entity_class->new(%$row);  # Correct entity class
    }
    return @entities;
}

# General endpoint for fetching devices
get '/api/devices' => sub {
    my $c = shift;
    my @devices = fetch_entities("SELECT * FROM devices", 'Entity::Devices');  # Correct entity class
    my @device_hashes = map { $_->to_hash() } @devices;
    $c->render(json => \@device_hashes);
};

# General endpoint for fetching users
get '/api/users' => sub {
    my $c = shift;
    my @users = fetch_entities("SELECT * FROM users", 'Entity::Users');  # Correct entity class
    my @user_hashes = map { $_->to_hash() } @users;
    $c->render(json => \@user_hashes);
};

# General endpoint for fetching machines
get '/api/machines' => sub {
    my $c = shift;
    my @machines = fetch_entities("SELECT * FROM machines", 'Entity::Machines');  # Correct entity class
    my @machine_hashes = map { $_->to_hash() } @machines;
    $c->render(json => \@machine_hashes);
};

# General endpoint for fetching inventory items
get '/api/inventory' => sub {
    my $c = shift;
    my @inventory_items = fetch_entities("SELECT * FROM inventory", 'Entity::Inventory');  # Correct entity class
    my @inventory_hashes = map { $_->to_hash() } @inventory_items;
    $c->render(json => \@inventory_hashes);
};

# General endpoint for fetching phones
get '/api/phones' => sub {
    my $c = shift;
    my @phones = fetch_entities("SELECT * FROM phones", 'Entity::Phones');  # Correct entity class
    my @phone_hashes = map { $_->to_hash() } @phones;
    $c->render(json => \@phone_hashes);
};

# Start the application on the specified port
app->start('daemon' => '-l', 'http://*:8081');  # Frontend API

1;  # End of module
