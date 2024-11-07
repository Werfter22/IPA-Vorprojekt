package Controller::Machines::edit_machines;

use Mojolicious::Lite;
use Mojo::UserAgent;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Route to edit and render the updated machine details
put '/machines/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;

    # Validate input
    unless ($id) {
        return $c->render(template => 'machines/error', error_msg => 'Machine ID missing');
    }

    unless ($json && ref($json) eq 'HASH') {
        return $c->render(template => 'machines/error', error_msg => 'Invalid JSON input');
    }

    # Construct SQL query for updating the machine
    my $sql = "UPDATE machines SET " . join(", ", map { "$_ = ?" } keys %$json) . " WHERE id = ?";
    my @values = (values %$json, $id);

    my $sth = $dbh->prepare($sql);
    eval { $sth->execute(@values) };
    if ($@) {
        return $c->render(template => 'machines/error', error_msg => "Update failed: $@");
    }

    # Fetch the updated machine data from the API
    my $ua = Mojo::UserAgent->new;
    my $api_url = "http://127.0.0.1:3000/api/machines/$id";  # Assuming this API endpoint returns a single machine by ID
    my $tx = $ua->get($api_url);

    # Check for success and render updated data
    if ($tx->result->is_success) {
        my $updated_machine = $tx->result->json;
        $c->render(template => 'machines/detail_machines', machine => $updated_machine);
    } else {
        $c->render(template => 'machines/error', error_msg => 'Failed to fetch updated machine data');
    }
};

1;  # End of module
