<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailController extends Controller
{
    //Gửi coupon
    public function sendCoupon(){
        $coupon = Coupon::where('user_id', 1)->get();
        $user = User::where('role', 1)->get();
        return view('admin.send_coupon', compact('coupon', 'user'));
    }

    //Gửi mail
    public function sendMail(Request $request){
        $coupon = Coupon::find($request->coupon);
        $user = $request->user;

        $from_name = "Siêu thị xanh";
        $from_email = "longminions@gmail.com";
       
        $data = [];
        foreach($user as $us){
            $data['email'][] = User::find((int)$us)->email;
        }
        $data['coupon'] = $coupon;
        
        Mail::send('send_mail',$data,function($message) use ($from_name,$from_email, $data){

            $message->to($data['email'])->subject('Thân tặng quý khách mã giảm giá tại siêu thị xanh');
            $message->from($from_email,$from_name);
        });

        return redirect()->back()->with('message','Gửi mã giảm giá cho khách thành công');
        
    }
}
