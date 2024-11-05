package Controller::user_phone;

use strict;
use warnings;
use Entity::User_phone;

sub create {
    my ($class, %args) = @_;
    my $user_phone = Entity::User_phone->new(%args);

    if ($user_phone->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid UserPhone data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des UserPhone-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $user_phone = Entity::UserPhone->new(%args);

    if ($user_phone->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid UserPhone data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des UserPhone-Eintrags aus der Datenbank
}

1;  # End of module
