<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Sessioni',
        'plural' => 'Sessioni',
        'group' => [
            'name' => 'Sistema',
            'description' => 'Gestione delle sessioni utente e sicurezza',
        ],
        'label' => 'session',
        'sort' => 18,
        'icon' => 'xot-session',
    ],
    'fields' => [
        'id' => [
            'label' => 'ID',
            'placeholder' => 'Inserisci ID',
            'help' => 'Identificativo univoco della sessione',
        ],
        'user_id' => [
            'label' => 'ID Utente',
            'placeholder' => 'ID dell\'utente',
            'help' => 'ID dell\'utente associato alla sessione',
        ],
        'ip_address' => [
            'label' => 'Indirizzo IP',
            'placeholder' => 'Indirizzo IP',
            'help' => 'Indirizzo IP dell\'utente',
        ],
        'user_agent' => [
            'label' => 'User Agent',
            'placeholder' => 'User Agent del browser',
            'help' => 'Informazioni sul browser dell\'utente',
        ],
        'payload' => [
            'label' => 'Payload',
            'help' => 'Dati della sessione in formato chiave-valore',
        ],
        'last_activity' => [
            'label' => 'Ultima Attività',
            'placeholder' => 'Timestamp ultima attività',
            'help' => 'Timestamp dell\'ultima attività dell\'utente',
        ],
        'location' => [
            'label' => 'Posizione',
            'help' => 'Localizzazione geografica approssimativa',
        ],
        'size' => [
            'label' => 'Dimensione',
            'help' => 'Dimensione dei dati in memoria',
        ],
        'created_at' => [
            'label' => 'Data Creazione',
            'help' => 'Momento di inizio della sessione',
        ],
        'expires_at' => [
            'label' => 'Scadenza',
            'help' => 'Momento di scadenza previsto',
        ],
    ],
    'actions' => [
        'view' => [
            'label' => 'Visualizza',
            'success' => 'Dettagli sessione visualizzati',
            'error' => 'Impossibile visualizzare la sessione',
        ],
        'delete' => [
            'label' => 'Termina',
            'success' => 'Sessione terminata con successo',
            'error' => 'Impossibile terminare la sessione',
            'confirm' => 'Sei sicuro di voler terminare questa sessione?',
        ],
        'delete_all' => [
            'label' => 'Termina Tutte',
            'success' => 'Tutte le sessioni terminate',
            'error' => 'Impossibile terminare tutte le sessioni',
            'confirm' => 'Sei sicuro di voler terminare tutte le sessioni?',
        ],
        'delete_expired' => [
            'label' => 'Pulisci Scadute',
            'success' => 'Sessioni scadute rimosse',
            'error' => 'Impossibile rimuovere le sessioni scadute',
        ],
        'refresh' => [
            'label' => 'Aggiorna',
            'success' => 'Elenco sessioni aggiornato',
            'error' => 'Impossibile aggiornare l\'elenco',
        ],
    ],
    'messages' => [
        'status' => [
            'active' => 'Sessione attiva',
            'expired' => 'Sessione scaduta',
            'idle' => 'Sessione inattiva',
            'terminated' => 'Sessione terminata',
        ],
        'errors' => [
            'not_found' => 'Sessione non trovata',
            'invalid' => 'Sessione non valida',
            'expired' => 'Sessione scaduta',
            'permission' => 'Permessi insufficienti',
            'delete_current' => 'Impossibile terminare la sessione corrente',
        ],
        'warnings' => [
            'delete_current' => 'Stai per terminare la tua sessione attuale',
            'delete_all' => 'Tutti gli utenti verranno disconnessi',
            'inactivity' => 'La sessione scadrà tra poco per inattività',
            'multiple_sessions' => 'Rilevate sessioni multiple per lo stesso utente',
        ],
        'info' => [
            'cleanup_scheduled' => 'Pulizia automatica programmata',
            'session_extended' => 'Durata sessione estesa',
            'activity_detected' => 'Rilevata nuova attività',
        ],
    ],
    'settings' => [
        'lifetime' => [
            'label' => 'Durata Sessione',
            'help' => 'Tempo massimo di inattività',
            'options' => [
                '120' => '2 ore',
                '240' => '4 ore',
                '480' => '8 ore',
                '720' => '12 ore',
                '1440' => '1 giorno',
                '10080' => '1 settimana',
            ],
        ],
        'security' => [
            'secure' => [
                'label' => 'HTTPS Obbligatorio',
                'help' => 'Richiedi connessione sicura',
            ],
            'same_site' => [
                'label' => 'Politica Same Site',
                'help' => 'Restrizioni di accesso ai cookie',
                'options' => [
                    'lax' => 'Lax (consigliato)',
                    'strict' => 'Strict (più sicuro)',
                    'none' => 'Nessuna (meno sicuro)',
                ],
            ],
            'http_only' => [
                'label' => 'Solo HTTP',
                'help' => 'Previeni accesso JavaScript',
            ],
        ],
        'storage' => [
            'driver' => [
                'label' => 'Driver',
                'help' => 'Sistema di memorizzazione',
                'options' => [
                    'file' => 'File System',
                    'redis' => 'Redis',
                    'database' => 'Database',
                    'array' => 'Array (test)',
                ],
            ],
            'cleanup' => [
                'label' => 'Pulizia Automatica',
                'help' => 'Rimozione sessioni scadute',
            ],
        ],
    ],
];
