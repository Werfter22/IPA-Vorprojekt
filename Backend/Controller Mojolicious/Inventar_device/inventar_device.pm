package Controller::inventar_device;

use strict;
use warnings;
use Entity::Inventar_device;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/inventar_device";
my $ua = Mojo::UserAgent->new;

# Create a new InventarDevice entry via API
sub create {
    my ($class, %args) = @_;
    my $inventar_device = Entity::Inventar_device->new(%args);

    if ($inventar_device->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid InventarDevice data";
    }
}

# Read a specific InventarDevice entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update an InventarDevice entry via API
sub update {
    my ($class, %args) = @_;
    my $inventar_device = Entity::Inventar_device->new(%args);

    if ($inventar_device->validate()) {
        my $tx = $ua->put("$api_base_url/$args{inventar_liste_original_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid InventarDevice data";
    }
}

# Delete an InventarDevice entry via API
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
