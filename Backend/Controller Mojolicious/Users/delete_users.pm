package Controller::Users::delete_users;

use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to delete the user

# Function to delete a user by ID
del '/api/users/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'User ID missing' }, status => 400);
    }

    # Call the external API to delete the user
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/users/delete/$id";  # URL to your external API

    my $tx = $ua->delete($db_api_url);

    # Check if the request was successful
    if ($tx->result->is_success) {
        $c->render(json => { message => "User $id successfully deleted" });
    } else {
        $c->render(json => { error => "Delete failed: " . $tx->result->message }, status => 500);
    }
};

1;  # End of module
