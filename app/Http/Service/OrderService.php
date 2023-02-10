<?php

namespace App\Http\Service;

use App\Http\Repository\OrderRepository;

class OrderService
{
    const DAY_WISE_REPORT  = 7;
    const DATE_WISE_REPORT = 30;

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function search(array $params)
    {
        $conditions['startDate'] = $params['start_date'];
        $conditions['endDate']   = $params['end_date'];
        $conditions['days']      = getDays($conditions);

        return $this->getSearchResult($conditions);
    }

    private function getSearchResult(array $conditions)
    {
        $numberOfDays = $conditions['days'];

        if ($numberOfDays < self::DAY_WISE_REPORT) return $this->orderRepository->getOrdersByDay($conditions);

        else if ($numberOfDays < self::DATE_WISE_REPORT) return $this->orderRepository->getOrdersByDate($conditions);

        else return $this->orderRepository->getOrdersByMonth($conditions);
    }
}