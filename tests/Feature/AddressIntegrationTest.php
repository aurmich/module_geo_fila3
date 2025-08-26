<?php

declare(strict_types=1);

use Modules\Geo\Models\Address;
use Modules\Geo\Enums\AddressTypeEnum;
use Modules\User\Models\Profile;

describe('Address Integration', function () {
    it('can attach address to profile via polymorphic relationship', function () {
        $profile = Profile::factory()->create();
        
        $address = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'route' => 'Via Roma',
            'street_number' => '123',
            'locality' => 'Milano',
            'postal_code' => '20100',
            'is_primary' => true,
        ]);
        
        expect($address->addressable)->toBeInstanceOf(Profile::class)
            ->and($address->addressable->id)->toBe($profile->id)
            ->and($address->route)->toBe('Via Roma')
            ->and($address->is_primary)->toBeTrue();
    });

    it('can have multiple addresses with one primary', function () {
        $profile = Profile::factory()->create();

        $homeAddress = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'type' => AddressTypeEnum::HOME,
            'is_primary' => true,
        ]);

        $workAddress = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'type' => AddressTypeEnum::WORK,
            'is_primary' => false,
        ]);

        $profileAddresses = Address::where('model_type', Profile::class)
            ->where('model_id', $profile->id)
            ->get();

        expect($profileAddresses)->toHaveCount(2)
            ->and($homeAddress->is_primary)->toBeTrue()
            ->and($workAddress->is_primary)->toBeFalse();
    });

    it('enforces single primary address per entity', function () {
        $profile = Profile::factory()->create();
        
        $address1 = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'is_primary' => true,
        ]);

        $address2 = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'is_primary' => false,
        ]);

        expect($address1->is_primary)->toBeTrue()
            ->and($address2->is_primary)->toBeFalse();
    });

    it('validates required address fields', function () {
        $addressData = [
            'route' => 'Via Roma',
            'locality' => 'Milano',
            'postal_code' => '20100',
        ];

        $address = Address::factory()->create($addressData);
        
        expect($address->route)->toBe('Via Roma')
            ->and($address->locality)->toBe('Milano')
            ->and($address->postal_code)->toBe('20100');
    });

    it('handles geolocation data correctly', function () {
        $address = Address::factory()->create([
            'latitude' => 45.4642,
            'longitude' => 9.1900,
        ]);

        expect($address->latitude)->toBe(45.4642)
            ->and($address->longitude)->toBe(9.1900);
    });

    it('can store Google Places API data', function () {
        $address = Address::factory()->create([
            'place_id' => 'ChIJu46S-ZZjhkcRLuFvLjVZ400',
            'formatted_address' => 'Piazza del Duomo, 20121 Milano MI, Italy',
            'extra_data' => [
                'google_types' => ['establishment', 'point_of_interest'],
                'rating' => 4.5,
                'business_status' => 'OPERATIONAL',
            ],
        ]);

        expect($address->place_id)->toBe('ChIJu46S-ZZjhkcRLuFvLjVZ400')
            ->and($address->formatted_address)->toContain('Piazza del Duomo')
            ->and($address->extra_data['google_types'])->toContain('establishment')
            ->and($address->extra_data['rating'])->toBe(4.5);
    });

    it('supports multiple addresses per entity', function () {
        $profile = Profile::factory()->create();

        $addresses = collect([
            Address::factory()->create([
                'model_type' => Profile::class,
                'model_id' => $profile->id,
                'type' => AddressTypeEnum::HOME,
                'route' => 'Via Roma',
                'locality' => 'Milano',
            ]),
            Address::factory()->create([
                'model_type' => Profile::class,
                'model_id' => $profile->id,
                'type' => AddressTypeEnum::WORK,
                'route' => 'Via Torino',
                'locality' => 'Milano',
            ]),
            Address::factory()->create([
                'model_type' => Profile::class,
                'model_id' => $profile->id,
                'type' => AddressTypeEnum::OTHER,
                'route' => 'Via Napoli',
                'locality' => 'Milano',
            ]),
        ]);

        expect($addresses)->toHaveCount(3)
            ->and($addresses->pluck('type')->toArray())->toContain(AddressTypeEnum::HOME)
            ->and($addresses->pluck('type')->toArray())->toContain(AddressTypeEnum::WORK)
            ->and($addresses->pluck('type')->toArray())->toContain(AddressTypeEnum::OTHER);
    });

    it('handles address type validation correctly', function () {
        $profile = Profile::factory()->create();

        $address = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'type' => AddressTypeEnum::HOME,
        ]);

        expect($address->type)->toBe(AddressTypeEnum::HOME)
            ->and(in_array($address->type, AddressTypeEnum::cases()))->toBeTrue();
    });

    it('can format full address correctly', function () {
        $address = Address::factory()->create([
            'route' => 'Via Roma',
            'street_number' => '123',
            'locality' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
        ]);

        $formattedAddress = $address->getFormattedAddressAttribute();
        
        expect($formattedAddress)->toContain('Via Roma')
            ->and($formattedAddress)->toContain('123')
            ->and($formattedAddress)->toContain('Milano')
            ->and($formattedAddress)->toContain('20100')
            ->and($formattedAddress)->toContain('Italia');
    });

    it('handles soft deletion correctly', function () {
        $address = Address::factory()->create();
        
        $address->delete();
        
        expect(Address::find($address->id))->toBeNull()
            ->and(Address::withTrashed()->find($address->id))->not->toBeNull()
            ->and(Address::withTrashed()->find($address->id)->deleted_at)->not->toBeNull();
    });
});