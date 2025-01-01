<?php

declare(strict_types=1);

return [
    // 'resources' => 'Risorse',
    'pages' => 'Pagine',
    'widgets' => 'Widgets',
    'navigation' => [
        'name' => 'Failed Import Row',
        'plural' => 'Failed Import Rows',
        'group' => [
            'name' => 'Import/Export',
        ],
    ],
    'fields' => [
        'id' => ['label' => 'ID'],
        'data' => ['label' => 'Data'],
        'import_id' => ['label' => 'Import Id'],
        'validation_error' => ['label' => 'Validation Error'],
        'name' => 'Nome',
        'guard_name' => 'Guard',
        'permissions' => 'Permessi',
        'updated_at' => 'Aggiornato il',
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'select_all' => [
            'name' => 'Seleziona Tutti',
            'message' => '',
        ],
    ],
    'actions' => [
        'import' => [
            'fields' => [
                'import_file' => 'Seleziona un file XLS o CSV da caricare',
            ],
        ],
        'export' => [
            'filename_prefix' => 'Aree al',
            'columns' => [
                'name' => 'Nome area',
                'parent_name' => 'Nome area livello superiore',
            ],
        ],
    ],
];
