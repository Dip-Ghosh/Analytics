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
        $startDate = new Carbon('2022-01-01');
        $endDate   = new Carbon('2023-02-30');
        $count     = 0;

        while ($startDate->lte($endDate)) {
            $randomNumber = rand(1, 20);

            //to make a random numbers of orders in a particular day
            while ($count <= $randomNumber) {
                Order::create([
                    "pnr"          => Str::random(15),
                    "booking_date" => $startDate,
                ]);
                $count++;
            }
            $startDate->addDay();
            $count = 0;
        }
    }
}
