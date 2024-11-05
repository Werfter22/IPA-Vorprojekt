package Controller::Devices::delete_devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;

# Route to delete a device by ID
del '/devices/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Device ID missing' }, status => 400);
    }

    # Delete the device via the API
    my ($success, $error_msg) = delete_device_by_id($id);

    # Check if deletion was successful
    if (!$success) {
        return $c->render(json => { error => $error_msg || 'Failed to delete device' }, status => 500);
    }

    # Respond with success message
    $c->render(json => { message => "Device $id successfully deleted" });
};

# Function to call the API to delete a device
sub delete_device_by_id {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/devices/$id";  # External API endpoint

    # Make a DELETE request to the API
    my $tx = $ua->delete($api_url);

    # Check if the request was successful
    if ($tx->result->is_success) {
        return (1, undef);
    } else {
        return (0, "API call failed: " . $tx->result->message);
    }
}

1;
