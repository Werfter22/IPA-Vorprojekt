package Controller::apple_Care;

use strict;
use warnings;
use Entity::Apple_care;

sub create {
    my ($class, %args) = @_;
    my $apple_care = Entity::Apple_care->new(%args);

    if ($apple_care->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid AppleCare data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des AppleCare-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $apple_care = Entity::AppleCare->new(%args);

    if ($apple_care->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid AppleCare data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des AppleCare-Eintrags aus der Datenbank
}

1;  # End of module
