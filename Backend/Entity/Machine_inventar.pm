package Entity::Machine_inventar;

use strict;
use warnings;

# Konstruktor für die MachineInventar-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der MachineInventar-Daten
sub validate {
    my $self = shift;
    return defined $self->{machine_liste_id} && defined $self->{inventar_liste_original_id};
}

# Methode, um alle MachineInventar-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        machine_inventar_id       => $self->{machine_inventar_id},
        machine_liste_id          => $self->{machine_liste_id},
        inventar_liste_original_id => $self->{inventar_liste_original_id},
    };
}

1;  # End of module
