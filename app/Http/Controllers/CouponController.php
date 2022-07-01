<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
use Carbon\Carbon;
session_start();

class CouponController extends Controller
{
    
    //Thêm mã giảm giá
    public function insertCoupon(){
    	return view('admin.insert_coupon');
    }

    //Xóa mã giảm giá
    public function deleteCoupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xóa mã giảm giá thành công');

        return Redirect::to('manage-coupon');
    }

    //Quản lý mã giảm giá
    public function manageCoupon(){
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();

    	return view('admin.list_coupon')->with(compact('coupon'));
    }

    //Thêm mã giảm giá vào database
    public function addCoupon(Request $request){
    	$data = $request->all();
    	$coupon = new Coupon;
    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_discount = $data['coupon_discount'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_quantity = $data['coupon_quantity'];
        $coupon->coupon_min = $data['coupon_min'];
        $coupon->coupon_start = $data['coupon_start'];
        $coupon->coupon_end = $data['coupon_end'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();
    	Session::put('message','Thêm mã giảm giá thành công');

        return Redirect::to('manage-coupon');
    }

	/////////////////user//////////////////
	//Kiểm tra mã giảm giá
	public function checkCoupon(Request $request){
        $user_id = Session::get('user_id');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $total_price = Session::get('cart')->totalPrice;
        $coupon = Coupon::where('coupon_code', $request->coupon)
                ->where('coupon_quantity', '>', 0)
                ->where('coupon_min', '<', $total_price)
                ->whereIn('user_id', array(1, $user_id))
                ->first();
        $output = '';
        if(!empty($coupon) && (strtotime($coupon->coupon_end) >= strtotime($today)) && (strtotime($coupon->coupon_start) <= strtotime($today))){
            $output .= '<div class="checkout__order__subtotal">Mã <span> ' . $coupon->coupon_code
            . ' </span></div>';
           if($coupon->coupon_condition == 1 ){
            $discount = ($total_price * $coupon->coupon_discount) / 100;
            $output .= '<div class="checkout__order__subtotal">Giảm <span> ' . number_format($coupon->coupon_discount)
            . '  % </span></div>';
           }
           else{
            $discount = $coupon->coupon_discount;
            $output .= '<div class="checkout__order__subtotal">Giảm <span> ' . number_format($coupon->coupon_discount)
            . '  VNĐ </span></div>';
           }
        //    $output .= '<div class="btn btn-primary mb-3" id="unset-coupon">Xóa mã</div>';
        //    $output .= '<div class="checkout__order__subtotal">Tổng giảm <span>' . number_format($discount,0,',','.') . ' VNĐ</span></div>';
           $request->session()->put('coupon', $coupon->coupon_id);
        }

        else{
            $discount = 0;
            $output .= '';
        }
        $request->session()->put('discount', $discount);
        $response = [
            'output' =>  $output,
            'discount' =>  number_format($discount) . ' VNĐ'
        ];

        return $response;
    }

    //Xóa mã giảm giá
	public function unsetCoupon(){
        // $coupon = Session::get('coupon');
        // if($coupon==true){
        //     Session::forget('coupon');
        //     return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        // }
        Session::forget('coupon');
        Session::put('discount', 0);
        
	}

    public function loadTotal(){
        $discount = Session::get('discount');
        $total_price = Session::get('cart')->totalPrice;
        $feeship = Session::get('feeship');
        $total = $total_price + $feeship - $discount;
        Session::put('total', $total);
        $output = '';
        $output .= number_format($total) . ' VNĐ';

        return $output;
    }

}
