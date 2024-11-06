package Controller::home_Office;

use strict;
use warnings;
use Entity::Home_office;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/home_office";
my $ua = Mojo::UserAgent->new;

# Create a new HomeOffice entry via API
sub create {
    my ($class, %args) = @_;
    my $home_office = Entity::Home_office->new(%args);

    if ($home_office->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid HomeOffice data";
    }
}

# Read a specific HomeOffice entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update a HomeOffice entry via API
sub update {
    my ($class, %args) = @_;
    my $home_office = Entity::Home_office->new(%args);

    if ($home_office->validate()) {
        my $tx = $ua->put("$api_base_url/$args{home_office_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid HomeOffice data";
    }
}

# Delete a HomeOffice entry via API
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
