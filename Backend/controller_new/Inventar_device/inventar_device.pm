package Controller::inventar_device;

use strict;
use warnings;
use Entity::Inventar_device;

sub create {
    my ($class, %args) = @_;
    my $inventar_device = Entity::Inventar_device->new(%args);

    if ($inventar_device->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid InventarDevice data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des InventarDevice-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $inventar_device = Entity::InventarDevice->new(%args);

    if ($inventar_device->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid InventarDevice data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des InventarDevice-Eintrags aus der Datenbank
}

1;  # End of module
