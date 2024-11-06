package Controller::Machines::CreateMachines;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to create a new machine
post '/api/machines/create' => sub {
    my $c = shift;
    my $json = $c->req->json;

    # Validate input (add more validations based on your requirements)
    unless ($json && ref($json) eq 'HASH') {
        return $c->render(json => { error => 'Invalid JSON input' }, status => 400);
    }

    # Prepare SQL and execute
    my $sth = $dbh->prepare("INSERT INTO machines (name, function, description, is_virtual, cpu, cores, ram_mb) VALUES (?, ?, ?, ?, ?, ?, ?)");  # Adjust column names as needed
    eval { $sth->execute($json->{name}, $json->{function}, $json->{description}, $json->{is_virtual}, $json->{cpu}, $json->{cores}, $json->{ram_mb}) };
    if ($@) {
        return $c->render(json => { error => "Insert failed: $@" }, status => 500);
    }

    $c->render(json => { message => 'Machine successfully created' });
};

1;  # End of module
