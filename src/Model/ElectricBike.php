<?php

namespace App\Model;


class ElectricBike extends Bike implements BatteryInterface
{
    /** The number of rotations that can be applied per percent of battery */
    private const ROTATIONS_PER_PERCENT = 10.0;

    /** The instantaneous power output */
    private const POWER_OUTPUT = 0.5;

    protected float $battery_percent = 100.0;

    public function __construct(
        float $battery_percent = 100.0,
        String $color = 'black',
        float $distance_travelled = 0.0,
        float $wheel_radius = 0.5,
        float $seat_height = 0.1,
        int $current_gear = 1,
        int $gears = 10,
    )
    {
        parent::__construct($color, $distance_travelled, $wheel_radius, $seat_height, $current_gear, $gears);

        $this->battery_percent = $battery_percent;
    }

    public function get_battery_percent(): int
    {
        return $this->battery_percent;
    }

    public function get_expected_range(): float
    {
        return $this->battery_percent * self::ROTATIONS_PER_PERCENT;
    }

    /**
     * Draw Power from the battery and return the distance travelled
     * 
     * @var float $delta    The timeframe (in seconds) that we draw power over
     * @var float $throttle The percent (0..1) the throttle is engaged
     */
    public function draw_power(float $delta, float $throttle): float
    {
        // how much percent power we are drawing in this timeframe.
        $draw = self::POWER_OUTPUT * $delta * $throttle;

        $amount_drawn = min($this->battery_percent, $draw);

        $this->battery_percent -= $amount_drawn;

        $distance_powered = ($amount_drawn * self::ROTATIONS_PER_PERCENT) * (2 * pi() * $this->wheel_radius);

        $this->distance_travelled += $distance_powered;

        return $distance_powered;
    }
}
