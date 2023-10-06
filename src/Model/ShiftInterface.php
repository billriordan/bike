<?php

namespace App\Model;


interface ShiftInterface
{
    public function get_current_gear(): int;

    public function shift_up(): bool;

    public function shift_down(): bool;
}