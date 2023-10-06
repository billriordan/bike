<?php

namespace App\Factory;

use App\Model\ElectricBike;

class ElectricBikeFactory implements FactoryInterface
{
    public static function create(array $data = []): ElectricBike
    {
        $color = $data['color'] ?? 'black';
        $distance_travelled = $data['distance_travelled'] ?? 0.0;
        $wheel_radius = $data['wheel_radius'] ?? 0.5;
        $seat_height = $data['seat_height'] ?? 0.1;
        $current_gear = $data['current_gear'] ?? 1;
        $gears = $data['gears'] ?? 10;

        $battery_percent = $data['battery_percent'] ?? 100.0;

        return new ElectricBike($battery_percent, $color, $distance_travelled, $wheel_radius, $seat_height, $current_gear, $gears);
    }
}