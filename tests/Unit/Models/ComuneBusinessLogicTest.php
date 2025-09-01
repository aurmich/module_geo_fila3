<?php

declare(strict_types=1);

use Modules\Geo\Models\Comune;

describe('Comune Business Logic', function () {
    test('comune extends base model', function () {
        expect(Comune::class)->toBeSubclassOf(\Modules\Geo\Models\BaseModel::class);
    });

    test('comune has factory trait for testing', function () {
        $traits = class_uses(Comune::class);
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($traits)->toHaveKey(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
    });

    test('comune has sushi to json trait', function () {
        $traits = class_uses(Comune::class);
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($traits)->toHaveKey(\Modules\Tenant\Models\Traits\SushiToJson::class);
    });

    test('comune has expected fillable fields for italian municipalities', function () {
<<<<<<< HEAD
        $comune = new Comune;
=======
        $comune = new Comune();
>>>>>>> 63c6dd4 (.)
        $expectedFillable = [
            'id',
            'codice',
            'nome',
            'regione',
            'provincia',
            'sigla_provincia',
            'cap',
            'codice_catastale',
            'popolazione',
            'zona_altimetrica',
            'altitudine',
            'superficie',
            'lat',
            'lng',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($comune->getFillable())->toEqual($expectedFillable);
    });

    test('comune has schema definition for structured geographic data', function () {
<<<<<<< HEAD
        $comune = new Comune;

=======
        $comune = new Comune();
        
>>>>>>> 63c6dd4 (.)
        expect($comune)->toHaveProperty('schema');
        expect($comune->schema['zona'])->toBe('json');
        expect($comune->schema['provincia'])->toBe('json');
        expect($comune->schema['regione'])->toBe('json');
        expect($comune->schema['cap'])->toBe('json');
    });

    test('comune has json directory property for data source', function () {
<<<<<<< HEAD
        $comune = new Comune;

=======
        $comune = new Comune();
        
>>>>>>> 63c6dd4 (.)
        expect($comune)->toHaveProperty('jsonDirectory');
        expect($comune->jsonDirectory)->toBeString();
    });

    test('comune has translatable array configured', function () {
<<<<<<< HEAD
        $comune = new Comune;

=======
        $comune = new Comune();
        
>>>>>>> 63c6dd4 (.)
        expect($comune->translatable)->toBeArray();
    });

    test('comune model can be instantiated without errors', function () {
<<<<<<< HEAD
        $comune = new Comune;

        expect($comune)->toBeInstanceOf(Comune::class);
        expect($comune)->toBeInstanceOf(\Modules\Geo\Models\BaseModel::class);
    });
});
=======
        $comune = new Comune();
        
        expect($comune)->toBeInstanceOf(Comune::class);
        expect($comune)->toBeInstanceOf(\Modules\Geo\Models\BaseModel::class);
    });
});
>>>>>>> 63c6dd4 (.)
