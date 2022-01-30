<?php
namespace App\Models;

class Cart
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart)
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }

    public function addToCart($product, $id, $quantity)
    {
        $newProduct = ['quantity' => 0, 'price' => $product->price, 'productInfo' => $product];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quantity'] += $quantity;
        $newProduct['price'] = $newProduct['quantity'] * ($product->price - ($product->price * $product->discount) / 100);
        echo $newProduct['quantity'];
        $this->products[$id] = $newProduct;
        $this->totalPrice = 0;
        $this->totalQuantity = 0;
        foreach ($this->products as $pd){
            $this->totalPrice += $pd['price'];
            $this->totalQuantity += $pd['quantity'];
        }
    }

    public function deleteItemCart($id)
    {
        $this->totalQuantity -= $this->products[$id]['quantity'];
        $this->totalPrice -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }

    public function updateItemCart($id, $quantity)
    {
        $this->totalQuantity -= $this->products[$id]['quantity'];
        $this->totalPrice -= $this->products[$id]['price'];
        $this->products[$id]['quantity'] = $quantity;
        $this->products[$id]['price'] = $quantity * ($this->products[$id]['productInfo']->price - ($this->products[$id]['productInfo']->price * $this->products[$id]['productInfo']->discount) / 100);
        $this->totalQuantity += $this->products[$id]['quantity'];
        $this->totalPrice += $this->products[$id]['price'];
    }
}
