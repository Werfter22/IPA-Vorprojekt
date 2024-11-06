package Controller::device_images;

use strict;
use warnings;
use Entity::DeviceImages;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/device_images";
my $ua = Mojo::UserAgent->new;

# Create a new DeviceImage entry via API
sub create {
    my ($class, %args) = @_;
    my $device_image = Entity::DeviceImages->new(%args);

    if ($device_image->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid DeviceImages data";
    }
}

# Read a specific DeviceImage entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update a DeviceImage entry via API
sub update {
    my ($class, %args) = @_;
    my $device_image = Entity::DeviceImages->new(%args);

    if ($device_image->validate()) {
        my $tx = $ua->put("$api_base_url/$args{image_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid DeviceImages data";
    }
}

# Delete a DeviceImage entry via API
sub delete {
    my ($class, $id) = @_;
    my $tx = $ua->delete("$api_base_url/$id");

    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

1;  # End of module
