package Controller::Users::DetailUsers;

use Mojolicious::Lite;
use DBI;

# Database connection
my $dbh = DBI->connect(
    "dbi:Pg:dbname=neue_datenbank_angaben_werft;host=localhost;port=5432", 
    "postgres", 
    "Findus-7", 
    { RaiseError => 1, PrintError => 0 }
);

# Function to get details of a specific user
get '/api/users/detail/:id' => sub {
    my $c = shift;
    my $id = $c->param('id');

    # Validate that ID is provided
    unless ($id) {
        return $c->render(json => { error => 'User ID missing' }, status => 400);
    }

    # Execute SQL query to retrieve user details
    my $sth = $dbh->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
    eval { $sth->execute($id) };
    if ($@) {
        return $c->render(json => { error => "Fetch failed: $@" }, status => 500);
    }

    my $user = $sth->fetchrow_hashref;
    
    if ($user) {
        $c->render(json => $user);  # Render the response as JSON
    } else {
        $c->render(json => { error => "User not found" }, status => 404);
    }
};

1;  # End of module
