package Controller::Inventory;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to the database

# Route to fetch all inventory items from the database API
get '/api/inventar_liste_original' => sub {
    my $c = shift;

    # Fetch inventory items from the external database API
    my ($inventory_items, $error_msg) = get_all_inventory_from_api();

    # Check if items were successfully fetched
    if (!$inventory_items) {
        return $c->render(json => { error => $error_msg || 'Failed to fetch inventory items' }, status => 500);
    }

    # Render response as JSON
    $c->render(json => $inventory_items);
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
