<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

class CalcolaDistanzaGeografica
{
    public function execute(float $lat1, float $lon1, string $lat2, string $lon2): float
    {
        // Raggio della Terra in chilometri
        $raggioTerra = 6371;

        // Conversione delle latitudini e longitudini da gradi a radianti
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad((float) $lat2);
        $lon2 = deg2rad((float) $lon2);

        // Differenza tra le coordinate
        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        // Applicazione della formula dell'Haversine
        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Calcolo della distanza
        $distanza = $raggioTerra * $c;

        return $distanza; // Distanza in chilometri
    }
}
