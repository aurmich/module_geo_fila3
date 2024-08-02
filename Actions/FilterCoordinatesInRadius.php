<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Modules\Ticket\Models\GeoTicket;

class FilterCoordinatesInRadius
{
    // filtra Coordinate In Raggio
    public function execute($latPartenza, $lonPartenza, $coordinateArray, $raggio)
    {
        $coordinateInRaggio = [];

        foreach ($coordinateArray as $coordinate) {
            $lat = $coordinate['lat'];
            $lon = $coordinate['lon'];
    
            $distanza = calcolaDistanzaGeografica($latPartenza, $lonPartenza, $lat, $lon);
    
            if ($distanza <= $raggio) {
                $coordinateInRaggio[] = $coordinate;
            }
        }
    
        return $coordinateInRaggio;
    }


    function calcolaDistanzaGeografica($lat1, $lon1, $lat2, $lon2)
    {
        // Raggio della Terra in chilometri
        $raggioTerra = 6371;
    
        // Conversione delle latitudini e longitudini da gradi a radianti
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
    
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


// // Raggio in chilometri
// $raggio = 10; // 10 km

// // Filtra le coordinate all'interno del raggio
// $coordinateInRaggio = filtraCoordinateInRaggio($latPartenza, $lonPartenza, $coordinateArray, $raggio);

// print_r($coordinateInRaggio);