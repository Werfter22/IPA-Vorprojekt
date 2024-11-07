package Controller::Devices::delete_devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;
use lib '../../Entity';  # sicherstellen, dass der Pfad stimmt
use Devices;
use Devices_images;

# Route to delete a device by ID
del '/devices/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Device ID missing' }, status => 400);
    }

    # Delete the device and the associated image via the API
    my ($device_success, $device_error) = delete_device_by_id($id);
    my ($image_success, $image_error) = delete_device_image_by_id($id);

    # Check if both deletions were successful
    if (!$device_success || !$image_success) {
        my $error_msg = $device_error || $image_error || 'Failed to delete device or image';
        return $c->render(json => { error => $error_msg }, status => 500);
    }

    # Respond with success message
    $c->render(json => { message => "Device $id and associated image successfully deleted" });
};

# Function to call the API to delete a device
sub delete_device_by_id {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/devices/$id";  # External API endpoint for deleting the device

    # Make a DELETE request to the API
    my $tx = $ua->delete($api_url);

    # Check if the request was successful
    if ($tx->result->is_success) {
        return (1, undef);
    } else {
        return (0, "API call failed for device: " . $tx->result->message);
    }
}

# Function to call the API to delete a device image
sub delete_device_image_by_id {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/Devices_images/$id";  # External API endpoint for deleting the image

    # Make a DELETE request to the API
    my $tx = $ua->delete($api_url);

    # Check if the request was successful
    if ($tx->result->is_success) {
        return (1, undef);
    } else {
        return (0, "API call failed for device image: " . $tx->result->message);
    }
}

1;
