package Entity::Inventory;

use strict;
use warnings;

# Konstruktor für die Inventory-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der Inventardaten
sub validate {
    my $self = shift;

    # Beispielvalidierung für das Inventar
    return defined $self->{Inventar_Liste_Original_ID} && defined $self->{Name};
}

# Methode, um alle Inventardaten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        Inventar_Liste_Original_ID => $self->{Inventar_Liste_Original_ID},
        Barcode                     => $self->{Barcode},
        Details                     => $self->{Details},
        Name                        => $self->{Name},
        QR_Code                     => $self->{QR_Code},
        Transport_Unit              => $self->{Transport_Unit},
        Location                    => $self->{Location},
    };
}

1;  # End of module
