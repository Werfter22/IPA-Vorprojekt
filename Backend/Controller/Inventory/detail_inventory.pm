package Controller::Inventory::detail_inventory;

use Mojolicious::Lite;
use Mojo::UserAgent;

# Function to get details of a specific inventory item and render it in a template
get '/inventory/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(template => 'inventory/error', error_msg => 'Inventory ID missing');
    }

    # Fetch item details from the API
    my ($inventory_item, $error_msg) = get_inventory_item_from_api($id);

    # Check if the item was found, render the detail view or an error page
    if ($inventory_item) {
        $c->render(template => 'inventory/detail_inventory', item => $inventory_item);
    } else {
        $c->render(template => 'inventory/error', error_msg => $error_msg || 'Inventory item not found');
    }
};

# Helper function to get inventory item details from an external API
sub get_inventory_item_from_api {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/inventory/$id";  # Update with the correct URL

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;  # End of module
