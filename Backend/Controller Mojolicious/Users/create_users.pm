package Controller::Users::create_users;

use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to create the user

# Function to create a new user
post '/api/users/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input (add more validations based on your requirements)
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Create a user via the external API
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/users/create";  # URL to your external API

    # Send POST request to the external API
    my $tx = $ua->post($db_api_url => json => {
        name => $json->{name},
        email => $json->{email},
        role => $json->{role},
    });

    # Check if the request was successful
    if ($tx->result->is_success) {
        $c->render(json => { message => 'User successfully created' });
    } else {
        $c->render(json => { error => "Create failed: " . $tx->result->message }, status => 500);
    }
};

1;  # End of module
