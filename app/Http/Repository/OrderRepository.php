<?php

namespace App\Http\Repository;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    private function prepareQuery(array $conditions)
    {
        return $this->model->whereBetween('booking_date', [$conditions['startDate'], $conditions['endDate']]);
    }

    public function getOrderByDay(array $conditions)
    {
        $query = $this->prepareQuery($conditions)
            ->select(DB::raw('
                  DATE_FORMAT(booking_date, \'%W\') AS date,
                  group_concat(pnr) as pnr,
                  count(id) AS totalOrder'
            ));

        return $this->getGroupByDate($query);
    }

    public function getOrderByDate(array $conditions)
    {
        $query = $this->prepareQuery($conditions)
            ->select(DB::raw('
                booking_date AS date,
                group_concat(pnr) as pnr,
                count(id) AS totalOrder'));

        return $this->getGroupByDate($query);
    }

    public function getOrderByMonth(array $conditions)
    {
        $query = $this->prepareQuery($conditions);
    }

    private function getGroupByDate($query)
    {
        return $query->groupBy('date')
            ->orderBy('totalOrder', 'DESC')
            ->get();
    }
}