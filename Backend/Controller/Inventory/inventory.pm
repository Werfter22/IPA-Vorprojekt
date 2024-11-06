package Controller::inventory;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;

# Route to display all inventory items in a frontend template
get '/inventory' => sub {
    my $c = shift;

    # Fetch inventory items from the external database API
    my ($inventory_items, $error_msg) = get_all_inventory_from_api();

    # Check if items were successfully fetched
    if (!$inventory_items) {
        return $c->render(template => 'inventory/error', error_msg => $error_msg || 'Failed to fetch inventory items');
    }

    # Render the inventory template with the fetched data
    $c->render(template => 'inventory/inventory', inventory_items => $inventory_items);
};

# Method to fetch all inventory items via the API
sub get_all_inventory_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/inventar_liste_original";  # URL of your database API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;  # End of the module
