package Controller::user_phone;

use strict;
use warnings;
use Entity::User_phone;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/user_phone";
my $ua = Mojo::UserAgent->new;

# Create a new UserPhone entry via API
sub create {
    my ($class, %args) = @_;
    my $user_phone = Entity::User_phone->new(%args);

    if ($user_phone->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid UserPhone data";
    }
}

# Read a specific UserPhone entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update a UserPhone entry via API
sub update {
    my ($class, %args) = @_;
    my $user_phone = Entity::User_phone->new(%args);

    if ($user_phone->validate()) {
        my $tx = $ua->put("$api_base_url/$args{user_id}/$args{phone_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid UserPhone data";
    }
}

# Delete a UserPhone entry via API
sub delete {
    my ($class, $user_id, $phone_id) = @_;
    my $tx = $ua->delete("$api_base_url/$user_id/$phone_id");

    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

1;  # End of module
