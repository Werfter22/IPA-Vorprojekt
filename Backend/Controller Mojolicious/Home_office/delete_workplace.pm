package Controller::delete_workplace;

use strict;
use warnings;
use Mojo::UserAgent;
use Mojo::Base 'Mojolicious::Controller';

# Define the API base URL for the workplace entity
my $workplace_url = "http://127.0.0.1:3000/api/workplace";

my $ua = Mojo::UserAgent->new;

# Delete a specific workplace based on workplace_id
sub delete_workplace {
    my ($self, $workplace_id) = @_;

    # Send DELETE request to remove the workplace
    $ua->delete("$workplace_url/$workplace_id" => sub {
        my ($ua, $tx) = @_;

        if ($tx->result->is_success) {
            # Redirect to a workplace list page or show success message
            $self->redirect_to("/workplace_list");
        } else {
            # Handle error if the deletion fails
            $self->render(text => "Failed to delete workplace: " . $tx->result->message, status => 500);
        }
    });
}

1;  # End of module
