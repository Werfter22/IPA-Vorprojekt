package Controller::home_Office;

use strict;
use warnings;
use Entity::Home_office;

sub create {
    my ($class, %args) = @_;
    my $home_office = Entity::Home_office->new(%args);

    if ($home_office->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid HomeOffice data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des HomeOffice-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $home_office = Entity::HomeOffice->new(%args);

    if ($home_office->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid HomeOffice data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des HomeOffice-Eintrags aus der Datenbank
}

1;  # End of module
