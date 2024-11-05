package Controller::Phones::EditPhones;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to fetch phone details
use DBI;

# Function to fetch a phone by ID from the API
get '/phones/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(template => 'phones/error', error_msg => 'Phone ID missing');
    }

    # Fetch phone details from the API
    my ($phone, $error_msg) = get_phone_details_from_api($id);

    # Check if the phone was found
    if (!$phone) {
        return $c->render(template => 'phones/error', error_msg => $error_msg || 'Phone not found');
    }

    # Render the phone details in the edit template
    $c->render(template => 'phones/edit_phones', phone => $phone);
};

# Method to fetch a phone's details via the API
sub get_phone_details_from_api {
    my $id = shift;
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/phones/detail/$id";  # Ensure this is the correct URL

    my $tx = $ua->get($api_url);

    if ($tx->result->is_success) {
        return ($tx->result->json, undef);  # Return successful response
    } else {
        return (undef, "API call failed: " . $tx->result->message);  # Return error message
    }
}

# Function to update a phone by ID
put '/api/phones/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;

    # Validate input
    unless ($id) {
        return $c->render(json => { error => 'Phone ID missing' }, status => 400);
    }

    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Construct SQL query for updating the phone
    my $sql = "UPDATE phones SET " . join(", ", map { "$_ = ?" } keys %$json) . " WHERE id = ?";
    my @values = (values %$json, $id);

    my $sth = $dbh->prepare($sql);
    eval { $sth->execute(@values) };
    if ($@) {
        return $c->render(json => { error => "Update failed: $@" }, status => 500);
    }

    $c->render(json => { message => 'Phone successfully updated' });
};

1;  # End of module
