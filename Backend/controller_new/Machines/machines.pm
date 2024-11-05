package Controller::machines;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to the database

# Route to fetch and render all machines in a Mojolicious template
get '/machines' => sub {
    my $c = shift;

    # Fetch machines from the external database API
    my ($machines, $error_msg) = get_all_machines_from_api();

    # Check if machines were successfully fetched
    if (!$machines) {
        return $c->render(template => 'machines/error', error_msg => $error_msg || 'Failed to fetch machines');
    }

    # Render the machines template with the fetched data
    $c->render(template => 'machines/machines', machines => $machines);
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
