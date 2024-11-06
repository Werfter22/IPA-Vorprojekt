package Controller::user_device;

use strict;
use warnings;
use Entity::User_device;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/user_device";
my $ua = Mojo::UserAgent->new;

# Create a new UserDevice entry via API
sub create {
    my ($class, %args) = @_;
    my $user_device = Entity::User_device->new(%args);

    if ($user_device->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid UserDevice data";
    }
}

# Read a specific UserDevice entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update a UserDevice entry via API
sub update {
    my ($class, %args) = @_;
    my $user_device = Entity::User_device->new(%args);

    if ($user_device->validate()) {
        my $tx = $ua->put("$api_base_url/$args{user_id}/$args{device_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid UserDevice data";
    }
}

# Delete a UserDevice entry via API
sub delete {
    my ($class, $user_id, $device_id) = @_;
    my $tx = $ua->delete("$api_base_url/$user_id/$device_id");

    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

1;  # End of module
