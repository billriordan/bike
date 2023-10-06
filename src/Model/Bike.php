<?php

namespace App\Model;


class Bike implements ShiftInterface, BikeInterface
{
    private const GEAR_RATIO = 0.8;

    protected String $color = 'black';
    protected float $distance_travelled = 0.0;
    protected float $wheel_radius = 0.5;
    protected float $seat_height = 0.1;
    protected int $current_gear = 1;
    protected int $gears = 10;

    public function __construct(
        String $color = 'black',
        float $distance_travelled = 0.0,
        float $wheel_radius = 0.5,
        float $seat_height = 0.1,
        int $current_gear = 1,
        int $gears = 10,
    )
    {
        $this->color = $color;
        $this->distance_travelled = $distance_travelled;
        $this->set_wheel_radius($wheel_radius);
        $this->set_seat_height($seat_height);
        if ($current_gear < 1 || $curent_gear > $gears) {
            throw new \Exception('current gear must be valid.');
        }
        $this->current_gear = $current_gear;
        $this->gears = $gears;
    }

    public function set_color(String $color): void
    {
        $this->color = $color;
    }

    public function get_color(): String
    {
        return $this->color;
    }

    public function set_wheel_radius(float $radius): void
    {
        if ($radius <= 0.0) {
            throw new \Exception('wheel radius cannot be less than zero.');
        }

        $this->wheel_radius = $radius;
    }

    public function get_wheel_radius(): float
    {
        return $this->wheel_radius;
    }

    public function set_seat_height(float $height): void
    {
        if ($height <= 0.0) {
            throw new \Exception('seat height cannot be less than zero.');
        }

        $this->seat_height = $height;
    }

    public function get_seat_height(): float
    {
        return $this->height;
    }

    public function get_distance_travelled(): float
    {
        return $this->distance_travelled;
    }

    public function get_current_gear(): int
    {
        return $this->current_gear;
    }

    public function shift_up(): bool
    {
        $next_gear = min($this->current_gear + 1, $this->gears);

        $can_shift = $next_gear === $this->current_gear;

        $this->current_gear = $next_gear;
        
        return $can_shift;
    }

    public function shift_down(): bool
    {
        $next_gear = max($this->current_gear - 1, 1);

        $can_shift = $next_gear === $this->current_gear;

        $this->current_gear = $next_gear;
        
        return $can_shift;
    }

    /**
     * Pedal the bike and return the distance travelled
     * 
     * @var float $delta    The timeframe (in seconds) that we draw power over
     * @var float $throttle The percent (0..1) of power being applied to pedaling
     */
    public function pedal(float $delta, float $throttle): float
    {
        if ($delta < 0) {
            throw new \Exception('delta must be positive.');
        }

        if ($throttle < 0 || $throttle > 1.0) {
            throw new \Exception('throttle must be between 0 and 1.');
        }
        // how much percent power we are drawing in this timeframe.
        $pedal_power = $delta * $throttle;

        $distance_pedalled = $pedal_power * ($this->get_current_gear() * self::GEAR_RATIO) * (2 * pi() * $this->wheel_radius);

        $this->distance_travelled += $distance_pedalled;

        // Determine distance travelled based on power applied, gear ratio, and wheel radius.
        return $distance_pedalled;
    }
}
