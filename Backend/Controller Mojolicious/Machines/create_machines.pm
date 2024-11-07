package Controller::Machines::create_machines;

use Mojolicious::Lite;
use Mojo::UserAgent;  # For API calls
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to create a new machine
post '/machines/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(template => 'machines/error', error_msg => 'Invalid JSON input');
    }

    # Prepare SQL and execute
    my $sth = $dbh->prepare("INSERT INTO machines (name, function, description, is_virtual, cpu, cores, ram_mb) VALUES (?, ?, ?, ?, ?, ?, ?)");  # Adjust column names as needed
    eval { $sth->execute($json->{name}, $json->{function}, $json->{description}, $json->{is_virtual}, $json->{cpu}, $json->{cores}, $json->{ram_mb}) };
    if ($@) {
        return $c->render(template => 'machines/error', error_msg => "Insert failed: $@");
    }

    # Render success message in a confirmation template
    $c->render(template => 'machines/create_machines', machine_name => $json->{name});
};

1;  # End of module
