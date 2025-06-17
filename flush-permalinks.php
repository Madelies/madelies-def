<?php
/**
 * Dit bestand moet worden uitgevoerd in de browser om de permalinks te resetten.
 * URL: https://jouw-site.com/wp-content/themes/madelies-def/flush-permalinks.php
 */

// Bootstrap WordPress
require_once('../../../../wp-load.php');

// Controleer of de gebruiker is ingelogd en admin rechten heeft
if (!current_user_can('manage_options')) {
    echo "Je hebt niet de juiste rechten om deze actie uit te voeren.";
    exit;
}

// Flush permalinks
flush_rewrite_rules(true);

echo "Permalinks zijn gereset. Je kunt dit bestand nu verwijderen om veiligheidsredenen.";
