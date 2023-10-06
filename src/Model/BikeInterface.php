<?php

namespace App\Model;


interface BikeInterface
{
    public function set_color(String $color): void;

    public function get_color(): String;

    public function set_wheel_radius(float $radius): void;

    public function get_wheel_radius(): float;

    public function set_seat_height(float $height): void;

    public function get_seat_height(): float;

    public function get_distance_travelled(): float;

    public function pedal(float $delta, float $throttle): float;
}