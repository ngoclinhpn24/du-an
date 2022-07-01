<!-- footer -->
{{-- <div class="zalo-chat-widget" data-oaid="1247350748129031789" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>

<script src="https://sp.zalo.me/plugins/sdk.js"></script> --}}
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="img/eco.png" alt=""></a>
                    </div>
                    <ul>
                        <li>Địa chỉ: Xuân Thủy, Cầu Giấy</li>
                        <li>Điện thoại: +84 999 999</li>
                        <li>Email: sieuthixanh@online.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1 m-4">
                <div class="footer__widget">
                    <ul>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Thông tin cửa hàng</a></li>
                        <li><a href="#">Chính sách giao hàng</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Dịch vụ</a></li>
                        <li><a href="#">Dự án</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Chăm sóc khách hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Đăng ký nhận thông báo</h6>
                    <p>Chúng tôi sẽ gửi bạn thông báo khuyến mãi sớm nhất.</p>
                    <form action="#">
                        <input type="text" placeholder="Nhập mail">
                        <button type="submit" class="site-btn">Đăng ký</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p>
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
</p></div>
                    <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>

        <button onclick="topFunction()" id="scrollUp" title="Go to top">
            <i class="fa fa-angle-up"></i>
        </button>
    </div>
</footer>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/mixitup.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/lightslider.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.calculate_delivery').click(function(){
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            var _token = $('input[name="_token"]').val();
            if(matp == '' && maqh =='' && xaid ==''){
                alert('Làm ơn chọn để tính phí vận chuyển');
            }else{
                $.ajax({
                url : '{{url('/calculate-fee')}}',
                method: 'POST',
                data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                success:function(){
                   location.reload(); 
                }
                });
            } 
    });
});
</script>
<script>
    $(document).ready(function () {
        
        load_comment();
        function load_comment() {  
            var product_id = $('.comment_product_id').val();
            $.ajax({
                type: "POST",
                url: '{{url('/load-comment')}}',
                data: {
                    product_id: product_id, "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('#load_comment').html(response);
                }
            });
        }

        $('.send_comment').click(function () { 
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
           $.ajax({
                method: "POST",
                url: '{{url('/send-comment')}}',
                data: {
                    product_id: product_id, 
                    comment_name: comment_name, 
                    comment_content: comment_content, 
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    load_comment();
                    $('.comment_name').val('');
                    $('.comment_content').val('');

                }
            });
            
        });

    
    });
</script>
<script>

    function removeBackground(product_id){
        for(var count =1 ; count<=5; count++){
            $('#'+product_id+'-'+count).css('color', '#ccc')
        }
    }
    $(document).on('mouseenter', '.rating',function () { 
        var index = $(this).data("index");
        var product_id = $(this).data("product_id");
        removeBackground(product_id);
        for(var count =1 ; count<=index; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00')
        }
        
    });

    $(document).on('mouseleave', '.rating',function () { 
        var index = $(this).data("index");
        var product_id = $(this).data("product_id");
        var rating = $(this).data("rating");
        removeBackground(product_id);
        for(var count =1 ; count<=rating; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00')
        }
        
    });

    $(document).on('click', '.rating',function () { 
        var index = $(this).data("index");
        var product_id = $(this).data("product_id");
        $.ajax({
                type: "POST",
                url: '{{url('/rating')}}',
                data: {
                    product_id: product_id, 
                    index: index, 
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    if(response=='done'){
                        alertify.success("Bạn đã đánh giá thành công");
                    }
                    else{
                        alertify.error("Bạn đã đánh giá trước đó");
                    }

                }
            });
        
        
    });
</script>
<script>
   function addToWishlist(id) {
        $.ajax({
            type: "GET",
            url: location.origin + "/sieuthi/public/add-to-wishlist/" + id,
            success: function (response) {
                if (response == 'success') {
                    alertify.success('Đã thêm sản phẩm vào yêu thích');
                } else {
                    alertify.error('Sản phẩm đã được thêm vào yêu thích trước đó');
                }
            }
        });
    }

    function removeWishlist(id) {
        $.ajax({
            type: "GET",
            url: "remove-wishlist/"+id,
            success: function (response) {
                if (response == 'success') {
                    alertify.success('Đã thêm sản phẩm vào yêu thích');
                } else {
                    alertify.error('Sản phẩm đã được thêm vào yêu thích trước đó');
                }
            }
        });
    }
</script>

<script>
$(document).ready(function(){
    $('#sort').change(function () { 
        var url = $(this).val();
        if(url){
            window.location = url;
        }
        return false;
        
    });
});

</script>
<script>
  $( function() {
    $( "#slider-range" ).slider({
      orientation: "vertical",
      range: true,
      min: 10000,
      max: 2000000,
      values: [ 10000, 2000000 ],
      step: 10000,
      slide: function( event, ui ) {
        $( "#amount" ).val( "đ" + ui.values[ 0 ] + " - đ" + ui.values[ 1 ] );
        $( "#start_price" ).val(ui.values[ 0 ]);
        $( "#end_price" ).val(ui.values[ 1 ]);
      }
    });
    $( "#amount" ).val( "đ" + $( "#slider-range" ).slider( "values", 0 ) +
      " - đ" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>
<script>
    function addToCart(id) {
        $.ajax({
            type: "GET",
            url: location.origin + "/sieuthi/public/add-to-cart/" + id,
            success: function (response) {
                $('#total-quantity').text($('#total-quantity').val());
                alertify.success('Đã thêm sản phẩm vào giỏ hàng');
            }
        });
    }
   
</script>

<script type="text/javascript" src="{{asset('backend/DataTables/datatables.min.js')}}"></script>
 
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
        // } );
        $('#myTable1').DataTable();
        } );
        
</script>
<script type="text/javascript" src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
    CKEDITOR.replace( 'editor4' );
    CKEDITOR.replace( 'editor5' );
</script>

<!-- scroll up -->
<script>
    var mybutton = document.getElementById("scrollUp");
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</body>

</html>