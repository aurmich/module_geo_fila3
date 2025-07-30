<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use function Safe\json_decode;
>>>>>>> 0d1465e6e (.)
=======
use function Safe\json_decode;
>>>>>>> fc4bfbb (.)

class Locality extends BaseModel
{
    use \Sushi\Sushi;

    
    protected array $schema = [
        'region_id' => 'integer',
        'province_id' => 'integer',
        'id' => 'integer',
        'name' => 'string',
        'postal_code' => 'json',
    ];
    


    public function getRows(): array{
        $rows=Comune::select("regione->codice as region_id","provincia->codice as province_id","nome as name","codice as id","cap as postal_code")
            ->distinct()
            ->orderBy("nome")
<<<<<<< HEAD
<<<<<<< HEAD
            ->get();
=======
=======
>>>>>>> fc4bfbb (.)
            ->get()
            ->map(function($row){
                /** @phpstan-ignore offsetAccess.nonOffsetAccessible, property.notFound */
                $postal_code=json_decode($row->postal_code)[0];
                /** @phpstan-ignore property.notFound */
                $row->postal_code=$postal_code;
                return $row;
            });
            
<<<<<<< HEAD
>>>>>>> 0d1465e6e (.)
=======
>>>>>>> fc4bfbb (.)
       
        return $rows->toArray();
    }
}