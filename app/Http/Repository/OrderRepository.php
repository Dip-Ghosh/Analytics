<?php

namespace App\Http\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    private function prepareQuery(array $conditions)
    {
        return $this->model->whereBetween('booking_date', [$conditions['startDate'], $conditions['endDate']]);
    }

    public function getOrdersByDay(array $conditions)
    {
        $query = $this->prepareQuery($conditions)
            ->select(DB::raw("
                  DATE_FORMAT(booking_date, '%W') AS date,
                  group_concat(pnr) as pnr,
                  count(id) AS totalOrder"
            ));

        return $this->makeGroupOrderByQuery($query);
    }

    public function getOrdersByDate(array $conditions)
    {
        $query = $this->prepareQuery($conditions)
            ->select(DB::raw('
                booking_date AS date,
                group_concat(pnr) as pnr,
                count(id) AS totalOrder'));

        return $this->makeGroupOrderByQuery($query);
    }

    public function getOrdersByMonth(array $conditions)
    {
        $query = $this->prepareQuery($conditions)
            ->select(DB::raw("
                DATE_FORMAT(booking_date, '%M-%Y') AS date,
                group_concat(pnr) as pnr,
                count(id) AS totalOrder"));

        return $this->makeGroupOrderByQuery($query);
    }

    private function makeGroupOrderByQuery($query)
    {
        return $query->groupBy('date')
            ->orderBy('totalOrder', 'DESC')
            ->get();
    }
}