<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
session_start();

class CartController extends Controller
{
    //Thêm nhiều sản phẩm vào giỏ hàng
    public function addCarts(Request $req){
            $product_id = $req->productid_hidden;
            $product_quantity = $req->quantity;
            $product = DB::table('product')->where('product_id', $product_id)->first();
            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->insertCart($product_id, $product, $product_quantity);
            $req->session()->put('cart', $newCart);
           
            return redirect()->back();
         
    }

    //Xóa giỏ hàng
    public function deleteCart(Request $req, $product_id){
       $oldCart = Session('cart') ? Session('cart') : null;
       $newCart = new Cart($oldCart);
       $newCart->deleteCart($product_id);
       
       if(count($newCart->products) > 0){
        $req->session()->put('cart', $newCart);
       }
       else{
        $req->session()->forget('cart');
       }       
        return view('show_cart_ajax');
      
    }

    //Thêm 1 sản phẩm vào giỏ hàng
    public function addCart(Request $req, $product_id)
    {
       $product = DB::table('product')->where('product_id', $product_id)->first();
       $oldCart = Session('cart') ? Session('cart') : null;
       $newCart = new Cart($oldCart);
       $newCart->addCart($product, $product_id);
       $req->session()->put('cart', $newCart);
       
       return view('show_cart_ajax');
        
    }

    //Hiển thị giỏ hàng
    public function showCart(){
        $cate = DB::table('category')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $cart = Session::get('cart');
     
        return view('show_cart',['cate'=>$cate, 'cart'=>$cart]);   
    }

    public function saveCartAll(Request $request){
        $datas = $request->all();
        
        foreach($datas['data'] as $data){
            $product_id = $data['key'];
            $product_quantity = $data['value'];
            $product = DB::table('product')->where('product_id', $product_id)->first();
            $oldCart = Session('cart') ? Session('cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->updateCart($product_id, $product, $product_quantity);
            $request->session()->put('cart', $newCart);
        }
        
    }

    public function reloadTotal(){
        $total = number_format(Session::get('cart')->totalPrice);
        return $total." VNĐ";
    
    }
}
