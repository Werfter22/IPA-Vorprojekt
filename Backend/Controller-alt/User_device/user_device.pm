package Controller::user_device;

use strict;
use warnings;
use Entity::User_device;

sub create {
    my ($class, %args) = @_;
    my $user_device = Entity::User_device->new(%args);

    if ($user_device->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid UserDevice data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des UserDevice-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $user_device = Entity::UserDevice->new(%args);

    if ($user_device->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid UserDevice data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des UserDevice-Eintrags aus der Datenbank
}

1;  # End of module
