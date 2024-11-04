package Entity::Users;

use strict;
use warnings;

# Konstruktor für die Users-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der Benutzerdaten
sub validate {
    my $self = shift;

    # Beispielvalidierung für Benutzer
    return defined $self->{User_ID} && defined $self->{Lastname} && defined $self->{Firstname};
}

# Methode, um alle Benutzerdaten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        User_ID     => $self->{User_ID},
        Lastname    => $self->{Lastname},
        Firstname   => $self->{Firstname},
        Email_1     => $self->{Email_1},
        Email_2     => $self->{Email_2},
        Email_3     => $self->{Email_3},
        QR_Code     => $self->{QR_Code},
        Barcode     => $self->{Barcode},
    };
}

1;  # End of module
