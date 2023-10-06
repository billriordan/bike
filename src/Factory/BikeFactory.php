<?php

namespace App\Factory;

use App\Model\Bike;

class BikeFactory implements FactoryInterface
{
    public static function create(array $data = []): Bike
    {
        $color = $data['color'] ?? 'black';
        $distance_travelled = $data['distance_travelled'] ?? 0.0;
        $wheel_radius = $data['wheel_radius'] ?? 0.5;
        $seat_height = $data['seat_height'] ?? 0.1;
        $current_gear = $data['current_gear'] ?? 1;
        $gears = $data['gears'] ?? 10;

        return new Bike($color, $distance_travelled, $wheel_radius, $seat_height, $current_gear, $gears);
    }
}