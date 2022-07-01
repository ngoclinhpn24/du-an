<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\User;

session_start();

class CheckoutController extends Controller
{
    //Hiển thị trang đặt hàng
    public function checkout(){
        $user_id = Session::get('user_id');
        $shipping = DB::table('shipping')->join('users', 'users.id', 'shipping.user_id')->where('shipping.user_id', $user_id)->first();
        $total_price = Session::get('cart')->totalPrice;

        if($total_price < 300000){
            $shipping_fee = 15000;
        }
        else{
            $shipping_fee = 0;
        }
        Session::put('feeship', $shipping_fee);
        if(Session::get('discount')){
            $discount = Session::get('discount');
        }
        else {
            $discount = 0;
        }

        $total = $total_price + $shipping_fee - $discount;
        Session::put('total', $total);
        return view('checkout', ['shipping' => $shipping, 'shipping_fee' => $shipping_fee, 'total_price' => $total_price, 'discount' => $discount, 'total' => $total] );
    }

    //Thêm người dùng mới
    public function adduser(Request $request){
        $data = array();
        $data['name'] = $request->user_name;
    	$data['user_phone'] = $request->user_phone;
    	$data['email'] = $request->user_email;
    	$data['password'] = md5($request->user_password);
    	$users_id = DB::table('users')->insertGetId($data);
    	Session::put('user_id', $users_id);
    	Session::put('user_name',$request->user_name);

    	return Redirect::to('/checkout');
    }

    //Lưu đơn hàng
    public function saveCheckout(Request $request){
        $user_id = Session::get('user_id');
        //Lưu thông tin giao hàng
        $data = array();
    	$data['shipping_name'] = $request->shipping_name;
        $data['shipping_surname'] = $request->shipping_surname;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_note'] = $request->shipping_note;
    	$data['shipping_address'] = $request->shipping_address;
        $data['shipping_city'] = $request->shipping_city;
        $data['shipping_town'] = $request->shipping_town;
        $data['shipping_village'] = $request->shipping_village;
        $data['user_id'] = $user_id;
    	$shipping_id = DB::table('shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);

        // Lưu thông tin thanh toán
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $payment_id = DB::table('payment')->insertGetId($data);
        
        //Lưu thông tin đơn hàng
        $cart = Session::get('cart');
        $order_data = array();
        $order_data['user_id'] = Session::get('user_id');
        $order_data['feeship'] = Session::get('feeship');
        if(Session::get('coupon')){
            $coupon_id = Session::get('coupon');
            //Sau khi dùng giảm số lượng mã giảm giá
            $coupon = Coupon::find($coupon_id);
            $coupon->coupon_quantity -- ;
            $coupon->save();
        }
        $order_data['coupon'] = Session::get('discount');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_status'] = 1;
        $order_data['day'] = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $order_data['order_total'] = Session::get('total');
        $order_id = DB::table('order')->insertGetId($order_data);

        

        //Lưu thông tin chi tiết đơn hàng
        foreach($cart->products as $carts){
            $order_detail_data['product_quantity'] = $carts['quantity'];
            $order_detail_data['order_id'] = $order_id;
            $order_detail_data['product_id'] = $carts['info']->product_id;
            $order_detail_data['product_name'] = $carts['info']->product_name;
            $order_detail_data['product_price'] = $carts['info']->product_price;
            $product = Product::find($carts['info']->product_id);
            //Giảm số lượng sản phẩm trong kho, tăng số lượng sản phẩm đã bán
            $product->product_quantity -= $carts['quantity'];
            $product->sold += $carts['quantity'];
            $product->save();
            DB::table('order_details')->insert($order_detail_data);
        }
        $request->session()->forget('coupon');
        
        //Hình thức thanh toán
        if ($request->payment_option == 1) {
            $request->session()->forget('discount');
            $request->session()->forget('feeship');
            $request->session()->forget('cart');
            return view('payment.cash');
        } 
        elseif($request->payment_option == 2) {
            return view('payment.momo');
        }
        elseif($request->payment_option == 3){
            return view('payment.paypal');
        }
        elseif($request->payment_option == 4){
            return view('payment.onepay');
        }
        elseif($request->payment_option == 5){
            return view('payment.vnpay');
        }
    }
    
    //Trang thanh toán thành công
    public function payment(){
        return view('payment');
    }
    
}
