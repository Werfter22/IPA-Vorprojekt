package Entity::Apple_Care;

use strict;
use warnings;

# Konstruktor für die AppleCare-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der AppleCare-Daten
sub validate {
    my $self = shift;
    return defined $self->{user_id} && defined $self->{garantie};
}

# Methode, um alle AppleCare-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        apple_care_id => $self->{apple_care_id},
        user_id       => $self->{user_id},
        garantie      => $self->{garantie},
    };
}

1;  # End of module
