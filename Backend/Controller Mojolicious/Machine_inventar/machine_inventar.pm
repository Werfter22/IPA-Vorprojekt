package Controller::machine_inventar;

use strict;
use warnings;
use Entity::Machine_inventar;
use Mojo::UserAgent;

# Base URL for your API
my $api_base_url = "http://127.0.0.1:3000/api/machine_inventar";
my $ua = Mojo::UserAgent->new;

# Create a new MachineInventar entry via API
sub create {
    my ($class, %args) = @_;
    my $machine_inventar = Entity::Machine_inventar->new(%args);

    if ($machine_inventar->validate()) {
        my $tx = $ua->post("$api_base_url" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid MachineInventar data";
    }
}

# Read a specific MachineInventar entry via API
sub read {
    my ($class, $id) = @_;
    my $tx = $ua->get("$api_base_url/$id");
    
    if ($tx->result->is_success) {
        return $tx->result->json;
    } else {
        die "API call failed: " . $tx->result->message;
    }
}

# Update a MachineInventar entry via API
sub update {
    my ($class, %args) = @_;
    my $machine_inventar = Entity::Machine_inventar->new(%args);

    if ($machine_inventar->validate()) {
        my $tx = $ua->put("$api_base_url/$args{machine_inventar_id}" => json => \%args);
        if ($tx->result->is_success) {
            return $tx->result->json;
        } else {
            die "API call failed: " . $tx->result->message;
        }
    } else {
        die "Invalid MachineInventar data";
    }
}

# Delete a MachineInventar entry via API
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
