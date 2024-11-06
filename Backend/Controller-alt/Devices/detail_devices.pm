package Controller::Devices::DetailDevices;

use Mojolicious::Lite;

# Function to get details of a specific device
get '/api/devices/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    # Ensure id is being captured correctly
    warn "Received ID: $id";
    
    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Device ID missing' }, status => 400);
    }

    # Call the API to get device details
    my $device = get_device_details($id);
    
    # Check if the device was found
    unless ($device) {
        return $c->render(json => { error => 'Device not found' }, status => 404);
    }

    # Send device data directly as JSON
    $c->render(json => $device);
};

# Function to get device details from the database API
sub get_device_details {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices/$id";  # Ensure this is the correct URL

    my $tx = $ua->get($db_api_url);
    
    # Check if the response is successful
    if ($tx->result->is_success) {
        my $devices = $tx->result->json;

        # Return the first device if the array is not empty
        return @$devices ? $devices->[0] : undef;
    } 
    return undef;  # Return undef if the request was not successful
}

1;