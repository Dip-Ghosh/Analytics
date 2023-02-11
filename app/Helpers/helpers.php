<?php

use DateTime;

if (!function_exists('getDays')) {

    function getDays(array $params): int
    {
        $startDate = new DateTime($params['startDate']);
        $endDate   = new DateTime($params['endDate']);

        return (int)$endDate->diff($startDate)->format('%a');
    }
}