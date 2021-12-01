<?php

namespace App\Http\Traits;

trait MathTrait
{
    /**
     * @param mixed $last_average
     * @param int $value
     * @param int $total_numbers
     * @return float|int
     */
    public function average($last_average, int $value, int $total_numbers): float
    {
        return round((($last_average * $total_numbers) + $value) / ($total_numbers + 1), 1);
    }
}
