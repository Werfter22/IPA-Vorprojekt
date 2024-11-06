package Controller::Machines;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to the database
use DBI;

# Route to fetch all machines from the database API
get '/api/machines' => sub {
    my $c = shift;

    # Fetch machines from the external database API
    my ($machines, $error_msg) = get_all_machines_from_api();

    # Check if machines were successfully fetched
    if (!$machines) {
        return $c->render(json => { error => $error_msg || 'Failed to fetch machines' }, status => 500);
    }

    # Render response as JSON
    $c->render(json => $machines);
};

# Method to fetch all machines via the API
sub get_all_machines_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/machine_list";  # URL of your database API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;  # End of the module
