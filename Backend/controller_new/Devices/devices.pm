package Controller::devices;

use strict;
use warnings;
use Mojo::Base 'Mojolicious::Controller';
use Mojo::UserAgent;

# Route to display all devices in the frontend
get '/devices' => sub {
    my $c = shift;

    # Fetch devices from the external API
    my ($devices, $error_msg) = get_all_devices_from_api();

    # Check if devices were successfully fetched
    if (!$devices) {
        # Render an error template or pass an error message
        return $c->render(template => 'devices/error', error_msg => $error_msg || 'Failed to fetch devices');
    }

    # Render devices template with the fetched data
    $c->render(template => 'devices/device', devices => $devices);
};

# Method to fetch all devices via the API
sub get_all_devices_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices";  # URL of your database API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;
