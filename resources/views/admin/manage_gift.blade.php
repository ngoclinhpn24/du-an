@extends('admin_layout')
@section('content')
<!-- quan ly qua tang -->
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản lý quà tặng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-btn">
           <a href="{{url('/add-gift/')}}"> <button class="btn btn-primary" type="button">Thêm quà tặng mới</button> </a>
          </span>
        </div>
      </div>
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
            <th>Điểm Eko Point</th>
            <th>Quà tặng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($gifts as $gift)
              <tr>
                <td>{{ $gift->point }}</td>
                <td>{{ $gift->gift }}</td>
                <td>
                <a onclick="return confirm('Bạn có muốn xóa người dùng này không?')" href="{{URL::to('/delete-gift/'.$gift->id)}}" class="active styling-edit" ui-toggle-class="">
                  <i class="fa fa-times text-danger text"></i>
                </a>
              </td> 
              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection