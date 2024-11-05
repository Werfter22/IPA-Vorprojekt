package Controller::Devices::detail_devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;

# Route to display device details by ID
get '/devices/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Ensure id is provided
    unless ($id) {
        return $c->render(template => 'devices/error', error_msg => 'Device ID missing');
    }

    # Fetch device details from the API
    my $device = get_device_details($id);

    # Check if device details were fetched successfully
    unless ($device) {
        return $c->render(template => 'devices/error', error_msg => 'Device not found');
    }

    # Render the device details in the template
    $c->render(template => 'devices/detail_devices', device => $device);
};

# Function to get device details from the database API
sub get_device_details {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices/$id";  # URL of the external API

    my $tx = $ua->get($db_api_url);

    # Check if the API call was successful
    if ($tx->result->is_success) {
        return $tx->result->json;
    } 

    return undef;  # Return undef if the request was unsuccessful
}

1;
