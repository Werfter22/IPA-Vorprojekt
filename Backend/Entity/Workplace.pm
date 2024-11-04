package Entity::Workplace;

use strict;
use warnings;

# Konstruktor für die Workplace-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der Workplace-Daten
sub validate {
    my $self = shift;
    return defined $self->{user_id} && defined $self->{device_id} && defined $self->{status};
}

# Methode, um alle Workplace-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        workplace_id => $self->{workplace_id},  # Optional, wenn ID nach dem Einfügen in die DB generiert wird
        user_id      => $self->{user_id},
        device_id    => $self->{device_id},
        status       => $self->{status},
    };
}

1;  # End of module
