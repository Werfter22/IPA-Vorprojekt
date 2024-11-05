package Controller::Devices::create_devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;

# Route to create a new device
post '/devices/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input (basic check for JSON data)
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Send data to the external API
    my ($success, $error_msg) = create_device_via_api($json);

    # Check if creation was successful
    if (!$success) {
        return $c->render(json => { error => $error_msg || 'Failed to create device' }, status => 500);
    }

    # Respond with success message
    $c->render(json => { message => 'Device successfully created' });
};

# Function to send the new device data to the external API
sub create_device_via_api {
    my $device_data = shift;
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/devices";  # API endpoint for device creation

    # Make a POST request with device data
    my $tx = $ua->post($api_url => json => $device_data);

    # Check if the request was successful
    if ($tx->result->is_success) {
        return (1, undef);
    } else {
        return (0, "API call failed: " . $tx->result->message);
    }
}

1;
