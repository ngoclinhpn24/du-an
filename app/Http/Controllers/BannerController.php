<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /////////////////////Admin/////////////////////////
    //Xác thực đăng nhập
    public function authLogin(){
        $user_id = Session::get('admin_id');
        if($user_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //Quản lý banner
    public function manageBanner(){
        $banners = Banner::orderBy('id','DESC')->paginate(5);
    	return view('admin.manage_banner')->with(compact('banners'));  
    }
    //Thêm banner
    public function addBanner(){
        return view('admin.add_banner');
    }

    //Lưu banner
    public function insertBanner(Request $request){
        $this->AuthLogin();
   		$data = $request->all();
       	$get_image = request('banner_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/banner', $new_image);
            $banner = new Banner();
            $banner->banner_name = $data['banner_name'];
            $banner->banner_image = $new_image;
            $banner->banner_status = $data['banner_status'];
            $banner->banner_desc = $data['banner_desc'];
           	$banner->save();
            Session::put('message','Thêm banner thành công');
            return Redirect::to('manage-banner');
        }

    }

    //Hủy kích hoạt banner
    public function unactiveBanner($banner_id){
        $this->AuthLogin();
        DB::table('banner')->where('id',$banner_id)->update(['banner_status'=>0]);
        Session::put('message','Hủy kích hoạt Banner');
        return Redirect::to('manage-banner');

    }

    //Kích hoạt banner
    public function activeBanner($banner_id){
        $this->AuthLogin();
        DB::table('banner')->where('id',$banner_id)->update(['banner_status'=>1]);
        Session::put('message','Kích hoạt Banner thành công');
        return Redirect::to('manage-banner');

    }
    
    //Xóa banner
    public function deleteBanner($banner_id){
        $banner = Banner::find($banner_id);
        $banner->delete();
        Session::put('message','Xóa banner thành công');
        return redirect()->back();

    }
}
