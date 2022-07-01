<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    //Phương thức thanh toán VNPAY
    public function vnpay(Request $request){
            
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order_id = rand(0,9999);

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/sieuthi/public/payment";
            $vnp_TmnCode = "YQ62JZY7";//Mã website tại VNPAY 
            $vnp_HashSecret = "YKJWBVXLNZJZIFBEIDEINPTDAAWYRXWG"; //Chuỗi bí mật

            $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán đơn hàng bằng VNPAY";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = $request->total * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'ncb';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
                
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    $request->session()->forget('cart');
                    $request->session()->forget('discount');
                    $request->session()->forget('feeship');
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    
                    echo json_encode($returnData);
                }
        }

        //Phương thức thanh toán khi nhận hàng
        public function cash(){

            return Redirect::to('payment');
        }

        //Phương thức thanh toán paypal
        public function paypal(Request $request){
            
        }

        //Phương thức thanh toán Onepay
        public function onepay(Request $request){
            $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";

                $vpcURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op' . "?";

                // Remove the Virtual Payment Client URL from the parameter hash as we 
                // do not want to send these fields to the Virtual Payment Client.
                // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
                // unset($_POST["virtualPaymentClientURL"]); 
                // unset($_POST["SubButL"]);

                //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************

                $vpc_Merchant = 'ONEPAY';
                $vpc_AccessCode = 'D67342C2';
                $vpc_MerchTxnRef = time();
                $vpc_OrderInfo = 'JSECURETEST01';
                $vpc_Amount = "$request->total * 100";
                $vpc_ReturnURL = 'http://localhost/sieuthi/public/payment';
                $vpc_Version = '2';
                $vpc_Command = 'pay';
                $vpc_Locale = 'vn';
                $vpc_Currency = 'VND';

                $data = array(
                    'vpc_Merchant' => $vpc_Merchant,
                    'vpc_AccessCode' => $vpc_AccessCode,
                    'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
                    'vpc_OrderInfo' => $vpc_OrderInfo,
                    'vpc_Amount' => $vpc_Amount,
                    'vpc_ReturnURL' => $vpc_ReturnURL,
                    'vpc_Version' => $vpc_Version,
                    'vpc_Command' => $vpc_Command,
                    'vpc_Locale' => $vpc_Locale,
                    'vpc_Currency' => $vpc_Currency,


                );
                $stringHashData = "";
                // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
                // arrange array data a-z before make a hash
                ksort ($_POST);

                // set a parameter to show the first pair in the URL
                // đặt tham số đếm = 0
                $appendAmp = 0;

                foreach($data as $key => $value) {

                    // create the md5 input and URL leaving out any fields that have no value
                    // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
                    if (strlen($value) > 0) {
                        // this ensures the first paramter of the URL is preceded by the '?' char
                        if ($appendAmp == 0) {
                            $vpcURL .= urlencode($key) . '=' . urlencode($value);
                            $appendAmp = 1;
                        } else {
                            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                        }
                        //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                        if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                            $stringHashData .= $key . "=" . $value . "&";
                        }
                    }
                }
                //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
                $stringHashData = rtrim($stringHashData, "&");
                // Create the secure hash and append it to the Virtual Payment Client Data if
                // the merchant secret has been provided.
                // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
                if (strlen($SECURE_SECRET) > 0) {
                    //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
                    // *****************************Thay hàm mã hóa dữ liệu*****************************
                    $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
                }

                // FINISH TRANSACTION - Redirect the customers using the Digital Order
                // ===================================================================
                // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
                // header("Location: ".$vpcURL);
                return redirect()->to($vpcURL);

                // *******************
                // END OF MAIN PROGRAM
        }

        //Hàm hỗ trợ thanh toán MOMO
        public function execPostRequest($url, $data)
                {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data))
                    );
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);
                    return $result;
                }

        //Phương thức thanh toán MOMO
        public function momo(Request $request){

            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = "$request->total";
            $orderId = time() ."";
            $redirectUrl = "http://localhost/sieuthi/public/payment";
            $ipnUrl = "http://localhost/sieuthi/public/payment";
            $extraData = "";
            
                $requestId = time() . "";
                $requestType = "payWithATM";
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json
                //Just a example, please check more in there
                $request->session()->forget('cart');
                $request->session()->forget('discount');
                $request->session()->forget('feeship');
                return redirect()->to($jsonResult['payUrl']);
        }
}
