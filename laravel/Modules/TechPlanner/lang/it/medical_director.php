<?php

return [
    'navigation' => [
        'name' => 'Direttori Sanitari',
        'group' => 'TechPlanner',
        'label' => 'Gestione Direttori',
        'icon' => 'techplanner-medical-director',
        'sort' => 17,
        'badge' => [
            'color' => 'warning',
            'label' => 'Medici',
        ],
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'tooltip' => 'Nome del direttore sanitario',
            'placeholder' => 'Es. Dott. Mario Rossi',
        ],
        'license_number' => [
            'label' => 'Numero Iscrizione',
            'tooltip' => 'Numero di iscrizione all\'Ordine dei Medici',
            'placeholder' => 'Es. MI-12345',
        ],
        'specialization' => [
            'label' => 'Specializzazione',
            'tooltip' => 'Specializzazione medica',
            'placeholder' => 'Es. Medicina del Lavoro',
        ],
        'license_expiry' => [
            'label' => 'Scadenza Iscrizione',
            'tooltip' => 'Data di scadenza dell\'iscrizione all\'Ordine',
            'placeholder' => 'Es. 31/12/2024',
        ],
        'email' => [
            'label' => 'Email',
            'tooltip' => 'Indirizzo email professionale',
            'placeholder' => 'Es. dott.rossi@studio.it',
        ],
        'pec' => [
            'label' => 'PEC',
            'tooltip' => 'Indirizzo PEC professionale',
            'placeholder' => 'Es. mario.rossi@pec.omceo.it',
        ],
        'phone' => [
            'label' => 'Telefono',
            'tooltip' => 'Numero di telefono professionale',
            'placeholder' => 'Es. +39 02 1234567',
        ],
        'mobile' => [
            'label' => 'Cellulare',
            'tooltip' => 'Numero di cellulare',
            'placeholder' => 'Es. +39 333 1234567',
        ],
        'notes' => [
            'label' => 'Note',
            'tooltip' => 'Annotazioni aggiuntive',
            'placeholder' => 'Inserisci eventuali note...',
        ],
    ],
    'sections' => [
        'personal_info' => [
            'title' => 'Dati Personali',
            'description' => 'Informazioni anagrafiche',
        ],
        'professional_info' => [
            'title' => 'Dati Professionali',
            'description' => 'Informazioni sulla professione medica',
        ],
        'contacts' => [
            'title' => 'Contatti',
            'description' => 'Informazioni di contatto',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Direttore',
            'tooltip' => 'Aggiungi un nuovo direttore sanitario',
        ],
        'edit' => [
            'label' => 'Modifica',
            'tooltip' => 'Modifica i dati del direttore',
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina il direttore',
            'confirmation' => 'Sei sicuro di voler eliminare questo direttore sanitario?',
        ],
    ],
    'messages' => [
        'created' => 'Direttore sanitario creato con successo',
        'updated' => 'Direttore sanitario aggiornato con successo',
        'deleted' => 'Direttore sanitario eliminato con successo',
        'license_expiring' => 'Attenzione: l\'iscrizione all\'Ordine scadrà tra {days} giorni',
        'license_expired' => 'Attenzione: l\'iscrizione all\'Ordine è scaduta',
    ],
    'filters' => [
        'specialization' => [
            'label' => 'Specializzazione',
            'placeholder' => 'Filtra per specializzazione...',
        ],
        'license_status' => [
            'label' => 'Stato Iscrizione',
            'options' => [
                'valid' => 'Valida',
                'expiring' => 'In Scadenza',
                'expired' => 'Scaduta',
            ],
        ],
    ],
];
