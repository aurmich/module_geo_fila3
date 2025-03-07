<?php

return [
    'navigation' => [
        'name' => 'Rappresentanti Legali',
        'group' => 'TechPlanner',
        'label' => 'Gestione Rappresentanti',
        'icon' => 'techplanner-legal-representative',
        'sort' => 81,
        'badge' => [
            'color' => 'info',
            'label' => 'Legali',
        ],
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome',
            'tooltip' => 'Nome del rappresentante legale',
            'placeholder' => 'Es. Mario Rossi',
        ],
        'surname' => [
            'label' => 'Cognome',
            'tooltip' => 'Cognome del rappresentante legale',
            'placeholder' => 'Es. Rossi',
        ],
        'tax_code' => [
            'label' => 'Codice Fiscale',
            'tooltip' => 'Codice fiscale del rappresentante',
            'placeholder' => 'Es. RSSMRA80A01H501U',
        ],
        'role' => [
            'label' => 'Ruolo',
            'tooltip' => 'Ruolo o carica ricoperta',
            'placeholder' => 'Es. Amministratore Delegato',
        ],
        'email' => [
            'label' => 'Email',
            'tooltip' => 'Indirizzo email di contatto',
            'placeholder' => 'Es. mario.rossi@azienda.it',
        ],
        'pec' => [
            'label' => 'PEC',
            'tooltip' => 'Indirizzo PEC personale',
            'placeholder' => 'Es. mario.rossi@pec.it',
        ],
        'phone' => [
            'label' => 'Telefono',
            'tooltip' => 'Numero di telefono diretto',
            'placeholder' => 'Es. +39 333 1234567',
        ],
    ],
    'sections' => [
        'personal_info' => [
            'title' => 'Dati Personali',
            'description' => 'Informazioni anagrafiche',
        ],
        'contacts' => [
            'title' => 'Contatti',
            'description' => 'Informazioni di contatto',
        ],
        'role_info' => [
            'title' => 'Informazioni Ruolo',
            'description' => 'Dettagli sulla carica',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Rappresentante',
            'tooltip' => 'Aggiungi un nuovo rappresentante legale',
        ],
        'edit' => [
            'label' => 'Modifica',
            'tooltip' => 'Modifica i dati del rappresentante',
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina il rappresentante',
            'confirmation' => 'Sei sicuro di voler eliminare questo rappresentante legale?',
        ],
    ],
    'messages' => [
        'created' => 'Rappresentante legale creato con successo',
        'updated' => 'Rappresentante legale aggiornato con successo',
        'deleted' => 'Rappresentante legale eliminato con successo',
    ],
    'filters' => [
        'role' => [
            'label' => 'Ruolo',
            'placeholder' => 'Filtra per ruolo...',
        ],
    ],
];
