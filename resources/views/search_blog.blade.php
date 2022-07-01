@include('header')
<!-- ket qua tim kiem -->
<section class="breadcrumb-section set-bg container" data-setbg="img/bread.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Blog nấu ăn</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('market')}}">Cửa hàng</a>
                        <span>Kết quả tìm kiếm cho từ khóa "{{$keywords}}"</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form method="POST" action="{{url('/tim-kiem-blog')}}" >
                            @csrf
                            <input type="text" name="blog" placeholder="Tìm kiếm...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Danh mục</h4>
                        <ul>
                            @foreach ($blogcate as $item)
                            <li><a href="{{url('danh-muc-blog/'.$item->blogcategory_id)}}">{{$item->blogcategory_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Tin mới</h4>
                        <div class="blog__sidebar__recent">
                            @foreach ($recentblogs as $item)
                            <a href="{{url('/blog/'.$item->id)}}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img width="100" height="100" src="{{URL('/public/uploads/blog/'.$item->images)}}" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{$item->title}}</h6>
                                    <span>{{$item->created_at}}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach ($search_blog as $item)
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img width="300" height="300" src="{{URL('/public/uploads/blog/'.$item->images)}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o" style="padding-right: 5px"></i>{{$item->created_at}}</li>
                                    <li><i class="fa fa-eye"></i> {{$item->view}}</li>
                                </ul>
                                <h5><a href="{{url('/blog/'.$item->id)}}">{{$item->title}}</a></h5>
                                <p>{!!$item->summary!!}</p>
                                <a href="{{url('/blog/'.$item->id)}}" class="blog__btn">Đọc thêm... <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('footer')