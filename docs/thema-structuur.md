# Madelies WordPress Thema Structuur

Dit document beschrijft de structuur van het Madelies WordPress thema, inclusief de secties op de homepage en hoe je ze kunt beheren.

## Homepage Secties

De homepage van het Madelies thema bestaat uit de volgende secties:

### 1. Hero Sectie
De grote banner bovenaan de pagina met video achtergrond, titel en knoppen. 
Deze kun je aanpassen via **Weergave > Aanpassen > Hero Sectie**

### 2. Over Mij Sectie
Informatie over Lies Willems met foto en drie blokken tekst.
Deze kun je aanpassen via **Weergave > Aanpassen > Over Mij Sectie**

### 3. Aanbod Sectie
Een overzicht van aangeboden diensten met getallen en korte beschrijvingen.
Deze kun je aanpassen via **Weergave > Aanpassen > Aanbod Sectie**

### 4. Moestuin Foto's
Een sectie met drie foto's van de moestuin. Deze foto's zijn statisch en kunnen alleen worden vervangen door nieuwe afbeeldingen te uploaden in de `img` map van het thema.

De volgende bestanden worden gebruikt:
- `img/fotofolies3.webp`
- `img/fotofolies2.webp`
- `img/fotofolies4.webp`

Op mobiele apparaten worden deze foto's automatisch verborgen.

### 5. Onderbrekingslijn
Een decoratieve lijn die secties van elkaar scheidt. Deze gebruikt het bestand `img/onderbrekingslijn.webp`.

### 6. Portfolio Sectie
Een raster met portfolio-items die dynamisch worden geladen vanuit de custom post type "Portfolio".
Zie het document [Portfolio Toevoegen](portfolio-toevoegen.md) voor meer informatie.

### 7. Streepjes Divider
Een decoratieve rij met puntjes die portfolio en testimonials van elkaar scheidt. Deze gebruikt het bestand `img/puntjes.webp`.

### 8. Testimonials (Reviews) Sectie
Een slider met klantrecensies die dynamisch worden geladen vanuit de custom post type "Testimonial".
Zie het document [Testimonials Toevoegen](testimonials-toevoegen.md) voor meer informatie.

### 9. Contact Sectie
Contactinformatie met adres en email.

## Bestandsstructuur

- `index.php`: De belangrijkste template die de homepage weergeeft
- `style.css`: Hoofdstijlbestand voor het thema
- `functions.php`: Bevat alle functionaliteit van het thema, inclusief custom post types
- `header.php` en `footer.php`: Bevatten de gemeenschappelijke header en footer voor alle pagina's
- `inc/customizer.php`: Instellingen voor het aanpassen van het thema via de customizer
- `css/`: Map met aanvullende stijlbestanden
- `js/`: Map met JavaScript bestanden
- `img/`: Map met afbeeldingen
  - `portfolio/`: Map met portfolio afbeeldingen
  - `testimonials/`: Map met testimonial afbeeldingen
- `docs/`: Documentatie over het thema

## Wijzigen van Statische Elementen

Als je de statische afbeeldingen wilt wijzigen (zoals de moestuin foto's of onderbrekingslijn), moet je nieuwe afbeeldingen uploaden met dezelfde bestandsnaam of het pad in `index.php` aanpassen.
