package Controller::detail_user_devices_phones;

use strict;
use warnings;
use Mojo::UserAgent;

# Base URLs for your API
my $api_base_url = "http://127.0.0.1:3000/api";
my $users_url = "$api_base_url/users";
my $user_devices_url = "$api_base_url/user_devices";
my $user_phones_url = "$api_base_url/user_phones";

my $ua = Mojo::UserAgent->new;

# Render user device details along with phone numbers for a specific user
sub render_user_devices_phones {
    my ($c, $user_id) = @_;

    # Fetch user details
    my $user = fetch_user($user_id);
    return $c->render(text => 'User not found', status => 404) unless $user;

    # Fetch user-specific devices
    my $user_devices = fetch_user_devices($user_id);

    # Fetch user-specific phones
    my $user_phones = fetch_user_phones($user_id);

    # Pass data to the template
    $c->render(template => 'detail_user_devices_phones', 
                user => $user, 
                user_devices => $user_devices, 
                user_phones => $user_phones);
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