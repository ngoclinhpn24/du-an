<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Gift;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Nette\Utils\Random;

class GiftController extends Controller
{
    //Đổi quà
    public function exchangeGift(){
        $users_id = Session::get('user_id');
        $user = User::find($users_id);
        $gifts = DB::table('gift')->get();
        return view('exchange_gift', ['user' => $user, 'gifts' => $gifts]);
    }

    public function exchange($point){
        $user_id = Session::get('user_id');
        $user = User::find($user_id);
        if($user->point >= $point){
        $user->point -= $point;
        $user->save();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $tomorrow = Carbon::tomorrow('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $discount = $point * 1000;

        $gift = Coupon::insertGetId([
            'coupon_name' => "Mã giảm giá giảm $discount VNĐ",
            'coupon_code' => Random::generate(),
            'coupon_quantity' => 1,
            'coupon_discount' => $discount,
            'coupon_condition' => 2,
            'coupon_start' => $today,
            'coupon_end' => $tomorrow,
            'user_id' => $user_id,
        ]);

        

        $gift_coupon = Coupon::find($gift);

        $reponse = '------ Đổi quà thành công -------';
        $reponse .= '<div class="card-header">' . $gift_coupon->coupon_name . '</div>';
        $reponse .= '<div class="card-body"> Mã: ' . $gift_coupon->coupon_code. '</div>';
        $reponse .= '<div class="card-footer">Hạn: ' . $gift_coupon->coupon_end. '</div>';

        return $reponse;
        }
        else return "Bạn không đủ điểm Eko Point, hãy mua thêm hàng hoặc chia sẻ công thức nấu ăn để nhận point nhé";
    }

    public function manageGift(){
        $gifts = Gift::all();

        return view('admin.manage_gift', ['gifts' => $gifts]);
        
    }

    public function addGift(){
        return view('admin.add_gift');
    }

    public function insertGift(Request $request){
        $gift = new Gift;
        $gift->point = $request->point;
        $gift->gift = $request->gift;
        $gift->save();

        return Redirect::to('/manage-gift');
    }

    public function deleteGift($gift_id){
        $data = Gift::find($gift_id);
        $data->delete();
        Session::put('message','Xóa quà tặng thành công');
        return redirect()->back();

    }

    public function getPoint(){
        $user_id = Session::get('user_id');
        $point = User::find($user_id)->point;
        $reponse = 'Điểm Eko Point: ' . $point ;

        return $reponse;
    }

    public function showGift(){
        $user_id = Session::get('user_id');
        $user = User::find($user_id);

        $gift_coupon = DB::table('coupon')->where('user_id', $user->id)->where('coupon_quantity', 1)->orderBy('coupon_end', 'DESC')->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');

        return view('show_gift', ['user' => $user, 'gift_coupon' => $gift_coupon, 'today' => $today]);
    }

}
