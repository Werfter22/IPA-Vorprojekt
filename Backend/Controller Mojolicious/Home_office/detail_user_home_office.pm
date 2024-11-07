package Controller::detail_user_home_office;

use strict;
use warnings;
use Mojo::UserAgent;
use Mojo::Base 'Mojolicious::Controller';

use ../../Entity/Home_office.pm;
use ../../Entity/Workplace.pm;
use ../../Entity/Devices.pm;
use ../../Entity/Users.pm;

# Define API base URLs for each entity
my $home_office_url = "http://127.0.0.1:3000/api/home_office";
my $devices_url     = "http://127.0.0.1:3000/api/devices";
my $users_url       = "http://127.0.0.1:3000/api/users";

my $ua = Mojo::UserAgent->new;

# Render data specific to the user's home office to detail_user_home_office.html.ep
sub render_user_home_office_data {
    my ($self, $user_id) = @_;

    # Fetch user data based on user_id
    my $user_p = $ua->get_p("$users_url/$user_id")->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "User API error: " . $result->message;
    });

    # Fetch home office data for the user based on user_id
    my $home_office_p = $ua->get_p("$home_office_url?user_id=$user_id")->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "Home Office API error: " . $result->message;
    });

    # Fetch devices associated with the user's home office
    my $devices_p = $ua->get_p("$devices_url?user_id=$user_id")->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "Devices API error: " . $result->message;
    });

    # Wait for all promises and render the template with the data
    Mojo::Promise->all($user_p, $home_office_p, $devices_p)->then(sub {
        my ($user_res, $home_office_res, $devices_res) = @_;

        # Render the detail_user_home_office.html.ep template with data from all entities
        $self->render(
            template    => 'detail_user_home_office',
            user        => $user_res->[0],
            home_office => $home_office_res->[0],
            devices     => $devices_res->[0],
        );
    })->catch(sub {
        my $err = shift;
        $self->render(text => "Failed to fetch data: $err", status => 500);
    })->wait;
}

1;  # End of module
