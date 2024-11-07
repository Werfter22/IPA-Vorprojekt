package Controller::Devices::EditDevices;

use Mojolicious::Lite;
use DBI;

# Datenbankverbindung
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to update a device by ID
put '/api/devices/edit/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');
    my $json = $c->req->json;

    # Validate input
    unless ($id) {
        return $c->render(json => { error => 'Device ID missing' }, status => 400);
    }

    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Construct SQL query for updating the device
    my $sql = "UPDATE devices SET " . join(", ", map { "$_ = ?" } keys %$json) . " WHERE id = ?";
    my @values = (values %$json, $id);

    my $sth = $dbh->prepare($sql);
    eval { $sth->execute(@values) };
    if ($@) {
        return $c->render(json => { error => "Update failed: $@" }, status => 500);
    }

    $c->render(json => { message => 'Device successfully updated' });
};

1;  # End of module
