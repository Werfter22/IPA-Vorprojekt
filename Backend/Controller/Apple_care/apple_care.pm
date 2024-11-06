package Controller::apple_Care;

use strict;
use warnings;
use Entity::Apple_care;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/apple_care";
my $ua = Mojo::UserAgent->new;

# Create a new AppleCare entry via API
sub create {
    my ($class, %args) = @_;
    my $apple_care = Entity::Apple_care->new(%args);

    if ($apple_care->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid AppleCare data";
    }
}

# Read a specific AppleCare entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update an AppleCare entry via API
sub update {
    my ($class, %args) = @_;
    my $apple_care = Entity::Apple_care->new(%args);

    if ($apple_care->validate()) {
        my $tx = $ua->put("$api_base_url/$args{apple_care_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid AppleCare data";
    }
}

# Delete an AppleCare entry via API
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
