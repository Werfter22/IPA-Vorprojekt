package Controller::add_user_devices;

use strict;
use warnings;
use Mojo::UserAgent;

# Base URLs for your API
my $api_base_url = "http://127.0.0.1:3000/api";
my $users_url = "$api_base_url/users";
my $user_devices_url = "$api_base_url/user_devices";
my $user_phones_url = "$api_base_url/user_phones";

my $ua = Mojo::UserAgent->new;

# Render form to add new devices and phones for a specific user
sub render_add_user_devices {
    my ($c, $user_id) = @_;

    # Fetch user details
    my $user = fetch_user($user_id);
    return $c->render(text => 'User not found', status => 404) unless $user;

    # Pass user data to the template
    $c->render(template => 'add_user_devices', user => $user);
}

# Handle the addition of new user devices and phones
sub add_user_devices {
    my ($c) = @_;
    my $user_id = $c->param('user_id');

    # New device data from form
    my @devices_to_add = $c->req->json->{devices}; # Assuming devices are sent as JSON
    my @phones_to_add = $c->req->json->{phones};   # Assuming phones are sent as JSON

    # Add devices
    foreach my $device (@devices_to_add) {
        my $tx = $ua->post($user_devices_url => json => { user_id => $user_id, %$device });
        
        if (!$tx->result->is_success) {
            return $c->render(text => "Failed to add device: " . $tx->result->message, status => 500);
        }
    }

    # Add phones
    foreach my $phone (@phones_to_add) {
        my $tx = $ua->post($user_phones_url => json => { user_id => $user_id, %$phone });
        
        if (!$tx->result->is_success) {
            return $c->render(text => "Failed to add phone: " . $tx->result->message, status => 500);
        }
    }

    # Redirect to the user devices page after adding
    $c->redirect_to("/user_devices/$user_id");
}

# Fetch a specific User via API
sub fetch_user {
    my ($user_id) = @_;
    my $tx = $ua->get("$users_url/$user_id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        return undef; # Return undef if user not found
    }
}

1;  # End of module
