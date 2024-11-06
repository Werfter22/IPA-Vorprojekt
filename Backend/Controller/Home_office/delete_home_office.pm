package Controller::delete_home_office;

use strict;
use warnings;
use Mojo::UserAgent;
use Mojo::Base 'Mojolicious::Controller';

# Define the API base URL for the home office entity
my $home_office_url = "http://127.0.0.1:3000/api/home_office";

my $ua = Mojo::UserAgent->new;

# Delete a specific home office based on home_office_id
sub delete_home_office {
    my ($self, $home_office_id) = @_;

    # Send DELETE request to remove the home office entry
    $ua->delete("$home_office_url/$home_office_id" => sub {
        my ($ua, $tx) = @_;

        if ($tx->result->is_success) {
            # Redirect to a home office list page or show success message
            $self->redirect_to("/home_office_list");
        } else {
            # Handle error if the deletion fails
            $self->render(text => "Failed to delete home office: " . $tx->result->message, status => 500);
        }
    });
}

1;  # End of module
