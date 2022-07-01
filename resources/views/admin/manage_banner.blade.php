@extends('admin_layout')
@section('content')
<!-- quan ly banner -->
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản lý Banner quảng cáo
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Tên Banner</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Tình trạng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($banners as $key => $banner)
          <tr>
            <td>{{ $banner->banner_name }}</td>
            <td><img src="public/uploads/banner/{{ $banner->banner_image }}" height="200" width="300"></td>
            <td>{{ $banner->banner_desc }}</td>
            <td><span class="text-ellipsis">
              <?php
               if($banner->banner_status==1){
                ?>
                <a href="{{URL::to('/unactive-banner/'.$banner->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-banner/'.$banner->id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
              ?>
            </span></td>
            <td>
              <a onclick="return confirm('Bạn có muốn xóa banner này không?')" href="{{URL::to('/delete-banner/'.$banner->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection