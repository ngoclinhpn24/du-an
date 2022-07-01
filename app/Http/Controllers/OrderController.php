<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shipping;
use Illuminate\Support\Facades\App;
use App\Models\Coupon;
use App\Models\Employee;
use App\Models\Payment;
use PDF;

session_start();

class OrderController extends Controller
{
    //Xác thực admin
    public function authLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

	//Quản lý đơn hàng
    public function manageOrder(){
        $this->AuthLogin();
        $all_order = DB::table('order')
        ->join('users','order.user_id','=','users.id')
        ->select('order.*','users.name')
        ->orderby('order.order_id','desc')->get();

        return view('admin.manage_order')->with('all_order',$all_order);
    }

	//Xử lý đơn hàng
	public function handleOrder(){
        $this->AuthLogin();
        $all_order = DB::table('order')
        ->join('users','order.user_id','=','users.id')
        ->select('order.*','users.name')
		->where('order.order_status', 1)
        ->orderby('order.order_id','desc')->get();

        return view('admin.manage_order')->with('all_order',$all_order);
    }

	//Xem chi tiết đơn hàng
    public function viewOrder($orderId){
        $order_details = OrderDetail::with('product')->where('order_id',$orderId)->get();
		$order = Order::where('order_id',$orderId)->get();
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
		$shippers = Employee::where('employee_job', 'Shipper')->get();
		
		return view('admin.view_order')->with(compact('order_details','user','shipping','order','order_status', 'payment', 'shippers'));
    }

	//In đơn hàng 
	public function printOrder($order_id){
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($order_id));
		
		return $pdf->stream();
	}

	//Phương thức thanh toán
	public function paymentMethod($method){
		if($method == 1){
			return "Thanh toán khi nhận hàng";
		}
		elseif($method == 2){
			return "Ví MOMO";
		}
		elseif($method == 3){
			return "Paypal";
		}
		elseif($method == 4){
			return "Onepay";
		}
		elseif($method == 5){
			return "VNPAY";
		}
	}

	//Xuất đơn hàng ra PDF
	public function print_order_convert($order_id){
		$order_details = OrderDetail::with('product')->where('order_id',$order_id)->get();
		$order = Order::where('order_id',$order_id)->get();
		foreach($order as $ord){
			$user_id = $ord->user_id;
			$shipping_id = $ord->shipping_id;
			$payment_id = $ord->payment_id;
			$total = $ord->order_total;
			$coupon = $ord->coupon;
			$feeship = $ord->feeship;
		}
		$user = User::where('id',$user_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
		$payment = Payment::find($payment_id);
		$output = '';
		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerSiêu thị xanh</center></h1>
		<h4><center>Siêu thị xanh online </center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$user->name.'</td>
						<td>'.$user->user_phone.'</td>
						<td>'.$user->user_address.'</td>
						<td>'.$user->email.'</td>
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Địa chỉ giao hàng</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Quận, huyện</th>
						<th>Đường</th>
						<th>Địa chỉ chi tiết</th>
						<th>Số điện thoại</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_district.'</td>
						<td>'.$shipping->shipping_village.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						<td>'.$shipping->shipping_note.'</td>
					</tr>';

		$output.='				
				</tbody>
			
		</table>

		<p>Chi tiết đơn hàng</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			

				foreach($order_details as $product){
				$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product->product_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').' VNĐ'.'</td>
						<td>'.number_format($product->product_quantity * $product->product_price,0,',','.').' VNĐ'.'</td>
						
					</tr>';
				}

				
		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.number_format($coupon,0,',','.').' VNĐ'.'</p>
					<p>Phí ship: '.number_format($feeship,0,',','.').' VNĐ'.'</p>
					<p>Thanh toán : '.number_format($total,0,',','.').' VNĐ'.'</p>
					<p>Hình thức thanh toán : '.$this->paymentMethod($payment->payment_method).'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Siêu thị xanh</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';

		return $output;
	}

	//Xóa đơn hàng
	public function deleteOrder($order_id){
		$order = Order::where('order_id',$order_id)->delete();
        Session::put('message', "Xóa đơn hàng thành công");

        return redirect()->back();

	}

	//Giao đơn hàng
	public function shippingOrder(Request $request){
		$shipper = Employee::find($request->shipper_id);
		$order = Order::find($request->order_id);
		$order->order_status = 2;
		$order->shipper_name = $shipper->employee_name;
		$order->shipper_phone = $shipper->employee_phone;
		$order->order_code = rand(0,9999999);
		$order->save();

		return redirect()->back();

	}

	//Hủy đơn hàng
	public function cancelOrderAdmin($order_id){
		$order = Order::find($order_id);
		$order->order_status = 0;
		$order->save();

		return Redirect::to('manage-order');
	}
}
