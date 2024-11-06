package Controller::Phones::DeletePhones;

use Mojolicious::Lite;
use Mojo::UserAgent;  # Import UserAgent for making HTTP requests

# Function to delete a phone by ID
del '/api/phones/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Phone ID missing' }, status => 400);
    }

    # Call the API to delete the phone
    my $response = delete_phone_from_api($id);
    
    # Check if the delete operation was successful
    unless ($response) {
        return $c->render(json => { error => 'Failed to delete phone' }, status => 500);
    }

    # Render success message
    $c->render(json => { message => "Phone $id successfully deleted" });
};

# Function to delete a phone from the database API
sub delete_phone_from_api {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/phones/delete/$id";  # Ensure this is the correct URL

    my $tx = $ua->delete($db_api_url);
    
    # Check if the response is successful
    if ($tx->result->is_success) {
        return 1;  # Return true if deletion was successful
    }
    return undef;  # Return undef if the request was not successful
}

1;  # End of module
