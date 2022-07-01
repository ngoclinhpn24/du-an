<!DOCTYPE html>
<head>
<title>Kênh người bán</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{('backend/css/font.css" type="text/css')}}"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('backend/css/morris.css" type="text/css')}}"/>
<link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('backend/js/raphael-min.js')}}"></script>
<script src="{{asset('backend/js/morris.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend/js/jquery.form-validator.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('backend/DataTables/datatables.min.css')}}"/>
<script type="text/javascript" src="{{asset('backend/DataTables/datatables.min.js')}}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
 
<script>
    $(document).ready( function () {
        $('#myTable').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
        } );
        $('#myTable1').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
        } );
        $('#myTable2').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
        } );
        $('#myTable3').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
        } );
    } );
</script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
$( function() {
  $( "#datepicker1" ).datepicker(
      {
          dateFormat: "dd-mm-yy" ,
          onSelect: function (date) {
              var dt1 = $('#datepicker1').datepicker('getDate');
              var dt2 = $('#datepicker2').datepicker('getDate');
              if (dt1 > dt2) {
                  $('#datepicker2').datepicker('setDate', dt1);
              }
              $('#datepicker2').datepicker('option', 'minDate', dt1);
          }
      }
  );
  $( "#datepicker2" ).datepicker(
      {
          dateFormat: "dd-mm-yy" ,
          minDate: $('#datepicker1').datepicker('getDate'),
          onClose: function () {
              var dt1 = $('#datepicker1').datepicker('getDate');
              var dt2 = $('#datepicker2').datepicker('getDate');
              
              if (dt2 <= dt1) {
                  var minDate = $('#datepicker2').datepicker('option', 'minDate');
                  $('#datepicker2').datepicker('setDate', minDate);
              }
          }
  });
} );

</script>
</head>
<body>
<!-- navbar ben trai + tren -->
    <section id="container">
    <header class="header fixed-top clearfix" style="background: #EEF2FF">
    <div class="brand" style="background: #21325E">
        <a href="{{url('/dashboard')}}" class="logo">
            DashBoard
        </a>
        <div class="sidebar-toggle-box" style="background: #2F86A6">
            <div class="fa fa-bars" ></div>
        </div>
    </div>
    <div class="top-nav clearfix" style="background: #EEF2FF">
        <ul class="nav pull-right top-menu" >
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="background: #DBF6E9;">
                    <img alt="" src="images/2.png">
                    <span class="username">
                        @php
                            $name = Session::get('admin_name');
                            if($name){
                                echo $name;
                                Session::put('name','');
                            }
                        @endphp
                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout" >
                    <li><a href="{{url('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </header>
    <aside>
        <div id="sidebar" class="nav-collapse" style="background: hsl(198, 40%, 38%)">
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="{{url('/dashboard')}}">
                            <i class="fa fa-home"></i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a class="active" href="{{url('/manage-order')}}">
                            <i class="fa fa-cogs"></i>
                            <span>Quản lý đơn hàng</span>
                        </a>
                    </li> --}}
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-percent"></i>
                            <span>Quản lý đơn hàng</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{url('/manage-order')}}">Tất cả đơn hàng</a></li>
                            <li><a href="{{url('/handle-order')}}">Xử lý đơn hàng</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-folder-o"></i>
                            <span>Danh mục sản phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-category')}}">Thêm danh mục sản phẩm</a></li>
                            <li><a href="{{URL::to('/all-category')}}">Quản lý danh mục sản phẩm</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-folder-open-o"></i>
                            <span>Quản lý sản phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                            <li><a href="{{URL::to('/all-product')}}">Quản lý sản phẩm</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="active" href="{{url('/manage-user')}}">
                            <i class="fa fa-users"></i>
                            <span>Quản lý người dùng</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="{{url('/manage-employee')}}">
                            <i class="fa fa-user"></i>
                            <span>Quản lý nhân viên</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-star-o"></i>
                            <span>Blog nấu ăn</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{url('/insert-blog')}}">Thêm Blog</a></li>
                            <li><a href="{{url('/add-blog-category')}}">Thêm danh mục Blog</a></li>
                            <li><a href="{{url('/manage-blog')}}">Quản lý Blog</a></li>
                            <li><a href="{{url('/all-blog-category')}}">Quản lý danh mục Blog</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="active" href="{{url('/check-blog')}}">
                            <i class="fa fa-paw"></i>
                            <span>Blog người mua</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="{{url('/manage-gift')}}">
                            <i class="fa fa-gift"></i>
                            <span>Quản lý quà tặng</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-percent"></i>
                            <span>Mã giảm giá</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{url('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                            <li><a href="{{url('/manage-coupon')}}">Quản lý mã giảm giá</a></li>
                            <li><a href="{{url('/send-coupon')}}">Gửi mã giảm giá cho khách</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a class="active" href="{{url('/manage-comment')}}">
                            <i class="fa fa-comments-o"></i>
                            <span>Quản lý, kiểm duyệt bình luận</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="{{url('/manage-feedback')}}">
                            <i class="fa fa-history"></i>
                            <span>Quản lý khiếu nại</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-hourglass-o"></i>
                            <span>Banner quảng cáo</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{url('/add-banner')}}">Thêm Banner quảng cáo</a></li>
                            <li><a href="{{url('/manage-banner')}}">Quản lý Banner quảng cáo</a></li>
                        </ul>
                    </li>
                    
                </ul>          
            </div>
        </div>
    </aside>
    <section id="main-content">
        <section class="wrapper">
                @yield('content')
        </section>
    </section>
    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
    <script src="js/jquery.scrollTo.js"></script>
    <script>
        $(document).ready(function() {
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }
        });
        </script>
        <script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>
</body>
<script type="text/javascript">
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
    CKEDITOR.replace( 'editor4' );
    CKEDITOR.replace( 'editor5' );
</script>
<script type="text/javascript">
    $.validate({
    });
</script>
</html>
