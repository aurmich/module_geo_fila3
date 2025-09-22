<?php

declare(strict_types=1);

use Modules\Geo\Models\Province;

describe('Province Business Logic', function () {
    test('province extends base model', function () {
        expect(Province::class)->toBeSubclassOf(\Modules\Geo\Models\BaseModel::class);
    });

    test('province has factory trait for testing', function () {
        $traits = class_uses(Province::class);
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        expect($traits)->toHaveKey(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
    });

    test('province uses sushi trait for in-memory data', function () {
        $traits = class_uses(Province::class);
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        expect($traits)->toHaveKey(\Sushi\Sushi::class);
    });

    test('province has schema definition for geographic hierarchy', function () {
        $province = new Province();
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        expect($province)->toHaveProperty('schema');
        expect($province->schema['region_id'])->toBe('integer');
        expect($province->schema['id'])->toBe('integer');
        expect($province->schema['name'])->toBe('string');
    });

    test('province can get rows from comune data', function () {
        $province = new Province();
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        expect(method_exists($province, 'getRows'))->toBeTrue();
        expect($province->getRows())->toBeArray();
    });

    test('province model can be instantiated without errors', function () {
        $province = new Province();
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        expect($province)->toBeInstanceOf(Province::class);
        expect($province)->toBeInstanceOf(\Modules\Geo\Models\BaseModel::class);
    });

    test('province can be queried by name', function () {
        $query = Province::whereName('Milano');
<<<<<<< HEAD

=======
        
>>>>>>> 19c8248 (.)
        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });

    test('province can be queried by region id', function () {
        $query = Province::whereRegionId(1);
<<<<<<< HEAD

        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });
});
=======
        
        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });
});
>>>>>>> 19c8248 (.)
