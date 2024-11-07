#!/usr/bin/env perl
use Mojolicious::Lite;

# Einbinden von Controllern
my $r = app->routes;
$r->get('/' => 'home#index');  # Dies verweist auf den Home-Controller und die Index-Methode

# Starte die Anwendung
app->start;
