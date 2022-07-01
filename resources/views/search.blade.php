@include('header')
<!-- tim kiem -->
<section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh mục</span>
                        </div>
                        <ul>
                            @foreach ($cate as $category)  
                            <li><a href="{{url('danh-muc/'.$category->category_id)}}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                        <form method="POST" action="{{url('/tim-kiem')}}" >
                                @csrf
                                <input type="text" name="keywords_submit" id="keyword" placeholder="Bạn cần tìm gì?">
                                <div id="search-ajax"></div>
                                <button type="submit"  class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+84 999 999</h5>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="breadcrumb-section set-bg container" data-setbg="img/bread.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Kết quả tìm kiếm</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Tìm kiếm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row featured__filter mt-4">
        @foreach ($search_product as $pro)
        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
            <div class="featured__item">
                <div class="featured__item__pic set-bg" data-setbg="{{URL('public/uploads/product/'.$pro->product_image)}}">
                    <ul class="featured__item__pic__hover">
                        <li><a href="javascript:" onclick="addToWishlist({{$pro->product_id}})"><i class="fa fa-heart"></i></a></li>
                        <li><a  href="{{url('generate-qrcode/'.$pro->product_id)}}" target="_blank"><i class="fa fa-qrcode"></i></a></li>
                        <li><a onclick="addToCart({{$pro->product_id}})" href="javascript:" ><i class="fa fa-shopping-cart "></i></a></li>
                    </ul>
                </div>
                <div class="featured__item__text">
                    <h6><a href="{{url('/chi-tiet/'.$pro->product_id)}}">{{$pro->product_name}}</a></h6>
                    <h5>{{number_format($pro->product_price)}} VNĐ</h5>
                </div>
            </div>
        </div>
        @endforeach   
    </div>
</div>

@include('footer')