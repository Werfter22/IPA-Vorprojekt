package Controller::user_device;

use strict;
use warnings;
use Entity::User_device;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/user_device";
my $ua = Mojo::UserAgent->new;

# Render user devices
sub render_user_devices {
    my ($c) = @_;

    # Fetch all users
    my $users = fetch_all_users();

    # Fetch all user devices
    my $user_devices = fetch_all_user_devices();

    # Fetch all user phones
    my $user_phones = fetch_all_user_phones();

    # Fetch all device images
    my $device_images = fetch_all_device_images();

    # Pass data to the template
    $c->render(template => 'user_devices', 
                users => $users, 
                user_devices => $user_devices, 
                user_phones => $user_phones,
                device_images => $device_images);
}

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

# Fetch all Users via API
sub fetch_all_users {
    my ($class) = @_;
    my $tx = $ua->get("http://127.0.0.1:3000/api/users");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Fetch all Devices via API
sub fetch_all_devices {
    my ($class) = @_;
    my $tx = $ua->get("http://127.0.0.1:3000/api/devices");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Fetch all User Devices via API
sub fetch_all_user_devices {
    my ($class) = @_;
    my $tx = $ua->get("http://127.0.0.1:3000/api/user_devices");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Fetch all Phones via API
sub fetch_all_phones {
    my ($class) = @_;
    my $tx = $ua->get("http://127.0.0.1:3000/api/phones");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Fetch all User Phones via API
sub fetch_all_user_phones {
    my ($class) = @_;
    my $tx = $ua->get("http://127.0.0.1:3000/api/user_phones");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Fetch all Device Images via API
sub fetch_all_device_images {
    my ($class) = @_;
    my $tx = $ua->get("http://127.0.0.1:3000/api/device_images");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

1;  # End of module
