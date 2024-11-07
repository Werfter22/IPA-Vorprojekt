package Controller::devices;

use strict;
use warnings;
use Mojo::Base 'Mojolicious::Controller';
use Mojo::UserAgent;
use lib '../../Entity';  # sicherstellen, dass der Pfad stimmt
use Devices;
use Devices_images;

# Route to display all devices with images in the frontend
get '/devices' => sub {
    my $c = shift;

    # Fetch devices and device images from the external API
    my ($devices, $device_error) = get_all_devices_from_api();
    my ($device_images, $image_error) = get_all_device_images_from_api();

    # Handle errors
    if (!$devices || !$device_images) {
        my $error_msg = $device_error || $image_error || 'Failed to fetch data';
        return $c->render(template => 'devices/error', error_msg => $error_msg);
    }

    # Combine devices with their images
    my %images_by_device = map { $_->{device_id} => $_->{image_path} } @$device_images;
    foreach my $device (@$devices) {
        $device->{image_path} = $images_by_device{$device->{id}} // 'default_image_path.jpg';
    }

    # Render devices template with combined data
    $c->render(template => 'devices/device', devices => $devices);
};

# Method to fetch all devices via the API
sub get_all_devices_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices";

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

# Method to fetch all device images via the API
sub get_all_device_images_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/Devices_images";

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;
