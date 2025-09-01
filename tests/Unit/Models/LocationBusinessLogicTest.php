<?php

declare(strict_types=1);

use Modules\Geo\Models\Location;

describe('Location Business Logic', function () {
    test('location extends base model', function () {
        expect(Location::class)->toBeSubclassOf(\Modules\Geo\Models\BaseModel::class);
    });

    test('location has factory trait for testing', function () {
        $traits = class_uses(Location::class);
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($traits)->toHaveKey(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
    });

    test('location can be queried within distance scope', function () {
        $query = Location::withinDistance(45.4642, 9.1900, 10.0);
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });

    test('location has geographic coordinate properties', function () {
<<<<<<< HEAD
        $location = new Location;
        $location->lat = 45.4642;
        $location->lng = 9.1900;

=======
        $location = new Location();
        $location->lat = 45.4642;
        $location->lng = 9.1900;
        
>>>>>>> 63c6dd4 (.)
        expect($location->lat)->toBe(45.4642);
        expect($location->lng)->toBe(9.1900);
    });

    test('location can store address components', function () {
<<<<<<< HEAD
        $location = new Location;
=======
        $location = new Location();
>>>>>>> 63c6dd4 (.)
        $location->street = 'Via Roma 123';
        $location->city = 'Milano';
        $location->state = 'Lombardia';
        $location->zip = '20121';
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($location->street)->toBe('Via Roma 123');
        expect($location->city)->toBe('Milano');
        expect($location->state)->toBe('Lombardia');
        expect($location->zip)->toBe('20121');
    });

    test('location has processing status tracking', function () {
<<<<<<< HEAD
        $location = new Location;
        $location->processed = true;

=======
        $location = new Location();
        $location->processed = true;
        
>>>>>>> 63c6dd4 (.)
        expect($location->processed)->toBe(true);
    });

    test('location can store formatted address', function () {
<<<<<<< HEAD
        $location = new Location;
        $location->formatted_address = 'Via Roma 123, 20121 Milano MI, Italy';

=======
        $location = new Location();
        $location->formatted_address = 'Via Roma 123, 20121 Milano MI, Italy';
        
>>>>>>> 63c6dd4 (.)
        expect($location->formatted_address)->toBe('Via Roma 123, 20121 Milano MI, Italy');
    });

    test('location can be queried by city', function () {
        $query = Location::whereCity('Milano');
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });

    test('location can be queried by coordinates', function () {
        $query = Location::whereLat(45.4642)->whereLng(9.1900);
<<<<<<< HEAD

=======
        
>>>>>>> 63c6dd4 (.)
        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });

    test('location can be queried by processing status', function () {
        $query = Location::whereProcessed(true);
<<<<<<< HEAD

        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });
});
=======
        
        expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
    });
});
>>>>>>> 63c6dd4 (.)
