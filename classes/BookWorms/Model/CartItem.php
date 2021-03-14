<?php

namespace BookWorms\Model;

class CartItem
{
    public $timber;
    public $quantity;
    public $profiling;
    public $sqfootage;

    public function __construct($timber, $qty, $pro, $sq)
    {
        $this->timber = $timber;
        $this->quantity = $qty;
        $this->profiling = $pro;
        $this->sqfootage = $sq;
    }

    public static function getTotal($price, $quantity){
        $total = $price * $quantity;
        return $total;
    }
}
