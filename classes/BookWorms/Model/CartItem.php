<?php

namespace BookWorms\Model;

class CartItem
{
    public $timber;
    public $quantity;
    public $profiling;
    public $sqfootage;
    public $fire_rated;

    public function __construct($timber, $qty, $pro, $sq, $fr)
    {
        $this->timber = $timber;
        $this->quantity = $qty;
        $this->profiling = $pro;
        $this->sqfootage = $sq;
        $this->fire_rated = $fr;
    }

    public static function getTotal($price, $quantity)
    {
        $total = $price * $quantity;
        return $total;
    }
}
