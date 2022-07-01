@include('header')
<!-- gio hang -->
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
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Trang chủ</a>
                            <span>Giỏ hàng của bạn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@php
$total = 0;
@endphp
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div  id="change-item-cart" class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody >
                                @if($cart)
                                @foreach($cart->products as $carts)
                                <tr >
                                    
                                    <td class="shoping__cart__item">
                                        <img style="width:150px; hight:150px" src="{{URL('/public/uploads/product/'.$carts['info']->product_image)}}" alt="">
                                       <a href="{{url('/chi-tiet/'.$carts['info']->product_id)}}"> <h5>{{$carts['info']->product_name}}</h5> </a>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{number_format($carts['info']->product_price)}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input data-id="{{$carts['info']->product_id}}" type="text" value="{{$carts['quantity']}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                      @php
                                          $total = $carts['quantity']*$carts['info']->product_price
                                      @endphp
                                      {{number_format($total)}} VND
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a  href="javascript:">
                                        <span class="icon_close" data-id = "{{$carts['info']->product_id}}"></span>
                                    </a>
                                    </td>
                                </tr>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{url('market')}}" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
                        <a href="javascript:void(0)" onclick="updateCart()" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading "></span>
                            Cập nhật giỏ hàng</a>
                    </div>
                </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Tổng tiền</h5>
                        <ul>
                            <li >Tạm tính<span id="total">{{number_format($cart->totalPrice)}} VNĐ </span></li>
                        </ul>
                        <?php
                        $user_id = Session::get('user_id');
                        if($user_id!=NULL){ 
                      ?>
                      <div class="header__top__right__auth" style="float: right">
                        <a href="{{url('checkout')}}" class="primary-btn">Tiếp tục thanh toán</a>
                     </div>
                     <?php
                 }else{
                      ?>
                      <div class="header__top__right__auth" style="float: right">
                        <a href="{{url('login-user')}}" class="primary-btn">Tiếp tục thanh toán</a>
                     </div>
                      <?php 
                  }
                      ?>
                    @else
                    <h4 style="text-align: center;" class="mb-4">Giỏ hàng của bạn đang trống</h4>  
                    <div style="text-align: center;" class="mb-4">
                        <a href="{{url('/')}}" >
                        <button class="btn btn-primary ml-7">Tiếp tục mua sắm</button>
                        </a>
                        <a href="{{url('manage-order-user')}}" >
                        <button class="btn btn-primary">Xem lại đơn hàng</button>
                        </a>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
           
        </div>
    </section>
@include('footer')
<script>
    $('#change-item-cart').on("click", ".icon_close", function() {
        $.ajax({
            type: "GET",
            url: "delete-cart/"+$(this).data("id"),
            success: function (response) {
                $('#change-item-cart').empty;
                $('#change-item-cart').html(response);
                reloadTotal();
                alertify.success('Đã xóa sản phẩm khỏi giỏ hàng');
        }
        });
    });
    function reloadTotal(){
        $.ajax({
            type: "GET",
            url: "reload-total",
            success: function (response) {
                $('#total').empty;
                $('#total').html(response);
        }
        });
    }
    function updateCart(){
        var lists = [];
        $("table tbody tr td").each(function(){
            $(this).find("input").each(function(){
                var element = {key: $(this).data("id"), value: $(this).val()};
                lists.push(element);
            })
        })
        $.ajax({
            url: "save-cart-all",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "data": lists
                }
            }).done(function(){
                location.reload();
            });
        }  
</script>