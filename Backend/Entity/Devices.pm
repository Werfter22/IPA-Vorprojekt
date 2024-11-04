package Entity::Devices;

use strict;
use warnings;

# Konstruktor für die Device-Klasse
sub new {
    my ($class, %args) = @_;
    return bless \%args, $class;
}

# Validierung der Gerätedaten
sub validate {
    my $self = shift;
    my @errors;  # Array für Fehlernachrichten

    # Beispielvalidierung für Geräte
    push @errors, "Device_ID ist erforderlich" unless defined $self->{Device_ID} && $self->{Device_ID} ne '';
    push @errors, "Device_Name_1 ist erforderlich" unless defined $self->{Device_Name_1} && $self->{Device_Name_1} ne '';
    push @errors, "QR_Code ist erforderlich" unless defined $self->{QR_Code} && $self->{QR_Code} ne '';
    push @errors, "Barcode ist erforderlich" unless defined $self->{Barcode} && $self->{Barcode} ne '';
    push @errors, "Image_Path ist erforderlich" unless defined $self->{image_path} && $self->{image_path} ne '';  # Validation for image_path

    # Überprüfe die Seriennummern
    for my $i (1..12) {
        push @errors, "Serialnumber_$i ist erforderlich" unless defined $self->{"Serialnumber_$i"} && $self->{"Serialnumber_$i"} ne '';
    }

    # Überprüfe die Betriebssysteme
    for my $i (1..12) {
        push @errors, "OS_$i ist erforderlich" unless defined $self->{"OS_$i"} && $self->{"OS_$i"} ne '';
    }

    # Wenn Fehler vorhanden sind, gib sie zurück
    return @errors ? @errors : 1;  # Gibt die Fehler zurück oder 1 bei Erfolg
}

# Methode, um alle Geräteinformationen als Hash zu erhalten
sub to_hash {
    my $self = shift;
    return {
        Device_ID          => $self->{Device_ID},
        Device_Name_1     => $self->{Device_Name_1},
        Device_Name_2     => $self->{Device_Name_2},
        Device_Name_3     => $self->{Device_Name_3},
        Device_Name_4     => $self->{Device_Name_4},
        Device_Name_5     => $self->{Device_Name_5},
        Device_Name_6     => $self->{Device_Name_6},
        Device_Name_7     => $self->{Device_Name_7},
        Device_Name_8     => $self->{Device_Name_8},
        Device_Name_9     => $self->{Device_Name_9},
        Device_Name_10    => $self->{Device_Name_10},
        Device_Name_11    => $self->{Device_Name_11},
        Device_Name_12    => $self->{Device_Name_12},
        Serialnumber_1    => $self->{Serialnumber_1},
        Serialnumber_2    => $self->{Serialnumber_2},
        Serialnumber_3    => $self->{Serialnumber_3},
        Serialnumber_4    => $self->{Serialnumber_4},
        Serialnumber_5    => $self->{Serialnumber_5},
        Serialnumber_6    => $self->{Serialnumber_6},
        Serialnumber_7    => $self->{Serialnumber_7},
        Serialnumber_8    => $self->{Serialnumber_8},
        Serialnumber_9    => $self->{Serialnumber_9},
        Serialnumber_10   => $self->{Serialnumber_10},
        Serialnumber_11   => $self->{Serialnumber_11},
        Serialnumber_12   => $self->{Serialnumber_12},
        OS_1              => $self->{OS_1},
        OS_2              => $self->{OS_2},
        OS_3              => $self->{OS_3},
        OS_4              => $self->{OS_4},
        OS_5              => $self->{OS_5},
        OS_6              => $self->{OS_6},
        OS_7              => $self->{OS_7},
        OS_8              => $self->{OS_8},
        OS_9              => $self->{OS_9},
        OS_10             => $self->{OS_10},
        OS_11             => $self->{OS_11},
        OS_12             => $self->{OS_12},
        QR_Code           => $self->{QR_Code},
        Barcode           => $self->{Barcode},
        IS_Werft_Device_1 => $self->{IS_Werft_Device_1},
        IS_Werft_Device_2 => $self->{IS_Werft_Device_2},
        IS_Werft_Device_3 => $self->{IS_Werft_Device_3},
        IS_Werft_Device_4 => $self->{IS_Werft_Device_4},
        IS_Werft_Device_5 => $self->{IS_Werft_Device_5},
        IS_Werft_Device_6 => $self->{IS_Werft_Device_6},
        IS_Werft_Device_7 => $self->{IS_Werft_Device_7},
        IS_Werft_Device_8 => $self->{IS_Werft_Device_8},
        IS_Werft_Device_9 => $self->{IS_Werft_Device_9},
        IS_Werft_Device_10 => $self->{IS_Werft_Device_10},
        IS_Werft_Device_11 => $self->{IS_Werft_Device_11},
        IS_Werft_Device_12 => $self->{IS_Werft_Device_12},
        IS_Private_Device_1 => $self->{IS_Private_Device_1},
        IS_Private_Device_2 => $self->{IS_Private_Device_2},
        IS_Private_Device_3 => $self->{IS_Private_Device_3},
        IS_Private_Device_4 => $self->{IS_Private_Device_4},
        IS_Private_Device_5 => $self->{IS_Private_Device_5},
        IS_Private_Device_6 => $self->{IS_Private_Device_6},
        IS_Private_Device_7 => $self->{IS_Private_Device_7},
        IS_Private_Device_8 => $self->{IS_Private_Device_8},
        IS_Private_Device_9 => $self->{IS_Private_Device_9},
        IS_Private_Device_10 => $self->{IS_Private_Device_10},
        IS_Private_Device_11 => $self->{IS_Private_Device_11},
        IS_Private_Device_12 => $self->{IS_Private_Device_12},
        image_path         => $self->{image_path},  # Added image_path
    };
}

1;  # End of module
