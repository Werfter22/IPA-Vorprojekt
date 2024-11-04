package Controller::workplace;

use strict;
use warnings;
use Entity::Workplace;

sub create {
    my ($class, %args) = @_;
    my $workplace = Entity::Workplace->new(%args);

    if ($workplace->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid Workplace data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des Workplace-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $workplace = Entity::Workplace->new(%args);

    if ($workplace->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid Workplace data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des Workplace-Eintrags aus der Datenbank
}

1;  # End of module
