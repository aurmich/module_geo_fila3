<?php

return [
    'navigation' => [
        'name' => 'Clienti',
        'group' => 'TechPlanner',
        'label' => 'Gestione Clienti',
        'icon' => 'techplanner-client',
        'sort' => 47,
        'badge' => [
            'color' => 'success',
            'label' => 'Attivi',
        ],
    ],
    'fields' => [
        'company_name' => [
            'label' => 'Nome Azienda',
            'tooltip' => 'Inserisci il nome completo dell\'azienda',
            'placeholder' => 'Es. Rossi S.r.l.',
        ],
        'activity' => [
            'label' => 'Attività',
            'tooltip' => 'Tipo di attività svolta dall\'azienda',
            'placeholder' => 'Es. Commercio al dettaglio',
        ],
        'vat_number' => [
            'label' => 'Partita IVA',
            'tooltip' => 'Numero di Partita IVA dell\'azienda',
            'placeholder' => 'Es. 12345678901',
        ],
        'fiscal_code' => [
            'label' => 'Codice Fiscale',
            'tooltip' => 'Codice fiscale dell\'azienda',
            'placeholder' => 'Es. RSSMRA80A01H501U',
        ],
        'tax_code' => [
            'label' => 'Codice Fiscale (Alternativo)',
            'tooltip' => 'Codice fiscale alternativo se presente',
            'placeholder' => 'Es. RSSMRA80A01H501U',
        ],
        'business_closed' => [
            'label' => 'Attività Chiusa',
            'tooltip' => 'Indica se l\'attività non è più operativa',
            'placeholder' => 'Sì/No',
        ],
        'address' => [
            'label' => 'Indirizzo',
            'tooltip' => 'Via/Piazza dell\'azienda',
            'placeholder' => 'Es. Via Roma',
        ],
        'street_number' => [
            'label' => 'Numero Civico',
            'tooltip' => 'Numero civico dell\'indirizzo',
            'placeholder' => 'Es. 123',
        ],
        'city' => [
            'label' => 'Città',
            'tooltip' => 'Città dove ha sede l\'azienda',
            'placeholder' => 'Es. Milano',
        ],
        'postal_code' => [
            'label' => 'CAP',
            'tooltip' => 'Codice di Avviamento Postale',
            'placeholder' => 'Es. 20100',
        ],
        'province' => [
            'label' => 'Provincia',
            'tooltip' => 'Sigla della provincia',
            'placeholder' => 'Es. MI',
        ],
        'country' => [
            'label' => 'Paese',
            'tooltip' => 'Nazione dove ha sede l\'azienda',
            'placeholder' => 'Es. Italia',
        ],
        'phone' => [
            'label' => 'Telefono',
            'tooltip' => 'Numero di telefono fisso',
            'placeholder' => 'Es. +39 02 1234567',
        ],
        'mobile' => [
            'label' => 'Cellulare',
            'tooltip' => 'Numero di cellulare',
            'placeholder' => 'Es. +39 333 1234567',
        ],
        'fax' => [
            'label' => 'Fax',
            'tooltip' => 'Numero di fax',
            'placeholder' => 'Es. +39 02 1234567',
        ],
        'email' => [
            'label' => 'Email',
            'tooltip' => 'Indirizzo email principale',
            'placeholder' => 'Es. info@azienda.it',
        ],
        'pec' => [
            'label' => 'PEC',
            'tooltip' => 'Indirizzo di Posta Elettronica Certificata',
            'placeholder' => 'Es. azienda@pec.it',
        ],
        'competent_health_unit' => [
            'label' => 'Unità Sanitaria Competente',
            'tooltip' => 'ASL o unità sanitaria di competenza',
            'placeholder' => 'Es. ASL Milano',
        ],
        'company_office' => [
            'label' => 'Sede Aziendale',
            'tooltip' => 'Tipo di sede (principale, secondaria, etc.)',
            'placeholder' => 'Es. Sede Principale',
        ],
        'notes' => [
            'label' => 'Note',
            'tooltip' => 'Annotazioni aggiuntive sul cliente',
            'placeholder' => 'Inserisci eventuali note...',
        ],
        'values' => [
            'label' => 'values',
        ],
        'value' => [
            'label' => 'value',
        ],
        'latitude' => [
            'label' => 'latitude',
        ],
        'applyFilters' => [
            'label' => 'applyFilters',
        ],
        'toggleColumns' => [
            'label' => 'toggleColumns',
        ],
        'reorderRecords' => [
            'label' => 'reorderRecords',
        ],
        'resetFilters' => [
            'label' => 'resetFilters',
        ],
        'openFilters' => [
            'label' => 'openFilters',
        ],
        'longitude' => [
            'label' => 'longitude',
        ],
        'distance' => [
            'label' => 'distance',
        ],
        'create' => [
            'label' => 'create',
        ],
        'view' => [
            'label' => 'view',
        ],
        'edit' => [
            'label' => 'edit',
        ],
        'delete' => [
            'label' => 'delete',
        ],
        'sortByDistance' => [
            'label' => 'sortByDistance',
        ],
    ],
    'sections' => [
        'business_info' => [
            'title' => 'Informazioni Aziendali',
            'description' => 'Dati principali dell\'azienda',
        ],
        'address' => [
            'title' => 'Indirizzo',
            'description' => 'Ubicazione dell\'azienda',
        ],
        'contacts' => [
            'title' => 'Contatti',
            'description' => 'Informazioni di contatto',
        ],
        'additional_info' => [
            'title' => 'Informazioni Aggiuntive',
            'description' => 'Altri dettagli importanti',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Cliente',
            'tooltip' => 'Crea un nuovo cliente',
        ],
        'edit' => [
            'label' => 'Modifica',
            'tooltip' => 'Modifica i dati del cliente',
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina il cliente',
            'confirmation' => 'Sei sicuro di voler eliminare questo cliente?',
        ],
        'import' => [
            'label' => 'Importa',
            'tooltip' => 'Importa clienti da file',
        ],
        'export' => [
            'label' => 'Esporta',
            'tooltip' => 'Esporta lista clienti',
        ],
        'coordinates' => [
            'label' => 'Aggiorna Coordinate',
            'tooltip' => 'Aggiorna le coordinate geografiche',
            'success' => 'Coordinate aggiornate con successo',
            'error' => 'Errore nell\'aggiornamento delle coordinate',
        ],
        'importClient' => [
            'label' => 'importClient',
        ],
        'downloadExample' => [
            'label' => 'downloadExample',
        ],
        'populateCoordinates' => [
            'label' => 'populateCoordinates',
        ],
    ],
    'messages' => [
        'created' => 'Cliente creato con successo',
        'updated' => 'Cliente aggiornato con successo',
        'deleted' => 'Cliente eliminato con successo',
        'imported' => 'Clienti importati con successo',
        'exported' => 'Clienti esportati con successo',
    ],
    'filters' => [
        'business_closed' => [
            'label' => 'Attività Chiusa',
            'options' => [
                'all' => 'Tutte',
                'active' => 'Attive',
                'closed' => 'Chiuse',
            ],
        ],
        'activity' => [
            'label' => 'Tipo Attività',
            'placeholder' => 'Seleziona attività...',
        ],
        'city' => [
            'label' => 'Città',
            'placeholder' => 'Seleziona città...',
        ],
        'province' => [
            'label' => 'Provincia',
            'placeholder' => 'Seleziona provincia...',
        ],
    ],
    'model' => [
        'label' => 'client.model',
    ],
];
