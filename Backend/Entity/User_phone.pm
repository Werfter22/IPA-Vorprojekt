package Entity::User_phone;

use strict;
use warnings;

# Konstruktor für die UserPhone-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der UserPhone-Daten
sub validate {
    my $self = shift;
    return defined $self->{user_id} && defined $self->{phone_id} && defined $self->{nutzungsstatus} && defined $self->{besitzdauer};
}

# Methode, um alle UserPhone-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        user_id        => $self->{user_id},
        phone_id       => $self->{phone_id},
        nutzungsstatus  => $self->{nutzungsstatus},
        besitzdauer    => $self->{besitzdauer},
    };
}

1;  # End of module
