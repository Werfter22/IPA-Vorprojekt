package Controller::Machines::DetailMachines;

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

# Function to get details of a specific machine
get '/api/machines/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Machine ID missing' }, status => 400);
    }

    # Execute SQL query to retrieve machine details
    my $sth = $dbh->prepare("SELECT machine_name, serialnumber, os, is_virtual, cpu, cores, ram_mb FROM machines WHERE id = ?");
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(json => { error => "Fetch failed: $@" }, status => 500);
    }

    my $machine = $sth->fetchrow_hashref;
    
    if ($machine) {
        # Send data to the frontend API
        my $ua = Mojo::UserAgent->new;
        my $frontend_api_url = 'http://127.0.0.1:8081/api/machines';  # Replace with the correct API endpoint

        # Post the machine data to the frontend API
        my $tx = $ua->post($frontend_api_url => json => $machine);

        # Check if the request was successful
        if ($tx->result->is_success) {
            $c->render(json => $machine);  # Render the response as JSON
        } else {
            $c->render(json => { error => 'Failed to send data to frontend API' }, status => 500);
        }
    } else {
        $c->render(json => { error => "Machine not found" }, status => 404);
    }
};

1;  # End of module
