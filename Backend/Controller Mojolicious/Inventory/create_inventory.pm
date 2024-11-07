package Controller::Inventory::create_inventory;

use Mojolicious::Lite;
use Mojo::UserAgent;

# Route to create a new inventory item via the external API
post '/inventory/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(template => 'inventory/error', error_msg => 'Invalid JSON input');
    }

    # Call helper function to create the inventory item via the API
    my ($success, $error_msg) = create_inventory_item($json);

    # Render confirmation or error template based on the result
    if ($success) {
        $c->render(template => 'inventory/create_inventory', item => $json);
    } else {
        $c->render(template => 'inventory/error', error_msg => $error_msg || 'Failed to create inventory item');
    }
};

# Helper function to create an inventory item through the external API
sub create_inventory_item {
    my $item_data = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = 'http://127.0.0.1:3000/api/inventory';  # External API endpoint for creating inventory items

    # Send a POST request to the external API with the item data
    my $tx = $ua->post($db_api_url => json => $item_data);

    if ($tx->result->is_success) {
        return (1, undef);  # Success
    } else {
        return (undef, "API call failed: " . $tx->result->message);  # Failure and error message
    }
}

1;  # End of module
