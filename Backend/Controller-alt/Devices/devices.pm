package Controller::Devices;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # Für API-Calls zur Datenbank
use DBI;

# Route zum Abrufen aller Geräte von der Datenbank-API
get '/api/devices' => sub {
    my $c = shift;

    # Geräte von der externen Datenbank-API abrufen
    my ($devices, $error_msg) = get_all_devices_from_api();

    # Überprüfen, ob Geräte erfolgreich abgerufen wurden
    if (!$devices) {
        return $c->render(json => { error => $error_msg || 'Failed to fetch devices' }, status => 500);
    }

    # Antwort als JSON rendern
    $c->render(json => $devices);
};

# Methode zum Abrufen aller Geräte über die API
sub get_all_devices_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/devices";  # URL deiner Datenbank-API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);
    } else {
        return (undef, "API call failed: " . $tx->result->message);
    }
}

1;  # Ende des Moduls
