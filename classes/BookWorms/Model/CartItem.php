<?php

namespace BookWorms\Model;

class CartItem
{
    public $timber;
    public $quantity;

    public function __construct($timber, $qty)
    {
        $this->timber = $timber;
        $this->quantity = $qty;
    }
}
