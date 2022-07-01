@extends('admin_layout')
@section('content')
<!-- quan ly nguoi dung -->
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản lý người dùng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-btn">
           <a href="{{url('/add-user/')}}"> <button class="btn btn-primary" type="button">Thêm người dùng mới</button> </a>
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
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($user as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }} <input type="hidden" name="admin_email" value="{{ $user->admin_email }}"></td>
                <td>{{ $user->user_phone }}</td>
                <td>{{ $user->user_address }}</td>
                <td>
                <a onclick="return confirm('Bạn có muốn xóa người dùng này không?')" href="{{URL::to('/delete-user/'.$user->id)}}" class="active styling-edit" ui-toggle-class="">
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