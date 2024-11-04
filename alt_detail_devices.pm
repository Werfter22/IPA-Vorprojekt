package Controller::Devices::DetailDevices;

use Mojolicious::Lite;
use Mojo::UserAgent;

# Function to get details of a specific device
get '/api/devices/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

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

    # Prepare frontend data
    my $frontend_data = prepare_frontend_data($device);

    # Send data to the frontend API
    my $frontend_api_url = "http://127.0.0.1:8081/api/devices/$frontend_data->{Device_ID}";  
    my $frontend_response = send_to_frontend($frontend_api_url, $frontend_data);

    # Check if the frontend request was successful
    if ($frontend_response) {
        $c->render(json => $frontend_data);  # Render the response as JSON
    } else {
        $c->render(json => { error => 'Failed to send data to frontend API' }, status => 500);
    }
};

# Function to get device details from the database API
sub get_device_details {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices/$id";  

    my $tx = $ua->get($db_api_url);

    return $tx->result->is_success ? $tx->result->json : undef;
}

# Function to prepare frontend data
sub prepare_frontend_data {
    my $device = shift;
    my %frontend_data;

    # Assign Device_ID, QR_Code, and Barcode separately
    $frontend_data{Device_ID} = $device->{device_id};
    $frontend_data{QR_Code} = $device->{qr_code};
    $frontend_data{Barcode} = $device->{barcode};

    # Define arrays for prefixes and loop through to fill in the data
    my @prefixes = ('Device_Name', 'Serialnumber', 'OS', 'IS_Werft_Device', 'IS_Private_Device');
    for my $prefix (@prefixes) {
        for my $i (1..12) {
            my $key = lc($prefix) . "_$i";  # Create key based on prefix and index
            $frontend_data{"${prefix}_$i"} = $device->{$key};
        }
    }

    return \%frontend_data;
}

# Function to send data to the frontend API
sub send_to_frontend {
    my ($url, $data) = @_;
    my $ua = Mojo::UserAgent->new;

    my $tx_frontend = $ua->post($url => json => $data);
    
    unless ($tx_frontend->result->is_success) {
        warn "Error sending to frontend: " . $tx_frontend->result->message;
    }

    return $tx_frontend->result->is_success;
}

1;  # End of module