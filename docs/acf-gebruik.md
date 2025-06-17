# Advanced Custom Fields (ACF) Gebruik in Madelies Thema

Dit document legt uit hoe Advanced Custom Fields (ACF) wordt gebruikt in het Madelies WordPress thema en hoe je het kunt instellen.

## Introductie

Het Madelies thema maakt gebruik van de Advanced Custom Fields (ACF) plugin om extra velden toe te voegen aan portfolio-items en testimonials. Deze velden maken het mogelijk om:

- Portfolio projecten te voorzien van extra informatie zoals klantgegevens, datums, en galerijen
- Testimonials te verrijken met informatie zoals bedrijfsnaam of rol

## ACF Installeren

Om het thema volledig te laten functioneren, moet je de ACF plugin installeren:

1. Ga naar **Plugins > Nieuwe plugin** in het WordPress admin dashboard
2. Zoek naar "Advanced Custom Fields"
3. Klik op "Nu installeren" naast de plugin "Advanced Custom Fields" door Elliot Condon
4. Nadat de installatie is voltooid, klik op "Activeren"

Als je de Pro-versie van ACF wilt gebruiken (niet vereist, maar biedt meer functionaliteit):
1. Koop een licentie op [advancedcustomfields.com](https://www.advancedcustomfields.com/pro/)
2. Download het ACF Pro plugin bestand
3. Ga naar **Plugins > Nieuwe plugin > Plugin uploaden**
4. Upload het gedownloade ZIP-bestand en activeer de plugin

## ACF Velden in het Madelies Thema

Het Madelies thema heeft vooraf ingestelde veldgroepen voor:

### Portfolio Items

- **Ondertitel / Omschrijving**: Een korte tekst die wordt weergegeven boven de inhoud op de detailpagina
- **Klant**: De naam van de klant of opdrachtgever
- **Project Datum**: Wanneer het project is uitgevoerd (bijv. "April 2023")
- **Project URL**: Een link naar het project op het web (indien van toepassing)
- **Video URL**: Upload een video voor in de galerij (.mp4 formaat)
- **Project Galerij**: Een verzameling afbeeldingen die worden weergegeven in een slider

### Testimonials

- **Bedrijf / Rol**: De bedrijfsnaam of rol van de persoon die de testimonial heeft gegeven

## Gebruik van ACF Velden

Alle velden zijn automatisch beschikbaar in het bewerkingsscherm van de betreffende post types, zodra ACF is geïnstalleerd. Ze verschijnen onder de hoofdteksteditor.

### Portfolio Items Bewerken

1. Ga naar **Portfolio > Alle portfolio-items** of **Portfolio > Nieuwe toevoegen**
2. Vul de titel en hoofdtekst in zoals je gewend bent
3. Stel een uitgelichte afbeelding in (dit wordt de thumbnailafbeelding op de homepage)
4. Scroll naar beneden om de ACF velden in te vullen:
   - Vul de ondertitel in
   - Voeg klantinformatie en projectdatum toe
   - Voeg een URL toe als het project online staat
   - Upload een video indien gewenst
   - Voeg afbeeldingen toe aan de galerij

### Testimonials Bewerken

1. Ga naar **Testimonials > Alle testimonials** of **Testimonials > Nieuwe toevoegen**
2. Vul de titel in (de naam van de persoon)
3. Vul in het hoofdtekstveld de testimonial/review in
4. Stel een uitgelichte afbeelding in (dit wordt getoond naast de testimonial)
5. Scroll naar beneden en vul het "Bedrijf / Rol" veld in

## Migreren van Oude naar ACF Velden

Het thema is zo opgezet dat het compatibel is met zowel de oude metabox-velden als de nieuwe ACF-velden. Als je eerder portfolio-items of testimonials hebt gemaakt zonder ACF, kan het thema nog steeds deze gegevens gebruiken.

Wanneer je ACF installeert en bestaande items bewerkt, worden de waarden uit de oude metaboxes automatisch zichtbaar in de ACF-velden. Als je deze items opslaat, worden ze opgeslagen in het ACF-formaat.

### Technische Informatie

Het thema gebruikt een speciale helper functie genaamd `madelies_get_field_value()` die:
1. Eerst controleert of er ACF-veldwaarden beschikbaar zijn
2. Als die niet beschikbaar zijn, terugvalt op de waarden uit de oude metaboxes

Hierdoor is er geen extra werk nodig om bestaande content te migreren.

### Voorbeeld van de Helper Functie

Als je zelf custom templates maakt, kun je de helper functie gebruiken om beide systemen te ondersteunen:

```php
// Haal de klantinfo op uit ACF of fallback op oude metaboxes
$client = madelies_get_field_value($post_id, 'portfolio_client', 'portfolio_client');

// Gebruik de waarde in je template
if (!empty($client)) {
    echo '<p>Klant: ' . esc_html($client) . '</p>';
}
```

## Problemen Oplossen

Als je problemen ondervindt met ACF:

1. Controleer of de ACF plugin is geïnstalleerd en geactiveerd
2. Probeer de plugin te deactiveren en opnieuw te activeren
3. Controleer of er conflicten zijn met andere plugins

Voor meer informatie over ACF, bezoek de [officiële documentatie](https://www.advancedcustomfields.com/resources/).
