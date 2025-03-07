<?php

return [
    'navigation' => [
        'group' => 'TechPlanner',
        'label' => 'Dispositivi',
        'icon' => 'techplanner-device',
        'sort' => 33,
        'badge' => 'Gestione',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
        ],
        'name' => [
            'label' => 'Nome',
        ],
        'serial_number' => [
            'label' => 'Numero Seriale',
        ],
        'model' => [
            'label' => 'Modello',
        ],
        'manufacturer' => [
            'label' => 'Produttore',
        ],
        'purchase_date' => [
            'label' => 'Data Acquisto',
        ],
        'warranty_expiration' => [
            'label' => 'Scadenza Garanzia',
        ],
        'notes' => [
            'label' => 'Note',
        ],
        'client' => [
            'name' => [
                'label' => 'Nome Cliente',
            ],
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Nuovo Dispositivo',
            'success' => 'Dispositivo creato con successo',
        ],
        'edit' => [
            'label' => 'Modifica Dispositivo',
            'success' => 'Dispositivo aggiornato con successo',
        ],
        'delete' => [
            'label' => 'Elimina Dispositivo',
            'success' => 'Dispositivo eliminato con successo',
            'confirmation' => 'Sei sicuro di voler eliminare questo dispositivo?',
        ],
        'view' => [
            'label' => 'Visualizza Dispositivo',
        ],
    ],
    'messages' => [
        'created' => 'Dispositivo creato con successo',
        'updated' => 'Dispositivo aggiornato con successo',
        'deleted' => 'Dispositivo eliminato con successo',
    ],
    'status' => [
        'active' => 'Attivo',
        'inactive' => 'Inattivo',
        'warranty_valid' => 'In Garanzia',
        'warranty_expired' => 'Garanzia Scaduta',
    ],
    'model' => [
        'label' => 'Dispositivo',
        'plural' => 'Dispositivi',
    ],
];
