package Controller::users;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to the database

# Route to fetch all users and render to the template
get '/users' => sub {
    my $c = shift;

    # Fetch users from the external database API
    my ($users, $error_msg) = get_all_users_from_api();

    # Check if users were successfully fetched
    if (!$users) {
        return $c->render(text => $error_msg || 'Failed to fetch users', status => 500);
    }

    # Render the users template with the fetched data
    $c->render(template => 'users', users => $users);
};

# Method to fetch all users via the API
sub get_all_users_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/users";  # URL of your database API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;  # End of the module
