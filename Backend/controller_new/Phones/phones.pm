package Controller::Phones;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls to the database

# Route to fetch all phones and render them in the frontend template
get '/phones' => sub {
    my $c = shift;

    # Fetch phones from the external database API
    my ($phones, $error_msg) = get_all_phones_from_api();

    # Check if phones were successfully fetched
    if (!$phones) {
        return $c->render(template => 'phones/error', error_msg => $error_msg || 'Failed to fetch phones');
    }

    # Render the phones in the template
    $c->render(template => 'phones/phones', phones => $phones);
};

# Method to fetch all phones via the API
sub get_all_phones_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/phones";  # URL of your database API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);  # Return successful response
    } else {
        return (undef, "API call failed: " . $tx->result->message);  # Return error message
    }
}

1;  # End of the module
