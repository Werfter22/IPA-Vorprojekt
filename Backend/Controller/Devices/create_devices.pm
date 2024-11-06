package Controller::Devices::create_devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;
use lib '../../Entity';  # sicherstellen, dass der Pfad stimmt
use Devices;
use Devices_images;

# Route to create a new device
post '/devices/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input (basic check for JSON data)
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Separate device and image data
    my $device_data = { %$json };
    my $image_data;
    if (exists $device_data->{image_path}) {
        $image_data = { image_path => delete $device_data->{image_path} };
    }

    # Send device data to the external API
    my ($device_success, $device_error) = create_device_via_api($device_data);

    # Check if device creation was successful
    unless ($device_success) {
        return $c->render(json => { error => $device_error || 'Failed to create device' }, status => 500);
    }

    # If image data exists, send it to the image API
    if ($image_data) {
        my ($image_success, $image_error) = create_device_image_via_api($image_data);

        # Check if image creation was successful
        unless ($image_success) {
            return $c->render(json => { error => $image_error || 'Failed to create device image' }, status => 500);
        }
    }

    # Respond with success message
    $c->render(json => { message => 'Device and image successfully created' });
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
        return (0, "API call failed for device: " . $tx->result->message);
    }
}

# Function to send the new image data to the external API
sub create_device_image_via_api {
    my $image_data = shift;
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/Devices_images";  # API endpoint for device image creation

    # Make a POST request with image data
    my $tx = $ua->post($api_url => json => $image_data);

    # Check if the request was successful
    if ($tx->result->is_success) {
        return (1, undef);
    } else {
        return (0, "API call failed for device image: " . $tx->result->message);
    }
}

1;
