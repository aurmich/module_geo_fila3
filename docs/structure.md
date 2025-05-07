# Modulo Geo

Data: 2025-04-23 19:09:55

## Informazioni generali

- **Namespace principale**: Modules\\Geo
Modules\\Geo\\Database\\Factories
Modules\\Geo\\Database\\Seeders
- **Pacchetto Composer**: laraxot/module_geo_fila3
Marco Sottana
- **Dipendenze**: cheesegrits/filament-google-maps ^3.0 dotswan/filament-map-picker ^1.2 webbingbrasil/filament-maps ^3.0@beta repositories type path url ../Xot type path url ../Tenant type path url ../UI scripts post-autoload-dump_comment 
- **Totale file PHP**: 197
- **Totale classi/interfacce**: 129

## Struttura delle directory

```
Modules/Geo/
├── app/
│   ├── Filament/           # Interfaccia amministrativa Filament
│   │   ├── Resources/      # Risorse Filament
│   │   └── Pages/          # Pagine Filament
│   ├── Models/             # Modelli Eloquent
│   │   ├── Location.php    # Modello per le località
│   │   ├── Place.php       # Modello per i luoghi
│   │   └── Traits/         # Traits per i modelli
│   ├── Services/           # Servizi
│   │   ├── BaseGeoService.php
│   │   ├── GeoService.php
│   │   └── GoogleMapsService.php
│   └── Providers/          # Service Providers
├── database/
│   └── migrations/         # Migrazioni del database
├── resources/
│   ├── views/             # Template Blade
│   │   └── maps/         # Viste per le mappe
│   │       └── farmshops/ # Viste per i negozi agricoli
│   └── js/               # Asset JavaScript
└── routes/
    └── api.php           # Route API
```

## Componenti Principali

### Modelli

1. **Location**
   - Gestisce le località geografiche
   - Attributi principali:
     - `name`: Nome della località
     - `latitude`: Latitudine
     - `longitude`: Longitudine
     - `address`: Indirizzo completo
     - `formatted_address`: Indirizzo formattato

2. **Place**
   - Estende Location per luoghi specifici
   - Attributi aggiuntivi:
     - `type`: Tipo di luogo
     - `description`: Descrizione
     - `opening_hours`: Orari di apertura

### Servizi

1. **BaseGeoService**
   - Classe base per i servizi geografici
   - Gestisce:
     - Rate limiting
     - Caching
     - Error handling

2. **GoogleMapsService**
   - Integrazione con Google Maps API
   - Funzionalità:
     - Geocoding
     - Reverse geocoding
     - Calcolo distanze
     - Elevazione

3. **GeoService**
   - Funzionalità geografiche di base
   - Metodi:
     - Calcolo distanze
     - Validazione coordinate
     - Conversione formati

### Interfaccia Amministrativa

1. **LocationResource**
   - Gestione CRUD delle località
   - Funzionalità:
     - Creazione/modifica località
     - Visualizzazione mappa
     - Filtri e ricerca

2. **PlaceResource**
   - Gestione CRUD dei luoghi
   - Funzionalità aggiuntive:
     - Gestione orari
     - Categorizzazione
     - Media gallery

### API Endpoints

1. **Locations**
   - `GET /api/v1/geo/locations`
   - `POST /api/v1/geo/locations`
   - `GET /api/v1/geo/locations/{id}`
   - `PUT /api/v1/geo/locations/{id}`
   - `DELETE /api/v1/geo/locations/{id}`

2. **Places**
   - `GET /api/v1/geo/places`
   - `POST /api/v1/geo/places`
   - `GET /api/v1/geo/places/{id}`
   - `PUT /api/v1/geo/places/{id}`
   - `DELETE /api/v1/geo/places/{id}`

## Integrazione Frontend

### Mappe

1. **Leaflet Integration**
   - Mappa interattiva
   - Cluster markers
   - Geolocalizzazione
   - Sidebar informativa

2. **Google Maps Integration**
   - Geocoding
   - Calcolo percorsi
   - Street View
   - Places API

### Asset Management

1. **JavaScript**
   - Webpack/Laravel Mix
   - Bundle ottimizzato
   - Source maps
   - Hot reloading

2. **CSS/SASS**
   - Stili modulari
   - Variabili
   - Mixins
   - Responsive design

## Configurazione

### File di Configurazione

1. **geo.php**
   ```php
   return [
       'api_keys' => [
           'google_maps' => env('GOOGLE_MAPS_API_KEY'),
           'mapbox' => env('MAPBOX_ACCESS_TOKEN'),
       ],
       'cache' => [
           'enabled' => true,
           'ttl' => 86400,
       ],
       'rate_limits' => [
           'google_maps' => [
               'requests_per_second' => 50,
           ],
       ],
   ];
   ```

2. **webpack.mix.js**
   ```javascript
   mix.js('resources/js/app.js', 'dist/js')
      .sass('resources/sass/app.scss', 'dist/css');
   ```

## Best Practices

1. **Performance**
   - Caching delle richieste API
   - Lazy loading delle immagini
   - Ottimizzazione query database

2. **Sicurezza**
   - Validazione input
   - Rate limiting
   - Sanitizzazione output

3. **Manutenibilità**
   - Documentazione codice
   - Test unitari
   - Type hints
   - PHPDoc blocks

## Namespace e autoload

```json
    "autoload": {
        "psr-4": {
            "Modules\\Geo\\": "app/",
            "Modules\\Geo\\Database\\Factories\\": "database/factories/",
            "Modules\\Geo\\Database\\Seeders\\": "database/seeders/"
        }
    },
    "require": {
        "cheesegrits/filament-google-maps": "^3.0",
        "dotswan/filament-map-picker": "^1.2",
        "webbingbrasil/filament-maps": "^3.0@beta"
    },
    "repositories": [
        {
            "type": "path",
            "url": "../Xot"
--
        "post-autoload-dump_comment": [
            "@php vendor/bin/testbench package:discover --ansi"
        ],
        "post-update-cmd_comment": [
            "Illuminate\\Foundation\\ComposerScripts::postUpdate"
        ],
        "analyse": "vendor/bin/phpstan analyse",
        "test": "./vendor/bin/pest --no-coverage",
        "test-coverage": "vendor/bin/pest --coverage-html coverage",
        "format": "vendor/bin/php-cs-fixer fix --allow-risky=yes"
    },
    "config": {
        "sort-packages": true,
        "allow-plugins": {
            "phpstan/extension-installer": true,
            "pestphp/pest-plugin": true,
```

## Dipendenze da altri moduli

-       8 Modules\Xot\Filament\Pages\XotBasePage;
-       4 Modules\Xot\Traits\Updater;
-       2 Modules\Xot\Database\Migrations\XotBaseMigration;
-       2 Modules\Xot\Actions\GetViewAction;
-       1 Modules\Xot\View\Components\XotBaseComponent;
-       1 Modules\Xot\Providers\XotBaseServiceProvider;
-       1 Modules\Xot\Providers\XotBaseRouteServiceProvider;
-       1 Modules\Xot\Providers\XotBaseEventServiceProvider;
-       1 Modules\Xot\Providers\Filament\XotBasePanelProvider;
-       1 Modules\Xot\Filament\Widgets\EnvWidget;

## Collegamenti alla documentazione generale

- [Analisi strutturale complessiva](/docs/phpstan/modules_structure_analysis.md)
- [Report PHPStan](/docs/phpstan/)

