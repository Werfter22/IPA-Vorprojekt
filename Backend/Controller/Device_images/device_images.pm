package Controller::device_images;

use strict;
use warnings;
use Entity::DeviceImages;

sub create {
    my ($class, %args) = @_;
    my $device_image = Entity::device_images->new(%args);

    if ($device_image->validate()) {
        # Logik zum Einfügen in die Datenbank hier einfügen
    } else {
        die "Invalid DeviceImages data";
    }
}

sub read {
    my ($class, $id) = @_;
    # Logik zum Lesen des DeviceImages-Eintrags aus der Datenbank
}

sub update {
    my ($class, %args) = @_;
    my $device_image = Entity::DeviceImages->new(%args);

    if ($device_image->validate()) {
        # Logik zum Aktualisieren in die Datenbank hier einfügen
    } else {
        die "Invalid DeviceImages data";
    }
}

sub delete {
    my ($class, $id) = @_;
    # Logik zum Löschen des DeviceImages-Eintrags aus der Datenbank
}

1;  # End of module
