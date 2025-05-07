/**
 * Applicazione principale per la gestione delle mappe dei negozi agricoli
 */

// Importazione delle dipendenze
require('./bootstrap');
require('./map');

// Configurazione globale
window.farmshopsApp = {
    config: {
        mapDefaults: {
            center: [45.4642, 9.1900], // Centro Italia
            zoom: 6,
            minZoom: 3,
            maxZoom: 18
        },
        api: {
            baseUrl: '/api/v1/geo',
            endpoints: {
                locations: '/locations',
                farmshops: '/farmshops'
            }
        },
        tileLayer: {
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }
    },
    
    // Inizializzazione dell'applicazione
    init() {
        // Inizializza i componenti dell'applicazione
        this.initializeMap();
        this.setupEventListeners();
        this.initializeControls();
    },

    // Inizializzazione della mappa
    initializeMap() {
        // Inizializza la mappa Leaflet
        this.map = L.map('map-canvas', {
            center: this.config.mapDefaults.center,
            zoom: this.config.mapDefaults.zoom,
            minZoom: this.config.mapDefaults.minZoom,
            maxZoom: this.config.mapDefaults.maxZoom
        });

        // Aggiungi il layer della mappa
        L.tileLayer(this.config.tileLayer.url, {
            attribution: this.config.tileLayer.attribution
        }).addTo(this.map);

        // Inizializza il cluster group per i markers
        this.markers = L.markerClusterGroup();
        this.map.addLayer(this.markers);

        // Aggiungi il controllo per la geolocalizzazione
        L.control.locate({
            position: 'topleft',
            strings: {
                title: 'Mostra la mia posizione'
            }
        }).addTo(this.map);
    },

    // Configurazione degli event listeners
    setupEventListeners() {
        // Gestione degli eventi della mappa
        this.map.on('moveend', () => {
            this.updateMarkersInView();
        });

        // Gestione degli eventi dell'interfaccia utente
        document.addEventListener('DOMContentLoaded', () => {
            this.setupUIControls();
        });
    },

    // Aggiornamento dei markers visibili
    updateMarkersInView() {
        const bounds = this.map.getBounds();
        const boundsParam = [
            bounds.getSouth(),
            bounds.getWest(),
            bounds.getNorth(),
            bounds.getEast()
        ].join(',');

        // Richiedi i markers all'API
        fetch(`${this.config.api.baseUrl}${this.config.api.endpoints.farmshops}?bounds=${boundsParam}`)
            .then(response => response.json())
            .then(data => {
                this.updateMarkers(data);
            })
            .catch(error => {
                console.error('Errore nel caricamento dei markers:', error);
            });
    },

    // Aggiornamento dei markers sulla mappa
    updateMarkers(data) {
        this.markers.clearLayers();
        
        data.forEach(location => {
            const marker = L.marker([location.latitude, location.longitude], {
                icon: this.createCustomIcon(location)
            });

            marker.bindPopup(this.createPopupContent(location));
            this.markers.addLayer(marker);
        });
    },

    // Creazione dell'icona personalizzata per il marker
    createCustomIcon(location) {
        return L.ExtraMarkers.icon({
            icon: 'fa-store',
            markerColor: 'green',
            shape: 'square',
            prefix: 'fa'
        });
    },

    // Creazione del contenuto del popup
    createPopupContent(location) {
        return `
            <div class="popup-content">
                <h4>${location.name}</h4>
                <p>${location.address}</p>
                ${location.opening_hours ? `<p>Orari: ${location.opening_hours}</p>` : ''}
                ${location.phone ? `<p>Tel: <a href="tel:${location.phone}">${location.phone}</a></p>` : ''}
            </div>
        `;
    },

    // Configurazione dei controlli UI
    setupUIControls() {
        // Implementa i controlli dell'interfaccia utente qui
    },

    // Inizializzazione dei controlli aggiuntivi
    initializeControls() {
        // Inizializza la sidebar
        this.sidebar = L.control.sidebar('sidebar', {
            position: 'left'
        });
        this.map.addControl(this.sidebar);
    }
};

// Inizializza l'applicazione quando il documento è pronto
document.addEventListener('DOMContentLoaded', () => {
    window.farmshopsApp.init();
});
