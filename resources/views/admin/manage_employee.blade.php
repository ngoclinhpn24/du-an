@extends('admin_layout')
@section('content')
<!-- quan ly nhan vien -->
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản lý nhân viên
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3">
        <div class="input-group">
          <span class="input-group-btn">
           <a href="{{url('/add-employee/')}}"> <button class="btn btn-primary" type="button">Thêm nhân viên mới</button> </a>
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
            <th>Chức vụ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($employee as $employee)
              <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->employee_name }}</td>
                <td>{{ $employee->employee_email }} <input type="hidden" name="admin_email" value="{{ $employee->admin_email }}"></td>
                <td>{{ $employee->employee_phone }}</td>
                <td>{{ $employee->employee_address }}</td>
                <td>{{ $employee->employee_job }}</td>
                <td>
                <a onclick="return confirm('Bạn có muốn xóa thông tin nhân viên này không?')" href="{{URL::to('/delete-employee/'.$employee->id)}}" class="active styling-edit" ui-toggle-class="">
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