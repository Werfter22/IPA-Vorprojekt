package Controller::edit_home_office;

use strict;
use warnings;
use Mojo::UserAgent;
use Mojo::Base 'Mojolicious::Controller';

# Define the API base URL for the home office entity
my $home_office_url = "http://127.0.0.1:3000/api/home_office";

my $ua = Mojo::UserAgent->new;

# Render edit form with current home office data
sub render_edit_form {
    my ($self, $user_id) = @_;

    # Fetch home office data for the specific user_id
    $ua->get("$home_office_url?user_id=$user_id" => sub {
        my ($ua, $tx) = @_;
        
        if (my $res = $tx->result->json) {
            # Render the edit_home_office.html.ep template with the current home office data
            $self->render(
                template    => 'edit_home_office',
                home_office => $res,
                user_id     => $user_id,
            );
        } else {
            # Handle error if the API call fails
            $self->render(text => "Failed to fetch home office data: " . $tx->result->message, status => 500);
        }
    });
}

# Submit updated home office data to the API
sub submit_update {
    my $self = shift;
    my $user_id = $self->param('user_id');

    # Collect updated data from form input
    my $updated_data = {
        location    => $self->param('location'),
        description => $self->param('description'),
        # Add more fields as necessary
    };

    # Send PUT request to update the home office data
    $ua->put("$home_office_url/$user_id" => json => $updated_data => sub {
        my ($ua, $tx) = @_;
        
        if ($tx->result->is_success) {
            # Redirect to detail page or show success message
            $self->redirect_to("/detail_user_home_office/$user_id");
        } else {
            # Handle error if the update fails
            $self->render(text => "Failed to update home office data: " . $tx->result->message, status => 500);
        }
    });
}

1;  # End of module
