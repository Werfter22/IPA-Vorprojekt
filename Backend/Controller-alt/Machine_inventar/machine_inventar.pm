package Controller::machine_inventar;

use strict;
use warnings;
use Entity::Machine_inventar;

sub create {
    my ($class, %args) = @_;
    my $machine_inventar = Entity::Machine_inventar->new(%args);

    if ($machine_inventar->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid MachineInventar data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des MachineInventar-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $machine_inventar = Entity::MachineInventar->new(%args);

    if ($machine_inventar->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid MachineInventar data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des MachineInventar-Eintrags aus der Datenbank
}

1;  # End of module
