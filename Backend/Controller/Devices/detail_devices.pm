package Controller::Devices::detail_devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;
use lib '../../Entity';  # sicherstellen, dass der Pfad stimmt
use Devices;
use Devices_images;

# Route to display device details by ID
get '/devices/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Ensure id is provided
    unless ($id) {
        return $c->render(template => 'devices/error', error_msg => 'Device ID missing');
    }

    # Fetch device details and image from the API
    my $device = $c->get_device_details($id);
    my $device_image = $c->get_device_image($id);

    # Check if device details were fetched successfully
    unless ($device) {
        return $c->render(template => 'devices/error', error_msg => 'Device not found');
    }

    # Add image path to device data if available, else set a default placeholder
    $device->{image_path} = $device_image ? $device_image->{image_path} : 'path/to/default_image.jpg';

    # Render the device details in the template
    $c->render(template => 'devices/detail_devices', device => $device);
};

# Function to get device details from the database API
sub get_device_details {
    my ($c, $id) = @_;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices/$id";  # URL of the external API

    my $tx = $ua->get($db_api_url);

    # Check if the API call was successful
    if ($tx->result->is_success) {
        return $tx->result->json;
    } 

    return undef;  # Return undef if the request was unsuccessful
}

# Function to get device image from the database API
sub get_device_image {
    my ($c, $id) = @_;
    my $ua = Mojo::UserAgent->new;
    my $image_api_url = "http://127.0.0.1:3000/api/Devices_images/$id";  # URL for the device image API

    my $tx = $ua->get($image_api_url);

    # Check if the API call was successful
    if ($tx->result->is_success) {
        return $tx->result->json;
    } 

    return undef;  # Return undef if the request was unsuccessful
}

1;
