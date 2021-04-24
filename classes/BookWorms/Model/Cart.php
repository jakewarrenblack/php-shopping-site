<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class Cart

{

    public static function get($request)
    {
        $session = $request->session();
        if ($session->has("cart")) {
            $cart = $session->get("cart");
        } else {
            $cart = new Cart();
            $session->set("cart", $cart);
        }
        return $cart;
    }

    public $items;

    public function __construct()
    {
        $this->items = array();
    }

    public function add($timber, $quantity, $profiling, $sqfootage, $fire_rated)
    {
        if (!$timber instanceof Timber || $quantity <= 0) {
            throw new Exception("Illegal argument");
        }
        if (array_key_exists($timber->id, $this->items)) {
            $item = $this->items[$timber->id];
            $item->quantity = ($item->quantity + $quantity);
            $item->profiling = $profiling;
            $item->sqfootage = $sqfootage;
            $item->fire_rated = $fire_rated;
        } else {
            $item = new CartItem($timber, $quantity, $profiling, $sqfootage, $fire_rated);
            $this->items[$timber->id] = $item;
        }
    }


    public function remove($timber, $quantity)
    {
        if (!$timber instanceof Timber || $quantity <= 0) {
            throw new Exception("Illegal argument");
        }
        if (!array_key_exists($timber->id, $this->items)) {
            throw new Exception("Illegal argument");
        }
        $item = $this->items[$timber->id];
        $item->quantity = ($item->quantity - $quantity);
        if ($item->quantity <= 0) {
            unset($this->items[$timber->id]);
        }
    }

    public function set($timber, $quantity)
    {
        if (!$timber instanceof Timber || $quantity < 0) {
            throw new Exception("Illegal argument");
        }
        if (!array_key_exists($timber->id, $this->items)) {
            throw new Exception("Illegal argument");
        }
        $item = $this->items[$timber->id];
        $item->quantity = $quantity;
        if ($item->quantity <= 0) {
            unset($this->items[$timber->id]);
        }
    }

    public function empty()
    {
        return count($this->items) === 0;
    }

    public function size()
    {
        return count($this->items);
    }
    public function clear()
    {
        $this->items = array();
    }
}
