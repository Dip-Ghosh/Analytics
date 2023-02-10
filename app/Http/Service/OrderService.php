<?php

namespace App\Http\Service;

use App\Http\Repository\OrderRepository;
use DateTime;

class OrderService
{
    protected OrderRepository $orderRespository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRespository = $orderRepository;
    }

    public function search(array $params)
    {
        $conditions['startDate'] = $params['start_date'];
        $conditions['endDate']   = $params['end_date'];
        $conditions['days']      = $this->getDays($conditions);

        return $this->getSearchResult($conditions);

    }

    private function getDays(array $conditions): int
    {
        $startDate = new DateTime($conditions['startDate']);
        $endDate   = new DateTime($conditions['endDate']);

        return (int)$endDate->diff($startDate)->format('%a');
    }

    private function getSearchResult(array $conditions)
    {
        $numberOfDays = $conditions['days'];

        if ($numberOfDays <= 7) return $this->orderRespository->getOrderByDay($conditions);

        elseif ($numberOfDays > 7  && $numberOfDays <= 30)  return $this->orderRespository->getOrderByDate($conditions);

        else return $this->orderRespository->getOrderByDate($conditions);

    }
}