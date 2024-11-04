package Entity::Inventar_device;

use strict;
use warnings;

# Konstruktor für die InventarDevice-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der InventarDevice-Daten
sub validate {
    my $self = shift;
    return defined $self->{inventar_liste_original_id} && defined $self->{device_id} && defined $self->{zugewiesen_am} && defined $self->{zustand};
}

# Methode, um alle InventarDevice-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        inventar_liste_original_id => $self->{inventar_liste_original_id},
        device_id                  => $self->{device_id},
        zugewiesen_am              => $self->{zugewiesen_am},
        zustand                    => $self->{zustand},
    };
}

1;  # End of module
