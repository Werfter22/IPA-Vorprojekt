package Controller::add_device_home_office;

use strict;
use warnings;
use Mojo::UserAgent;
use Mojo::Base 'Mojolicious::Controller';

# Define the API base URLs for devices and home office
my $devices_url     = "http://127.0.0.1:3000/api/devices";
my $home_office_url = "http://127.0.0.1:3000/api/home_office";

my $ua = Mojo::UserAgent->new;

# Render form to select a home office for the device
sub render_add_form {
    my ($self, $user_id, $device_id) = @_;

    # Fetch available home offices
    $ua->get($home_office_url => sub {
        my ($ua, $tx) = @_;

        if (my $home_offices = $tx->result->json) {
            # Render the add_device_home_office.html.ep template with available home offices
            $self->render(
                template    => 'add_device_home_office',
                home_offices => $home_offices,
                user_id     => $user_id,
                device_id   => $device_id,
            );
        } else {
            # Handle error if fetching home offices fails
            $self->render(text => "Failed to fetch home office data: " . $tx->result->message, status => 500);
        }
    });
}

# Submit the selected home office to associate it with the device
sub submit_add_home_office {
    my $self = shift;
    my $user_id      = $self->param('user_id');
    my $device_id    = $self->param('device_id');
    my $home_office_id = $self->param('home_office_id');

    # Data to associate device with home office
    my $association_data = {
        user_id       => $user_id,
        device_id     => $device_id,
        home_office_id => $home_office_id,
    };

    # Send POST request to add home office association to the device
    $ua->post("$devices_url/$device_id/add_home_office" => json => $association_data => sub {
        my ($ua, $tx) = @_;

        if ($tx->result->is_success) {
            # Redirect to detail page or show success message
            $self->redirect_to("/detail_user_home_office/$user_id");
        } else {
            # Handle error if the association fails
            $self->render(text => "Failed to associate home office with device: " . $tx->result->message, status => 500);
        }
    });
}

1;  # End of module
