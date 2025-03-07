<?php

return [
    'navigation' => [
        'name' => 'Sedi Legali',
        'group' => 'TechPlanner',
        'label' => 'Gestione Sedi',
        'icon' => 'techplanner-legal-office',
        'sort' => 20,
        'badge' => [
            'color' => 'success',
            'label' => 'Attive',
        ],
    ],
    'fields' => [
        'name' => [
            'label' => 'Nome Sede',
            'tooltip' => 'Nome identificativo della sede',
            'placeholder' => 'Es. Sede Centrale',
        ],
        'type' => [
            'label' => 'Tipo Sede',
            'tooltip' => 'Tipologia della sede',
            'placeholder' => 'Es. Sede Legale',
            'options' => [
                'legal' => 'Sede Legale',
                'operational' => 'Sede Operativa',
                'administrative' => 'Sede Amministrativa',
                'branch' => 'Filiale',
            ],
        ],
        'address' => [
            'label' => 'Indirizzo',
            'tooltip' => 'Indirizzo completo della sede',
            'placeholder' => 'Es. Via Roma 123',
        ],
        'city' => [
            'label' => 'Città',
            'tooltip' => 'Città dove si trova la sede',
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
            'tooltip' => 'Nazione dove si trova la sede',
            'placeholder' => 'Es. Italia',
        ],
        'phone' => [
            'label' => 'Telefono',
            'tooltip' => 'Numero di telefono della sede',
            'placeholder' => 'Es. +39 02 1234567',
        ],
        'email' => [
            'label' => 'Email',
            'tooltip' => 'Indirizzo email della sede',
            'placeholder' => 'Es. sede.milano@azienda.it',
        ],
        'pec' => [
            'label' => 'PEC',
            'tooltip' => 'Indirizzo PEC della sede',
            'placeholder' => 'Es. sede.milano@pec.it',
        ],
    ],
    'sections' => [
        'basic_info' => [
            'title' => 'Informazioni Base',
            'description' => 'Dati principali della sede',
        ],
        'address' => [
            'title' => 'Indirizzo',
            'description' => 'Ubicazione della sede',
        ],
        'contacts' => [
            'title' => 'Contatti',
            'description' => 'Informazioni di contatto',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuova Sede',
            'tooltip' => 'Aggiungi una nuova sede',
        ],
        'edit' => [
            'label' => 'Modifica',
            'tooltip' => 'Modifica i dati della sede',
        ],
        'delete' => [
            'label' => 'Elimina',
            'tooltip' => 'Elimina la sede',
            'confirmation' => 'Sei sicuro di voler eliminare questa sede?',
        ],
    ],
    'messages' => [
        'created' => 'Sede creata con successo',
        'updated' => 'Sede aggiornata con successo',
        'deleted' => 'Sede eliminata con successo',
    ],
    'filters' => [
        'type' => [
            'label' => 'Tipo Sede',
            'placeholder' => 'Filtra per tipo...',
        ],
        'city' => [
            'label' => 'Città',
            'placeholder' => 'Filtra per città...',
        ],
        'province' => [
            'label' => 'Provincia',
            'placeholder' => 'Filtra per provincia...',
        ],
    ],
];
