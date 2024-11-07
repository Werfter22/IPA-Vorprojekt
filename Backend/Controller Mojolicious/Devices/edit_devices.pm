package Controller::Devices::edit_devices;

use Mojolicious::Lite;
use Mojo::UserAgent;
use lib '../../Entity';  # sicherstellen, dass der Pfad stimmt
use Devices;
use Devices_images;

# Endpoint to display the edit form for a specific device
get '/devices/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Fetch device details from the external API
    my $ua = Mojo::UserAgent->new;
    my $device_api_url = "http://127.0.0.1:3000/api/devices/$id";
    my $image_api_url = "http://127.0.0.1:3000/api/Devices_images/$id";  # Assuming image data by device ID
    my $device_response = $ua->get($device_api_url)->result;
    my $image_response = $ua->get($image_api_url)->result;

    # Handle API response for both device and image data
    if ($device_response->is_success && $image_response->is_success) {
        my $device = $device_response->json;
        my $device_image = $image_response->json;  # Assuming it returns one image record for the device
        $device->{image_path} = $device_image->{image_path};  # Add image path to device data

        return $c->render(template => 'devices/edit_devices', device => $device);
    } else {
        return $c->render(template => 'devices/error', error_msg => 'Failed to fetch device or image data');
    }
};

# Route to handle form submission and send the updated data to the API
post '/devices/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;  # Data received from form submission

    # Prepare API request to update device
    my $ua = Mojo::UserAgent->new;
    my $device_api_url = "http://127.0.0.1:3000/api/devices/edit/$id";
    my $image_api_url = "http://127.0.0.1:3000/api/Devices_images/edit/$id";  # Endpoint for updating image

    # Split data if image path is included, to update separately
    my $device_data = { %$json };
    my $image_data;
    if (exists $device_data->{image_path}) {
        $image_data = { image_path => delete $device_data->{image_path} };
    }

    # Update device data
    my $device_response = $ua->put($device_api_url => json => $device_data)->result;
    if (!$device_response->is_success) {
        return $c->render(template => 'devices/edit', device => $json, error_msg => 'Failed to update device');
    }

    # Update image data if present
    if ($image_data) {
        my $image_response = $ua->put($image_api_url => json => $image_data)->result;
        if (!$image_response->is_success) {
            return $c->render(template => 'devices/edit', device => $json, error_msg => 'Failed to update image');
        }
    }

    # Redirect to devices list on success
    return $c->redirect_to('/devices');
};

1;
