package Controller::Phones::detail_phones;

use Mojolicious::Lite;
use Mojo::UserAgent;  # Import UserAgent for making HTTP requests

# Function to get details of a specific phone
get '/api/phones/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Phone ID missing' }, status => 400);
    }

    # Call the API to get phone details
    my $phone = get_phone_details($id);
    
    # Check if the phone was found
    unless ($phone) {
        return $c->render(json => { error => 'Phone not found' }, status => 404);
    }

    # Render the phone details in the appropriate Mojolicious template
    $c->render(template => 'phones/detail_phones', phone => $phone);
};

# Function to get phone details from the database API
sub get_phone_details {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/phones/$id";  # Ensure this is the correct URL

    my $tx = $ua->get($db_api_url);
    
    # Check if the response is successful
    if ($tx->result->is_success) {
        return $tx->result->json;  # Return the phone details as a hashref
    } 
    return undef;  # Return undef if the request was not successful
}

1;  # End of module
