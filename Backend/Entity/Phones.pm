package Entity::Phones;

use strict;
use warnings;

# Konstruktor für die Phones-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der Telefondaten
sub validate {
    my $self = shift;

    # Beispielvalidierung für Telefone
    return defined $self->{Phone_ID} && defined $self->{'Tel. Mobile 1'};
}

# Methode, um alle Telefondaten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        Phone_ID        => $self->{Phone_ID},
        'Tel. Mobile 1' => $self->{'Tel. Mobile 1'},
        'Tel. Mobile 2' => $self->{'Tel. Mobile 2'},
        'Tel. Mobile 3' => $self->{'Tel. Mobile 3'},
        'Tel. Mobile 4' => $self->{'Tel. Mobile 4'},
        'Tel. Mobile 5' => $self->{'Tel. Mobile 5'},
        'Tel. Mobile 6' => $self->{'Tel. Mobile 6'},
        'Tel. Mobile 7' => $self->{'Tel. Mobile 7'},
        'Tel. Mobile 8' => $self->{'Tel. Mobile 8'},
        'Tel. Mobile 9' => $self->{'Tel. Mobile 9'},
        'Tel. Mobile 10'=> $self->{'Tel. Mobile 10'},
        QR_Code         => $self->{QR_Code},
        Barcode         => $self->{Barcode},
    };
}

1;  # End of module
