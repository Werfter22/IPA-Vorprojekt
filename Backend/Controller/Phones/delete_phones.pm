package Controller::Phones::DeletePhones;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to delete a phone by ID
del '/api/phones/delete/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'Phone ID missing' }, status => 400);
    }

    # Execute delete query
    my $sth = $dbh->prepare("DELETE FROM phones WHERE id = ?");
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(json => { error => "Delete failed: $@" }, status => 500);
    }

    $c->render(json => { message => "Phone $id successfully deleted" });
};

1;  # End of module
