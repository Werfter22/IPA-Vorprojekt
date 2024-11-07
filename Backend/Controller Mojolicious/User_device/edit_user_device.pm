package Controller::edit_user_devices;

use strict;
use warnings;
use Mojo::UserAgent;

# Base URLs for your API
my $api_base_url = "http://127.0.0.1:3000/api";
my $users_url = "$api_base_url/users";
my $user_devices_url = "$api_base_url/user_devices";
my $user_phones_url = "$api_base_url/user_phones";

my $ua = Mojo::UserAgent->new;

# Render edit form for user devices and phones
sub render_edit_user_devices {
    my ($c, $user_id) = @_;

    # Fetch user details
    my $user = fetch_user($user_id);
    return $c->render(text => 'User not found', status => 404) unless $user;

    # Fetch user-specific devices
    my $user_devices = fetch_user_devices($user_id);

    # Fetch user-specific phones
    my $user_phones = fetch_user_phones($user_id);

    # Pass data to the template
    $c->render(template => 'edit_user_devices', 
                user => $user, 
                user_devices => $user_devices,
                user_phones => $user_phones);
}

# Handle the update of user devices and phones
sub update_user_devices {
    my ($c) = @_;
    my $user_id = $c->param('user_id');

    # Update device data from form
    my @devices_to_update = $c->req->json->{devices}; # Assuming devices are sent as JSON
    my @phones_to_update = $c->req->json->{phones};   # Assuming phones are sent as JSON

    # Update devices
    foreach my $device (@devices_to_update) {
        my $device_id = $device->{device_id}; # Assuming each device has an ID
        my $tx = $ua->put("$user_devices_url/$device_id" => json => $device);
        
        if (!$tx->result->is_success) {
            return $c->render(text => "Failed to update device ID $device_id: " . $tx->result->message, status => 500);
        }
    }

    # Update phones
    foreach my $phone (@phones_to_update) {
        my $phone_id = $phone->{phone_id}; # Assuming each phone has an ID
        my $tx = $ua->put("$user_phones_url/$phone_id" => json => $phone);
        
        if (!$tx->result->is_success) {
            return $c->render(text => "Failed to update phone ID $phone_id: " . $tx->result->message, status => 500);
        }
    }

    # Redirect to the user devices page after update
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

# Fetch User Devices for a specific user via API
sub fetch_user_devices {
    my ($user_id) = @_;
    my $tx = $ua->get("$user_devices_url?user_id=$user_id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Fetch User Phones for a specific user via API
sub fetch_user_phones {
    my ($user_id) = @_;
    my $tx = $ua->get("$user_phones_url?user_id=$user_id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

1;  # End of module
