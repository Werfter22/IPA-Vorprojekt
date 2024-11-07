package Controller::add_device_workplace;

use strict;
use warnings;
use Mojo::UserAgent;
use Mojo::Base 'Mojolicious::Controller';

# Define the API base URLs for devices and workplace
my $devices_url   = "http://127.0.0.1:3000/api/devices";
my $workplace_url = "http://127.0.0.1:3000/api/workplace";

my $ua = Mojo::UserAgent->new;

# Render form to select a workplace for the device
sub render_add_form {
    my ($self, $user_id, $device_id) = @_;

    # Fetch available workplaces
    $ua->get($workplace_url => sub {
        my ($ua, $tx) = @_;

        if (my $workplaces = $tx->result->json) {
            # Render the add_device_workplace.html.ep template with available workplaces
            $self->render(
                template   => 'add_device_workplace',
                workplaces => $workplaces,
                user_id    => $user_id,
                device_id  => $device_id,
            );
        } else {
            # Handle error if fetching workplaces fails
            $self->render(text => "Failed to fetch workplace data: " . $tx->result->message, status => 500);
        }
    });
}

# Submit the selected workplace to associate it with the device
sub submit_add_workplace {
    my $self = shift;
    my $user_id    = $self->param('user_id');
    my $device_id  = $self->param('device_id');
    my $workplace_id = $self->param('workplace_id');

    # Data to associate device with workplace
    my $association_data = {
        user_id     => $user_id,
        device_id   => $device_id,
        workplace_id => $workplace_id,
    };

    # Send POST request to add workplace association to the device
    $ua->post("$devices_url/$device_id/add_workplace" => json => $association_data => sub {
        my ($ua, $tx) = @_;

        if ($tx->result->is_success) {
            # Redirect to detail page or show success message
            $self->redirect_to("/detail_user_workplace/$user_id");
        } else {
            # Handle error if the association fails
            $self->render(text => "Failed to associate workplace with device: " . $tx->result->message, status => 500);
        }
    });
}

1;  # End of module
