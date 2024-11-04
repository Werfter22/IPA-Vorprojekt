package Entity::Machines;

use strict;
use warnings;

# Konstruktor für die Machines-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der Maschinendaten
sub validate {
    my $self = shift;

    # Beispielvalidierung für Maschinen
    return defined $self->{Machine_Liste_ID} && defined $self->{machine_name};
}

# Methode, um alle Maschinendaten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        Machine_Liste_ID      => $self->{Machine_Liste_ID},
        IS_obsolete           => $self->{IS_obsolete},
        machine_name          => $self->{machine_name},
        machine_function      => $self->{machine_function},
        machine_description   => $self->{machine_description},
        IS_Virtual            => $self->{IS_Virtual},
        VM_Host               => $self->{VM_Host},
        CPU                   => $self->{CPU},
        Cores                 => $self->{Cores},
        RAM_MB                => $self->{RAM_MB},
        OS                    => $self->{OS},
        OS_INFO               => $self->{OS_INFO},
        Location              => $self->{Location},
        Lowest_Unit           => $self->{Lowest_Unit},
        Buy_Date              => $self->{Buy_Date},
        Value_Of_Hardware     => $self->{Value_Of_Hardware},
        Restore_Houres        => $self->{Restore_Houres},
        Serialnumber          => $self->{Serialnumber},
        Production_Date       => $self->{Production_Date},
        Disposal_Date         => $self->{Disposal_Date},
    };
}

1;  # End of module
