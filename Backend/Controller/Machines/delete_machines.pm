package Controller::Machines::delete_machines;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Route to delete a machine by ID
del '/machines/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that the ID is provided
    unless ($id) {
        return $c->render(template => 'machines/error', error_msg => 'Machine ID is missing');
    }

    # Execute the delete query
    my $sth = $dbh->prepare("DELETE FROM machines WHERE id = ?");
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(template => 'machines/error', error_msg => "Delete failed: $@");
    }

    # Render success message in a confirmation template
    $c->render(template => 'machines/delete_machines', machine_id => $id);
};

1;  # End of module
