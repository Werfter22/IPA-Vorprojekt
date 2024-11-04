package Controller::Phones;

use strict;
use warnings;
use Mojolicious::Lite;
use Mojo::UserAgent;  # Für API-Anfragen an die Datenbank
use DBI;

# Route, um alle Telefone von der Datenbank-API abzurufen
get '/api/phones' => sub {
    my $c = shift;

    # Abrufen der Telefone von der externen Datenbank-API
    my ($phones, $error_msg) = get_all_phones_from_api();

    # Überprüfen, ob Telefone erfolgreich abgerufen wurden
    if (!$phones) {
        return $c->render(json => { error => $error_msg || 'Failed to fetch phones' }, status => 500);
    }

    # Antwort als JSON rendern
    $c->render(json => $phones);
};

# Methode zum Abrufen aller Telefone über die API
sub get_all_phones_from_api {
    my $ua = Mojo::UserAgent->new;
    my $db_api_url = "http://127.0.0.1:3000/api/phones";  # URL deiner Datenbank-API

    my $tx = $ua->get($db_api_url);
    
    if ($tx->result->is_success) {
        return ($tx->result->json, undef);  # Erfolgreiche Antwort zurückgeben
    } else {
        return (undef, "API call failed: " . $tx->result->message);  # Fehlernachricht zurückgeben
    }
}

1;  # Ende des Moduls
