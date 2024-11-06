package Controller::Machines::detail_machines;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Route to get details of a specific machine and render them in a template
get '/machines/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(template => 'machines/error', error_msg => 'Machine ID missing');
    }

    # Execute SQL query to retrieve machine details
    my $sth = $dbh->prepare("SELECT machine_name, serialnumber, os, is_virtual, cpu, cores, ram_mb FROM machines WHERE id = ?");
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(template => 'machines/error', error_msg => "Fetch failed: $@");
    }

    my $machine = $sth->fetchrow_hashref;

    # Check if the machine data was found and render it
    if ($machine) {
        $c->render(template => 'machines/detail_machines', machine => $machine);
    } else {
        $c->render(template => 'machines/error', error_msg => "Machine not found");
    }
};

1;  # End of module
