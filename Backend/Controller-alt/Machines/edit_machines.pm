package Controller::Machines::EditMachines;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to update a machine by ID
put '/api/machines/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;

    # Validate input
    unless ($id) {
        return $c->render(json => { error => 'Machine ID missing' }, status => 400);
    }

    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Construct SQL query for updating the machine
    my $sql = "UPDATE machines SET " . join(", ", map { "$_ = ?" } keys %$json) . " WHERE id = ?";
    my @values = (values %$json, $id);

    my $sth = $dbh->prepare($sql);
    eval { $sth->execute(@values) };
    if ($@) {
        return $c->render(json => { error => "Update failed: $@" }, status => 500);
    }

    $c->render(json => { message => 'Machine successfully updated' });
};

1;  # End of module
