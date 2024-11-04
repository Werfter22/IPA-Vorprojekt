package Entity::User_device;

use strict;
use warnings;

# Konstruktor für die UserDevice-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der UserDevice-Daten
sub validate {
    my $self = shift;
    return defined $self->{user_id} && defined $self->{device_id} && defined $self->{zugeordnet_seit} && defined $self->{nutzungsstatus};
}

# Methode, um alle UserDevice-Daten als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        user_id           => $self->{user_id},
        device_id         => $self->{device_id},
        zugeordnet_seit   => $self->{zugeordnet_seit},
        nutzungsstatus    => $self->{nutzungsstatus},
    };
}

1;  # End of module
