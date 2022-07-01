@include('header')
<!-- chi tiet blog nau an -->
<section class="breadcrumb-section set-bg container" data-setbg="{{asset('img/blog/details/breadcrumb.jpg')}}">
    <div class="container">
        @foreach ($blog as $item)
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{$item->title}}</h2>
                    <ul>
                        <li>Tác giả: {{$item->name}}</li>
                        <li>Ngày đăng tải: {{$item->created_at}}</li>
                        <li> Lượt xem: {{$item->view}}</li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form method="POST" action="{{url('/tim-kiem-blog')}}" >
                            @csrf
                            <input type="text" name="blog" placeholder="Tìm kiếm...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Danh mục blog</h4>
                        <ul>
                            @foreach ($blogcate as $item)
                            <li><a href="{{url('danh-muc-blog/'.$item->blogcategory_id)}}">{{$item->blogcategory_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Sản phẩm liên quan</h4>
                        <div class="blog__sidebar__recent">
                            @foreach ($pro as $item)
                            <a href="{{url('/chi-tiet/'.$item->product_id)}}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img width="100" height="100" src="{{URL('/public/uploads/product/'.$item->product_image)}}" alt="">
                                </div>
                            
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{$item->product_name}}</h6>
                                </div>
                            </a>
                            <a href="javascript:" onclick="addToCart({{$item->product_id}})">
                            <button class="btn btn-light mb-4" style="background: #B8F1B0">Mua ngay</button>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($blog as $item)
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <img src="{{URL('/public/uploads/blog/'.$item->images)}}" alt="">
                    {!! $item->content !!}
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="{{asset('img/blog/details/details-author.png')}}" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>{{$item->name}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Danh mục:</span> {{$item->blogcategory_name}}</li>
                                    <li><span>Tags:</span> Tất cả, Nấu ăn, Món ngon</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Có thể bạn quan tâm</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($relatedBlog as $item)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{URL('/public/uploads/blog/'.$item->images)}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> {{$item->created_at}}</li>
                            <li><i class="fa fa-eye"></i> {{$item->view}}</li>
                        </ul>
                        <h5><a href="{{url('/blog/'.$item->id)}}">{{$item->title}}</a></h5>
                        <p>{!!$item->summary!!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@include('footer')