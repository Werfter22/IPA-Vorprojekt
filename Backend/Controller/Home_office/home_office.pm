package Controller::home_Office;

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
my $workplace_url   = "http://127.0.0.1:3000/api/workplace";
my $devices_url     = "http://127.0.0.1:3000/api/devices";
my $users_url       = "http://127.0.0.1:3000/api/users";

my $ua = Mojo::UserAgent->new;

# Render data from all entities to home_office.html.ep
sub render_home_office_data {
    my $self = shift;

    # Asynchronously fetch data from all APIs
    my $home_office_p = $ua->get_p($home_office_url)->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "Home Office API error: " . $result->message;
    });

    my $workplace_p = $ua->get_p($workplace_url)->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "Workplace API error: " . $result->message;
    });

    my $devices_p = $ua->get_p($devices_url)->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "Devices API error: " . $result->message;
    });

    my $users_p = $ua->get_p($users_url)->then(sub {
        my $result = shift->result;
        return $result->is_success ? $result->json : die "Users API error: " . $result->message;
    });

    # Wait for all promises and render the template with the data
    Mojo::Promise->all($home_office_p, $workplace_p, $devices_p, $users_p)->then(sub {
        my ($home_office_res, $workplace_res, $devices_res, $users_res) = @_;

        # Render the home_office.html.ep template with data from all entities
        $self->render(
            template    => 'home_office',
            home_office => $home_office_res->[0],
            workplace   => $workplace_res->[0],
            devices     => $devices_res->[0],
            users       => $users_res->[0],
        );
    })->catch(sub {
        my $err = shift;
        $self->render(text => "Failed to fetch data: $err", status => 500);
    })->wait;
}

1;  # End of module
