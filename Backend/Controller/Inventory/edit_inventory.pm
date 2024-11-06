package Controller::Inventory::edit_inventory;

use Mojolicious::Lite;
use Mojo::UserAgent;

# Route to show the edit form for an inventory item
get '/inventory/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    
    # Fetch the item details from the API
    my ($inventory_item, $error_msg) = get_inventory_item_from_api($id);

    # Render the edit form with the item details or an error message
    if ($inventory_item) {
        $c->render(template => 'inventory/edit_inventory', item => $inventory_item);
    } else {
        $c->render(template => 'inventory/error', error_msg => $error_msg || 'Failed to fetch inventory item');
    }
};

# Route to update an inventory item
put '/api/inventory/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;

    # Validate input
    unless ($id && $json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid input' }, status => 400);
    }

    # Send the update request to the external API
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/inventory/edit/$id";

    my $tx = $ua->put($db_api_url => json => $json);

    if ($tx->result->is_success) {
        $c->render(json => { message => 'Inventory item successfully updated' });
    } else {
        $c->render(json => { error => "Update failed: " . $tx->result->message }, status => 500);
    }
};

# Helper function to fetch inventory item details from the API
sub get_inventory_item_from_api {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/inventory/$id";

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;  # End of module
