package Controller::Inventory::DeleteInventory;

use Mojolicious::Lite;
use Mojo::UserAgent;

# Function to delete an inventory item by ID using an external API
del '/inventory/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(template => 'inventory/error', error_msg => 'Inventory ID missing');
    }

    # Delete the inventory item via the API
    my ($success, $error_msg) = delete_inventory_item($id);

    # Check if deletion was successful, render confirmation or error template
    if ($success) {
        $c->render(template => 'inventory/delete_inventory', id => $id);
    } else {
        $c->render(template => 'inventory/error', error_msg => $error_msg || "Failed to delete inventory item $id");
    }
};

# Helper function to delete an inventory item from the external database API
sub delete_inventory_item {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/inventory/$id";  # API endpoint for delete action

    my $tx = $ua->delete($db_api_url);

    if ($tx->result->is_success) {
        return (1, undef);  # Return success
    } else {
        return (undef, "API call failed: " . $tx->result->message);  # Return failure and error message
    }
}

1;  # End of module
