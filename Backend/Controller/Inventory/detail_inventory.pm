package Controller::Inventory::DetailInventory;

use Mojolicious::Lite;
use DBI;
use Mojo::UserAgent;  # Import UserAgent for making HTTP requests

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to get details of a specific inventory item
get '/api/inventory/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Inventory ID missing' }, status => 400);
    }

    # Execute SQL query to retrieve inventory item details
    my $sth = $dbh->prepare("SELECT name, description, quantity FROM inventory WHERE id = ?");  # Adjust columns as needed
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(json => { error => "Fetch failed: $@" }, status => 500);
    }

    my $inventory_item = $sth->fetchrow_hashref;
    
    if ($inventory_item) {
        # Send data to the frontend API
        my $ua = Mojo::UserAgent->new;
        my $frontend_api_url = 'http://127.0.0.1:8081/api/inventory';  # Replace with the correct API endpoint

        # Post the inventory item data to the frontend API
        my $tx = $ua->post($frontend_api_url => json => $inventory_item);

        # Check if the request was successful
        if ($tx->result->is_success) {
            $c->render(json => $inventory_item);  # Render the response as JSON
        } else {
            $c->render(json => { error => 'Failed to send data to frontend API' }, status => 500);
        }
    } else {
        $c->render(json => { error => "Inventory item not found" }, status => 404);
    }
};

1;  # End of module
