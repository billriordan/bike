<?php

namespace App\Model;


interface BatteryInterface
{
    public function get_battery_percent(): int;

    public function get_expected_range(): float;

    public function draw_power(float $delta, float $throttle): float;
}