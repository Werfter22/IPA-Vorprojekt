package Controller::Phones::DetailPhones;

use Mojolicious::Lite;
use DBI;
use Mojo::UserAgent;  # Import UserAgent for making HTTP requests

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to get details of a specific phone
get '/api/phones/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Phone ID missing' }, status => 400);
    }

    # Execute SQL query to retrieve phone details
    my $sth = $dbh->prepare("SELECT name, type, status, serial_number FROM phones WHERE id = ?");
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(json => { error => "Fetch failed: $@" }, status => 500);
    }

    my $phone = $sth->fetchrow_hashref;
    
    if ($phone) {
        # Send data to the frontend API
        my $ua = Mojo::UserAgent->new;
        my $frontend_api_url = 'http://127.0.0.1:8081/api/phones';  # Replace with the correct API endpoint

        # Post the phone data to the frontend API
        my $tx = $ua->post($frontend_api_url => json => $phone);

        # Check if the request was successful
        if ($tx->result->is_success) {
            $c->render(json => $phone);  # Render the response as JSON
        } else {
            $c->render(json => { error => 'Failed to send data to frontend API' }, status => 500);
        }
    } else {
        $c->render(json => { error => "Phone not found" }, status => 404);
    }
};

1;  # End of module
