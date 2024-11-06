package Controller::Users::edit_users;

use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to fetch user data

# Function to get user details by ID and render the edit form
get '/users/edit/:id' => sub {
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

    # Render the edit user template with the fetched data
    $c->render(template => 'edit_users', user => $user);
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

# Function to update a user by ID
put '/api/users/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;

    # Validate input
    unless ($id) {
        return $c->render(json => { error => 'User ID missing' }, status => 400);
    }

    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Construct SQL query for updating the user
    my $sql = "UPDATE users SET " . join(", ", map { "$_ = ?" } keys %$json) . " WHERE id = ?";
    my @values = (values %$json, $id);

    my $dbh = DBI->connect(
        "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
        "postgres", 
        "Findus-7", 
        { RaiseError => 1, PrintError => 0 }
    );

    my $sth = $dbh->prepare($sql);
    eval { $sth->execute(@values) };
    if ($@) {
        return $c->render(json => { error => "Update failed: $@" }, status => 500);
    }

    $c->render(json => { message => 'User successfully updated' });
};

1;  # End of module
