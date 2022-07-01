<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Exports\BlogCategoryExport;
use App\Imports\BlogCategoryImport;
use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Excel;
session_start();

class BlogController extends Controller
{
    ////Quản lý danh mục Blog//////
    //Xác thực đăng nhập
    public function authLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //Thêm danh mục Blog
    public function addBlogCategory(){
        $this->AuthLogin();

        return view('admin.add_blog_category');
    }

    //Sửa danh mục blog
    public function editBlogCategory($blogcategory_id){
        $this->AuthLogin();
        $data = DB::table('blogcategory')->where('blogcategory_id', $blogcategory_id)->get();

        return view('admin.edit_blog_category',['data' => $data]);
    }

    //Xóa danh mục blog
    public function deleteBlogCategory($blogcategory_id ){
        $this->AuthLogin();
        $data = DB::table('blogcategory')->where('blogcategory_id', $blogcategory_id)->delete();
        Session::put('message', "Xóa danh mục sản phẩm thành công");

        return Redirect::to('/all-blog-category');
    }

    //Cập nhật danh mục blog
    public function updateBlogCategory(Request $request, $blogcategory_id ){
        $data = array();
        $data['blogcategory_name'] = $request->blogcategory;
        $data['blogcategory_status'] = $request->blogcategory_status;

        DB::table('blogcategory')->where('blogcategory_id', $blogcategory_id)->update($data);
        Session::put('message', "Cập nhật danh mục sản phẩm thành công");

        return Redirect::to('/all-blog-category');

    }

    //Xem trước blog
    public function viewBlog($blog_id){
        $blog = Blog::find($blog_id);

        return view('admin.view_blog', ['blog' => $blog]);

    }

    //Lưu danh mục Blog
    public function saveBlogCategory(Request $request){
        $data = array();
        $data['blogcategory_name'] = $request->blogcategory_name;
        $data['blogcategory_status'] = $request->blogcategory_status;

        DB::table('blogcategory')->insert($data);
        Session::put('message', "Thêm danh mục Blog thành công");

        return Redirect::to('/all-blog-category');
    }

    //Quản lý tất cả danh mục blog
    public function allBlogcategory(){
        $data = DB::table('blogcategory')->get();
        return view('admin.all_blog_category', ['data' => $data]);

    }

    public function export_csvBlogCategory(){
        return Excel::download(new BlogCategoryExport , 'blogcategory_blog.xlsx');
    }
    public function import_csvBlogCategory(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new BlogCategoryImport, $path);

        return redirect()->back();
    }

    /////////////Quản lý blog/////////////////////

    //Tất cả Blog
    public function manageBlog(){
        $blogs = DB::table('blogs')
        ->join('blogcategory','blogcategory.blogcategory_id','=','blogs.blogcategory_id')
        ->get();

        return view('admin.manage_blog')->with(compact('blogs'));  
    }

    //Thêm blog mới
    public function insertBlog(){
        $blogcate = DB::table('blogcategory')->orderBy('blogcategory_id','desc')->get();
        $products = Product::all();

        return view('admin.add_blog')->with(compact('blogcate', 'products'));  
    }

    //Lưu blog
    public function addBlog(Request $request){
        $data = array();
        $products = implode(',',$request->product);
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['summary'] = $request->summary;
        $data['product'] = $products;
        $data['blogcategory_id'] = $request->blogcategory_id;
        $data['user_id'] = Session::get('user_id') ? Session::get('user_id') : 1;
        if($data['user_id'] == 1){
            $data['status'] = $request->status;
        }
        else{
            $data['status'] = 0;
        }
        $get_image = $request->file('images');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/blog',$new_image);
            $data['images'] = $new_image;
            DB::table('blogs')->insert($data);
            Session::put('message','Thêm blog thành công');

            if($data['user_id'] == 1){
                return redirect()->back();
            }
            else{
                return view('share_blog_success');
            }
            
        }
        $data['images'] = '';
        DB::table('blogs')->insert($data);
        Session::put('message', "Thêm Blog thành công");

        if($data['user_id'] == 1){
            return redirect()->back();
        }
        else{
            return view('share_blog_success');
        }
    }

    //Chỉnh sửa Blog
    public function editBlog( $blog_id ){
        $cate = DB::table('blogcategory')->orderBy('blogcategory_id','desc')->get();
        $data = DB::table('blogs')->where('id', $blog_id)->get();

        return view('admin.edit_blog',['data' => $data, 'cate'=>$cate] );
    }

    //Xóa blog
    public function deleteBlog($blog_id ){
        $data = DB::table('blogs')->where('id', $blog_id)->delete();
        Session::put('message', "Xóa sản phẩm thành công");
        return redirect()->back();
    }

    //Cập nhật Blog
    public function updateBlog(Request $request, $blog_id ){
        $data = array();
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['summary'] = $request->summary;
        $data['status'] = $request->status;
        $data['blogcategory_id'] = $request->blogcategory_id;
        $get_image = $request->file('blog_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/blog',$new_image);
                    $data['blog_image'] = $new_image;
                    DB::table('blogs')->where('id',$blog_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('manage-blog');
        }
            
        DB::table('blogs')->where('id',$blog_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');

        return Redirect::to('manage-blog');

    }

    ////////////User//////////////
    //Hiển thị blog trên frontend
    public function blogs(){
        $blogcate = DB::table('blogcategory')->where('blogcategory_status','1')->orderby('blogcategory_id','desc')->get(); 
        $blogs = DB::table('blogs')->where('status','1')->orderby('id','desc')->simplePaginate(6); 
        $recentblogs = DB::table('blogs')->where('status','1')->orderby('created_at','desc')->limit(3)->get(); 

        return view('blogs',['blogcate'=>$blogcate, 'blogs'=>$blogs, 'recentblogs'=>$recentblogs]);
    }

    //Chi tiết blog
    public function blogdetail($blog_id){
        $blogcate = DB::table('blogcategory')->where('blogcategory_status','1')->orderby('blogcategory_id','desc')->get(); 
        $blog = DB::table('blogs')
        ->select('blogs.*', 'users.name', 'blogcategory.blogcategory_id', 'blogcategory.blogcategory_name')
        ->join('users', 'users.id', 'blogs.user_id')
        ->join('blogcategory','blogcategory.blogcategory_id','=','blogs.blogcategory_id')
        ->where('blogs.id',$blog_id)->get();
        $blog_view = Blog::find($blog_id);
        $blog_view->view ++;
        $blog_view->save();

        foreach($blog as $blogs){
            //Tăng view
            $related = $blogs->blogcategory_id;
            $products = $blogs->product;
            //Tăng point cho tác giả bài viết
            if($blogs->view % 100 == 0){
            $user = User::find($blogs->user_id);
            $user->point = $user->point + 2;
            $user->save();
            }
        }
        $pros = explode(',', $products);
        $pro = Product::select("*")
                ->whereIn('product_id', $pros)
                ->get();
        $relatedBlog = DB::table('blogs')
        ->join('blogcategory','blogcategory.blogcategory_id','=','blogs.blogcategory_id')
        ->where('blogs.blogcategory_id',$related)
        ->whereNotIn('blogs.id',[$blog_id])
        ->limit(3)->get();
        $recentblogs = DB::table('blogs')->where('status','1')->orderby('created_at','desc')->limit(3)->get(); 
        
        return view('blog_detail',['blogcate'=>$blogcate, 'blog'=>$blog, 'relatedBlog'=>$relatedBlog, 'recentblogs'=>$recentblogs, 'pro'=>$pro]);
    }

    //Tìm kiếm Blog
    public function searchBlog(Request $request){
        $keywords = $request->blog;
        $search_blog = Blog::whereRaw(
	        "MATCH(title) AGAINST(?)", 
	        array($keywords))->get();
        $recentblogs = DB::table('blogs')->where('status','1')->orderby('created_at','desc')->limit(3)->get(); 
        $blogcate = DB::table('blogcategory')->where('blogcategory_status','1')->orderby('blogcategory_id','desc')->get(); 

        return view('search_blog',['search_blog' => $search_blog, 'keywords'=>$keywords, 'recentblogs'=>$recentblogs, 'blogcate'=>$blogcate]);

    }


    public function categoryBlog($cateblog_id){
        $blogcate = DB::table('blogcategory')->where('blogcategory_status','1')->orderby('blogcategory_id','desc')->get(); 
        $category_name = DB::table('blogcategory')->where('blogcategory.blogcategory_id', $cateblog_id)->first();
        $blogs = DB::table('blogs')->join('blogcategory','blogs.blogcategory_id','blogcategory.blogcategory_id')->where('blogcategory.blogcategory_id', $cateblog_id)->simplePaginate(6);
        $recentblogs = DB::table('blogs')->where('status','1')->orderby('created_at','desc')->limit(3)->get(); 

        return view('category_blog', ['blogs' => $blogs, 'category_name' => $category_name,'blogcate' => $blogcate, 'recentblogs' => $recentblogs]);

    }

    public function shareBlog(){
        $blogcate = DB::table('blogcategory')->orderBy('blogcategory_id','desc')->get();
        $products = Product::all();

        return view('share_blog')->with(compact('blogcate', 'products'));  
    }

    public function checkBlog(){
        $blogs = DB::table('blogs')
        ->select('blogs.*', 'users.name', 'blogcategory.blogcategory_name')
        ->join('blogcategory','blogcategory.blogcategory_id','=','blogs.blogcategory_id')
        ->join('users','users.id','=','blogs.user_id')
        ->where('blogs.user_id', '<>', 1)
        ->get();

        return view('admin.check_blog')->with(compact('blogs'));  
    }

    public function passBlog($blog_id){
        $data =Blog::find($blog_id);
        $data->status = 1;
        $data->save();

        $user = User::find($data->user_id);
        $user->point += 5;
        $user->save();

        return Redirect::to('/check-blog');;
    }

   

    
}