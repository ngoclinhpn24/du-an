<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
session_start();

class AdminController extends Controller
{
    //Xác thực đăng nhập
    public function authLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    //Đăng nhập admin
    public function index(){
        return view('admin_login');
    }

    //Hiển thị trang admin dashboard
    public function showDashboard(){
        $this->AuthLogin();
        $userNumber = User::where('role', 1)->count();
        $product = Product::orderBy('sold', 'desc')->take(5)->get();
        $totalView = Product::sum('view');
        $totalOrder = Order::count();
        $totalSale = Order::sum('order_total');

        return view('admin.dashboard', ['userNumber' => $userNumber, 'totalView' => $totalView,'totalOrder' => $totalOrder,'totalSale' => $totalSale, 'product' => $product]);
    }

    //Đăng nhập admin dashboard
    public function loginDashboard(Request $request){
        $validated = $request->validate([
            'email' => 'required||max:255',
            'password' => 'required',
        ]);
        $user_email = $request->email;
        $user_password = md5($request->password);

        $result = DB::table('users')->where('email', $user_email )->where('password', $user_password )->first();
        if($result->role == 0){
            Session::put('user_name', $result->name);
            Session::put('admin_id', $result->id);
             return Redirect::to('/dashboard');
        }
        else{ 
            Session::put('message', "Tài khoản hoặc mật khẩu không chính xác");
            return Redirect::to('/admin');
        }
    }

    //Đăng xuất admin
    public function logOut(){
        Session::put('user_name', null );
        Session::put('admin_id', null );
        return Redirect::to('/admin');
    }

    //Ajax lấy dữ liệu biểu đồ chart
    public function getChartData(){
        $order = DB::table('order')
        ->select('day', DB::raw('count(*) as total, sum(order_total) as sum'))
        ->groupBy('day')
        ->get();
        foreach($order as $or){
            $chart[] = array(
                'day' => $or->day,
                'total' => $or->total,
                'sum' => $or->sum
            );
        }
        return json_encode($chart);
    }

    //Hàm lấy trạng thái đơn hàng
    public function status($status){
        if ($status == 0) {
           $st = "Đơn hàng đã hủy";
        } 
        elseif($status == 1) {
            $st = "Đơn hàng mới";
        }
        elseif($status == 2) {
            $st = "Đang giao hàng ";
        }
        elseif($status == 3) {
            $st = "Giao hàng thành công ";
        }
        return $st;
        
    }

    //Hàm lấy dữ liệu biểu đồ tròn cho dashboard
    public function getDonutData(){
        $order = DB::table('order')
        ->select('order_status', DB::raw('count(*) as total'))
        ->groupBy('order_status')
        ->get();
        foreach($order as $or){
            $donut[] = array(
                'label' => $this->status($or->order_status),
                'value' => $or->total,
            );
        }
        return json_encode($donut);
    }

}
