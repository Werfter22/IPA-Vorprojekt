package Controller::Phones::create_phones;

use Mojolicious::Lite;
use Mojo::UserAgent;  # Import UserAgent for making HTTP requests

# Function to create a new phone
post '/api/phones/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input (add more validations based on your requirements)
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Call the API to create the phone
    my $response = create_phone_via_api($json);
    
    # Check if the creation was successful
    unless ($response) {
        return $c->render(json => { error => 'Failed to create phone' }, status => 500);
    }

    $c->render(json => { message => 'Phone successfully created' });
};

# Function to create a new phone via the database API
sub create_phone_via_api {
    my $json = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/phones";  # Ensure this is the correct URL

    my $tx = $ua->post($db_api_url => json => $json);
    
    # Check if the response is successful
    if ($tx->result->is_success) {
        return 1;  # Return true if creation was successful
    }
    return undef;  # Return undef if the request was not successful
}

1;  # End of module
