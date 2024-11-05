package Controller::Users::detail_users;

use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to fetch user data

# Function to get details of a specific user and render the detail view
get '/users/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(text => 'User ID missing', status => 400);
    }

    # Fetch user details from the external API
    my ($user, $error_msg) = get_user_details_from_api($id);

    # Check if user details were successfully fetched
    if (!$user) {
        return $c->render(text => $error_msg || 'Failed to fetch user details', status => 500);
    }

    # Render the detail user template with the fetched data
    $c->render(template => 'detail_users', user => $user);
};

# Method to fetch user details via the API
sub get_user_details_from_api {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/users/detail/$id";  # Adjust to your API endpoint

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);  # Successful response
    } else {
        return (undef, "API call failed: " . $tx->result->message);  # Return error message
    }
}

1;  # End of module
