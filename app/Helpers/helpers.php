<?php

use DateTime;

if (!function_exists('getDays')) {

    function getDays(array $conditions): int
    {
        $startDate = new DateTime($conditions['startDate']);
        $endDate   = new DateTime($conditions['endDate']);

        return (int)$endDate->diff($startDate)->format('%a');
    }
}