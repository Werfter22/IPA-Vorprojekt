package Controller::Devices::edit_devices;

use Mojolicious::Lite;
use Mojo::UserAgent;

# Endpoint to display the edit form for a specific device
get '/devices/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Fetch device details from the external API
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/devices/$id";  # External API endpoint for device details
    my $response = $ua->get($api_url)->result;

    # Handle API response
    if ($response->is_success) {
        my $device = $response->json;
        return $c->render(template => 'devices/edit_devices', device => $device);
    } else {
        return $c->render(template => 'devices/error', error_msg => 'Failed to fetch device data');
    }
};

# Route to handle form submission and send the updated data to the API
post '/devices/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;  # Data received from form submission

    # Prepare API request to update device
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/devices/edit/$id";
    my $response = $ua->put($api_url => json => $json)->result;

    # Handle response from API
    if ($response->is_success) {
        return $c->redirect_to('/devices');  # Redirect to devices list on success
    } else {
        return $c->render(template => 'devices/edit', device => $json, error_msg => 'Failed to update device');
    }
};

1;
