<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Payment;
use App\Models\Coupon;
use App\Models\OrderDetail;
session_start();

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Trang chủ
    public function index(){
        $cate = DB::table('category')->where('category_status','1')->orderBy('category_id','desc')->get();
        $product = DB::table('product')->where('product_status','1')->limit(4)->get();
        $banner = Banner::all()->take(2);
        $soldProduct = DB::table('product')->where('product_status','1')->orderBy('sold','desc')->limit(3)->get();
        $topRating = DB::table('rating')->select(DB::raw('avg(rating) as rate, product_id'))->groupBy('product_id')->orderByDesc('rate')->limit(3)->get();
        $topRateProduct = [];
        foreach($topRating as $value){
            $topRateProduct[] = $value->product_id;
        }
        $ratingProduct = DB::table('product')->whereIn('product_id', $topRateProduct)->get();
        $viewProduct = DB::table('product')->where('product_status','1')->orderBy('view','desc')->limit(3)->get();
        $blogs = Blog::all()->take(3);
        
        return view('pages.home',['cate'=>$cate,'product'=>$product, 'banner'=>$banner, 'soldProduct'=>$soldProduct, 'ratingProduct'=>$ratingProduct, 'viewProduct'=>$viewProduct, 'blogs'=> $blogs]);
    }

    

    //Tìm kiếm
    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate = DB::table('category')->where('category_status','1')->orderBy('category_id','desc')->get();

        
        $search_product = Product::whereRaw(
	        "MATCH(product_name) AGAINST(?)", 
	        array($keywords))->get();
        // $search_product = DB::table('product')->where('product_name','like binary','%'.$keywords.'%')->get(); 

        return view('search',['search_product' => $search_product, 'cate' => $cate]);

    }

    //Cửa hàng
    public function market(){
        $cate = DB::table('category')->where('category_status','1')->orderBy('category_id','desc')->get();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        //Lọc
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
            if($sort =='up' ){
                $product = DB::table('product')->where('product_status','1')->orderBy('product_price', 'ASC')->simplePaginate(15)->appends(request()->query()); //tránh mất code khi chuyển trang
            }
            elseif($sort =='down' ){
                $product = DB::table('product')->where('product_status','1')->orderBy('product_price', 'DESC')->simplePaginate(15)->appends(request()->query());
            }
            elseif($sort =='az' ){
                $product = DB::table('product')->where('product_status','1')->orderBy('product_name', 'ASC')->simplePaginate(15)->appends(request()->query());
            }
            elseif($sort =='za' ){
                $product = DB::table('product')->where('product_status','1')->orderBy('product_name', 'DESC')->simplePaginate(15)->appends(request()->query());
            }
            
        }
        //Lọc theo giá
        elseif(isset($_GET['start_price'])){
            $start_price = $_GET['start_price'];
            $end_price = $_GET['end_price'];

            $product = DB::table('product')->whereBetween('product_price', [$start_price, $end_price])->orderBy('product_price', 'ASC')->paginate(15)->appends(request()->query());
        }
        else{
            $product = DB::table('product')->where('product_status','1')->simplePaginate(15);
        }
        $totalProduct = DB::table('product')->where('product_status','1')->count();

        return view('market',['cate'=>$cate,'product'=>$product, 'min_price'=>$min_price, 'max_price'=>$max_price, 'totalProduct'=>$totalProduct]);

    }

    //Trang liên hệ
    public function contact(){
        $user = Session::get('user_id');
        $order = DB::table('order')->where('order.user_id', $user)->get();
        $issues = array(
            0 => "Vấn đề khác",
            1 => "Giao hàng chậm",
            2 => "Thất lạc hàng hóa",
            3 => "Giao thiếu hàng",
            4 => "Hàng hóa hư hại",
        );
        return view('contact', ['order' => $order, 'issues' => $issues]);
    }

    //Thêm sản phẩm vào yêu thích
    public function addWishlist($product_id){
        $user_id = Session::get('user_id');
        $wishlist = DB::table('wishlist')->where('user_id', $user_id)->get();
        foreach($wishlist as $value){
            if($value->product_id == $product_id){
                return 'error';
            }
        }
        $data = array();
        $user_id = Session::get('user_id');
        $data['product_id'] = $product_id;
        $data['user_id'] = $user_id;
        DB::table('wishlist')->insert($data);

        return 'success';
    }

    //Hiển thị danh sách sản phẩm yêu thích
    public function showWishlist(){
        $user_id = Session::get('user_id');
        $wishlist = DB::table('wishlist')->where('user_id', $user_id)->get();
        $product_id = [];
        foreach ($wishlist as $value) {
            $product_id[] = $value->product_id;
        }
        $productwishlist = DB::table('product')->whereIn('product_id',$product_id)->get();
        return view('wishlist', ['productwishlist'=>$productwishlist]);
    }

    //Xóa sản phẩm khỏi danh sách sản phẩm yêu thích
    public function removeWishlist($product_id ){
        $data = DB::table('wishlist')->where('product_id', $product_id)->delete();
        return redirect()->back();
    }

    //Đăng nhập
    public function login(Request $request){
    	$email = $request->email;
    	$password = md5($request->password);
    	$result = DB::table('users')->where('email',$email)->where('password',$password)->where('role', 1)->first();
        if($result){
            Session::put('user_id', $result->id);
    	    return Redirect::to('/');
        }
        else{
            return redirect()->back();
        }
    }

    //Trang đăng nhập
    public function loginUser(){
        return view('login');
    }

    //Đăng xuất người dùng
    public function logoutUser(){
    	Session::forget('user_id');
    	return Redirect::to('/');
    }

    //Thêm người dùng mới
    public function adduser(Request $request){
        $data = array();
        $data['name'] = $request->user_name;
    	$data['user_phone'] = $request->user_phone;
        $data['user_address'] = $request->user_address;
    	$data['email'] = $request->user_email;
        $data['role'] = 1;
    	$data['password'] = md5($request->user_password);

    	$users_id = DB::table('users')->insertGetId($data);

    	Session::put('user_id', $users_id);
    	Session::put('user_name',$request->user_name);

    	return Redirect::to('/login-user');
    }

    //Trang cá nhân
    public function profile(){
        $users_id = Session::get('user_id');
        $user = User::find($users_id);
        $shipping = DB::table('shipping')
        ->join('users','users.id','=','shipping.user_id')->first();

        return view('profile', ['user'=>$user, 'shipping'=>$shipping]);
    }

    //Quản lý đơn hàng của người dùng
    public function manageOrderUser(){
        $users_id = Session::get('user_id');
        $user = User::find($users_id);
        $orders = DB::table('order')
        ->where('user_id',$users_id)
        ->orderBy('order_id', 'desc')
        ->get();

        return view('manage_order_user', ['user'=>$user, 'orders'=>$orders]);
    }

    //Thay đổi thông tin người dùng
    public function changeProfile(Request $request){
        $data = $request->all();
        $user = User::find(Session::get('user_id'));
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->user_phone = $data['user_phone'];
        $user->user_address = $data['user_address'];
        $user->save();

        return redirect()->back();

    }

    //Thay đổi thông tin vận chuyển
    public function changeShipping(Request $request){
        $data = $request->all();

        $shipping = Shipping::find($data['shipping_id']);
        $shipping->shipping_surname = $data['shipping_surname'];
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_city = $data['shipping_city'];
        $shipping->shipping_town = $data['shipping_town'];
        $shipping->shipping_village = $data['shipping_village'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->save();

        return redirect()->back();

    }

    //Thay đổi mật khẩu
    public function changePassword(){
        $user = User::find(Session::get('user_id'));
        return view('change_password', ['user' => $user]);
    }

    //Đổi mật khẩu
    public function changePass(Request $request){
        $users_id = Session::get('user_id');
        $user = User::find($users_id);
        
        if($user->password == md5($request->password)){
            $user->password = md5($request->newpassword);
            $user->save();

            Session::put('message',"Đổi mật khẩu thành công");
        }
        else{
            Session::put('message',"Mật khẩu không chính xác");
        }

        return redirect()->back();

    }

    //Hủy đơn hàng
    public function cancelOrder($order_id){
        $order = Order::find($order_id);
        $order->order_status = 0;
        $order->save();

        return redirect()->back();

    }

    //Xác nhận đã giao hàng thành công
    public function confirmOrder($order_id){
        $order = Order::find($order_id);
        $order->order_status = 3;
        $order->save();

        //Thêm point
        $user_id = Session::get('user_id');
        $user = User::find($user_id);
        $user->point += $order->order_total/200000;
        $user->save();

        return redirect()->back();

    }

    //Xem chi tiết đơn hàng user
    public function viewOrderUser($order_id){
        $order_details = OrderDetail::with('product')->where('order_id',$order_id)->get();
		$order = Order::where('order_id',$order_id)->get();
		foreach($order as $key => $ord){
			$user_id = $ord->user_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
			$payment_id = $ord->payment_id;
			$coupon = $ord->coupon;
			$order_total = $ord->order_total;
		}
		$user = User::where('id',$user_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
		$payment = Payment::find($payment_id);
		$coupon = Coupon::find($coupon);

        return view('view_order_user')->with(compact('order_details','user','shipping','order','order_status', 'payment'));
    }

    
}
