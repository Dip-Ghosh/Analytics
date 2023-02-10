<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $startDate = new Carbon('2020-01-01');
        $endDate   = new Carbon('2023-02-30');

        while($startDate->lte($endDate)){
            Order::create([
                "pnr"          => Str::random(15),
                "booking_date" => $startDate,
            ]);
            $startDate->addDay();
        }
    }
}
