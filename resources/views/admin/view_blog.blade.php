@include('header')
<!-- xem blog -->
 <section class="breadcrumb-section set-bg container" data-setbg="{{asset('img/blog/details/breadcrumb.jpg')}}" style="margin-bottom: 10px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{$blog->title}}</h2>
                    <ul>
                        <li>Tác giả: {{$blog->name}}</li>
                        <li>Ngày đăng tải: {{$blog->created_at}}</li>
                        <li> Lượt xem: {{$blog->view}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div style="margin-top: 30px; margin-bottom: -30px; text-align: center">
                <a onclick="return confirm('Bạn có xác nhận phê duyệt blog này không?')" href="{{url('pass-blog/'.$blog->id)}}" class="active" ui-toggle-class="">
                    <button class="btn btn-success" style="margin-right: 10px">Phê duyệt</button>
                </a>
                <a onclick="return confirm('Bạn có muốn xóa blog này không?')" href="{{url('delete-blog/'.$blog->id)}}" class="active" ui-toggle-class="">
                    <button class="btn btn-danger">Xóa</button>
                </a>
</div>
<section class="blog-details spad">
    <div class="container">   
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
            
            

                <div class="blog__details__text">
                    <img src="{{URL('/public/uploads/blog/'.$blog->images)}}" alt="">
                    {!! $blog->content !!}
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="{{asset('img/blog/details/details-author.png')}}" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>{{$blog->name}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Danh mục:</span> {{$blog->blogcategory_name}}</li>
                                    <li><span>Tags:</span> Tất cả, Nấu ăn, Món ngon</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('footer')