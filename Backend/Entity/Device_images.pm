package Entity::Device_Images;

use strict;
use warnings;

# Konstruktor für die DeviceImages-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der DeviceImages-Daten
sub validate {
    my $self = shift;
    return defined $self->{device_id} && defined $self->{image_path} && defined $self->{device_name};
}

# Methode, um alle DeviceImages-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        image_id    => $self->{image_id},
        device_id   => $self->{device_id},
        image_path  => $self->{image_path},
        device_name => $self->{device_name},
    };
}

1;  # End of module
