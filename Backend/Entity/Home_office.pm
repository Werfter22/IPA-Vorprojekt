package Entity::Home_office;

use strict;
use warnings;

# Konstruktor für die HomeOffice-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der HomeOffice-Daten
sub validate {
    my $self = shift;
    return defined $self->{user_id} && defined $self->{device_id} && defined $self->{status};
}

# Methode, um alle HomeOffice-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        home_office_id => $self->{home_office_id},
        user_id        => $self->{user_id},
        device_id      => $self->{device_id},
        status         => $self->{status},
    };
}

1;  # End of module
