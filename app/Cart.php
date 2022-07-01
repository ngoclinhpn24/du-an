<?php
namespace App;

use PhpParser\Node\Expr\Cast\Unset_;

class Cart{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct($cart){
        if($cart){
        $this->products = $cart->products;
        $this->totalPrice = $cart->totalPrice;
        $this->totalQuantity = $cart->totalQuantity;
        }
    }

    //Thêm vào giỏ hàng
    public function addCart($products, $id){
        $newProduct = ['quantity' => 0, 'price' => $products->product_price, 'info' => $products];
        if ($this->products) {
            if(array_key_exists($id, $this->products)){
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quantity'] ++;
        $newProduct['price'] = $newProduct['quantity'] * $products->product_price;
        $this->products[$id] = $newProduct;
        $this->totalPrice += $products->product_price;
        $this->totalQuantity ++;
        
    }

    //Xóa giỏ hàng
    public function deleteCart( $id){
        $this->totalQuantity -= $this->products[$id]['quantity'];
        $this->totalPrice -= $this->products[$id]['price'];
        unset($this->products[$id]);

    }

    //Thêm nhiều sản phẩm vào giỏ hàng
    public function insertCart($id, $product, $quantity){
        
        if(empty($this->products[$id])){
            $newProduct = ['quantity' => $quantity, 'price' => $product->product_price, 'info' => $product];
            $newProduct['price'] = $newProduct['quantity'] * $product->product_price;
            $this->products[$id] = $newProduct;
            $this->totalPrice += $product->product_price * $quantity;
            $this->totalQuantity += $quantity;

        }
        else{
                $this->products[$id]['quantity'] += $quantity; 
                $this->products[$id]['price'] = $this->products[$id]['quantity'] * $product->product_price;
                $this->totalQuantity += $quantity;
                $this->totalPrice += $this->products[$id]['price'];
            }
    }

    //Cập nhật giỏ hàng
    public function updateCart($id, $product, $quantity){
        $this->totalQuantity = $this->totalQuantity - $this->products[$id]['quantity'] + $quantity;
        $this->products[$id]['quantity'] = $quantity; 
        $this->totalPrice = $this->totalPrice -  $this->products[$id]['price'];
        $this->products[$id]['price'] = $this->products[$id]['quantity'] * $product->product_price;
        
        $this->totalPrice = $this->totalPrice  + $this->products[$id]['price'];
    }
}

?>
