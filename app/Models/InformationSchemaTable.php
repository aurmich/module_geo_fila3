<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Sushi\Sushi;

/**
 * Modules\Xot\Models\InformationSchemaTable
 *
 * @property string      $TABLE_CATALOG   Nome del catalogo
 * @property string      $TABLE_SCHEMA    Nome dello schema
 * @property string      $TABLE_NAME      Nome della tabella
 * @property string      $TABLE_TYPE      Tipo di tabella
 * @property string|null $ENGINE          Engine del database
 * @property int|null    $VERSION         Versione
 * @property string|null $ROW_FORMAT      Formato delle righe
 * @property int|null    $TABLE_ROWS      Numero stimato di righe
 * @property int|null    $AVG_ROW_LENGTH  Lunghezza media delle righe
 * @property int|null    $DATA_LENGTH     Dimensione dei dati
 * @property int|null    $MAX_DATA_LENGTH Massima dimensione dei dati
 * @property int|null    $INDEX_LENGTH    Dimensione degli indici
 * @property int|null    $DATA_FREE       Spazio libero
 * @property int|null    $AUTO_INCREMENT  Valore auto increment
 * @property string|null $CREATE_TIME     Data di creazione
 * @property string|null $UPDATE_TIME     Data di aggiornamento
 * @property string|null $CHECK_TIME      Data ultimo check
 * @property string|null $TABLE_COLLATION Collation della tabella
 * @property int|null    $CHECKSUM        Checksum
 * @property string|null $CREATE_OPTIONS  Opzioni di creazione
 * @property string|null $TABLE_COMMENT   Commento della tabella
 */
class InformationSchemaTable extends Model
{
    use Sushi;

    /**
     * The connection name for the model.
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     */
    protected $table = 'information_schema.TABLES';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'TABLE_CATALOG',
        'TABLE_SCHEMA',
        'TABLE_NAME',
        'TABLE_TYPE',
        'ENGINE',
        'VERSION',
        'ROW_FORMAT',
        'TABLE_ROWS',
        'AVG_ROW_LENGTH',
        'DATA_LENGTH',
        'MAX_DATA_LENGTH',
        'INDEX_LENGTH',
        'DATA_FREE',
        'AUTO_INCREMENT',
        'CREATE_TIME',
        'UPDATE_TIME',
        'CHECK_TIME',
        'TABLE_COLLATION',
        'CHECKSUM',
        'CREATE_OPTIONS',
        'TABLE_COMMENT',
    ];

    /**
     * The schema for the Sushi model.
     *
     * @var array<string, string>
     */
    protected $schema = [
        'id' => 'integer',
        'TABLE_CATALOG' => 'string',
        'TABLE_SCHEMA' => 'string',
        'TABLE_NAME' => 'string',
        'TABLE_TYPE' => 'string',
        'ENGINE' => 'string',
        'VERSION' => 'integer',
        'ROW_FORMAT' => 'string',
        'TABLE_ROWS' => 'integer',
        'AVG_ROW_LENGTH' => 'integer',
        'DATA_LENGTH' => 'integer',
        'MAX_DATA_LENGTH' => 'integer',
        'INDEX_LENGTH' => 'integer',
        'DATA_FREE' => 'integer',
        'AUTO_INCREMENT' => 'integer',
        'CREATE_TIME' => 'datetime',
        'UPDATE_TIME' => 'datetime',
        'CHECK_TIME' => 'datetime',
        'TABLE_COLLATION' => 'string',
        'CHECKSUM' => 'integer',
        'CREATE_OPTIONS' => 'string',
        'TABLE_COMMENT' => 'string',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'TABLE_ROWS' => 'integer',
        'AVG_ROW_LENGTH' => 'integer',
        'DATA_LENGTH' => 'integer',
        'MAX_DATA_LENGTH' => 'integer',
        'INDEX_LENGTH' => 'integer',
        'DATA_FREE' => 'integer',
        'AUTO_INCREMENT' => 'integer',
        'CHECKSUM' => 'integer',
        'CREATE_TIME' => 'datetime',
        'UPDATE_TIME' => 'datetime',
        'CHECK_TIME' => 'datetime',
        'VERSION' => 'integer',
    ];

    public $incrementing = false;

    protected $primaryKey = ['TABLE_SCHEMA', 'TABLE_NAME'];

    /**
     * Get the rows for Sushi.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
        $query = 'SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE()';

        return DB::select($query);
    }

    /**
     * Get table statistics.
     *
     * @param string $schema Schema name
     * @param string $table  Table name
     */
    public static function getTableStats(string $schema, string $table): ?self
    {
        return static::where('TABLE_SCHEMA', $schema)
            ->where('TABLE_NAME', $table)
            ->first();
    }

    /**
     * Get accurate row count.
     *
     * @param string $tableName The name of the table
     * @param string $database  The database name
     */
    public static function getAccurateRowCount(string $tableName, string $database): int
    {
        $stats = static::getTableStats($tableName, $database);

        if (! $stats) {
            return 0;
        }

        // For InnoDB tables with less than 1000 rows or when TABLE_ROWS is 0,
        // use COUNT(*) for better accuracy
        if ('InnoDB' === $stats->ENGINE && ($stats->TABLE_ROWS < 1000 || 0 === $stats->TABLE_ROWS)) {
            try {
                return (int) DB::table($tableName)->count();
            } catch (\Exception $e) {
                // Se fallisce il count diretto, ritorna il valore stimato
                return (int) $stats->TABLE_ROWS;
            }
        }

        return (int) $stats->TABLE_ROWS;
    }

    /**
     * Get table size in bytes.
     *
     * @param string $tableName The name of the table
     * @param string $database  The database name
     */
    public static function getTableSize(string $tableName, string $database): int
    {
        $stats = static::getTableStats($tableName, $database);

        if (! $stats) {
            return 0;
        }

        return (int) ($stats->DATA_LENGTH + $stats->INDEX_LENGTH);
    }

    /**
     * Refresh the Sushi cache for a specific table.
     *
     * @param string $tableName The name of the table
     * @param string $database  The database name
     */
    public static function refreshCache(string $tableName, string $database): void
    {
        $query = 'SELECT * FROM information_schema.TABLES 
                 WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?';

        $result = DB::selectOne($query, [$database, $tableName]);

        if ($result) {
            $data = (array) $result;
            static::updateOrCreate(
                [
                    'TABLE_SCHEMA' => $database,
                    'TABLE_NAME' => $tableName,
                ],
                $data
            );
        }
    }
}
