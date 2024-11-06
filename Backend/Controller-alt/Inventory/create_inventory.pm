package Controller::Inventory::CreateInventory;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to create a new inventory item
post '/api/inventory/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input (add more validations based on your requirements)
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Prepare SQL and execute
    my $sth = $dbh->prepare("INSERT INTO inventory (name, description, quantity) VALUES (?, ?, ?)");  # Adjust columns as needed
    eval { $sth->execute($json->{name}, $json->{description}, $json->{quantity}) };
    if ($@) {
        return $c->render(json => { error => "Insert failed: $@" }, status => 500);
    }

    $c->render(json => { message => 'Inventory item successfully created' });
};

1;  # End of module
