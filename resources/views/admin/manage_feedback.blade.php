@extends('admin_layout')
@section('content')
<!-- quan ly khieu nai nguoi dung -->
<section class="wrapper">
    <div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  Quản lý Khiếu nại
</div>
</div>
<div class="row w3-res-tb">
  @php
		$message = Session::get('message');
		if($message){
			 echo $message;
			 Session::put('message','');
		}
	@endphp
</div>
<div class="table-responsive">
  <table class="table table-striped b-t b-light" id="myTable">
    <thead>
      <tr>
        <th>Mã</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Vấn đề</th>
        <th>Nội dung</th>
        <th>Đơn hàng</th>
        <th>Trạng thái</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($feedbacks as $feedback)
      <tr>
        <td>{{$feedback->id}}</td>
        <td>{{$feedback->name}}</td>
        <td>{{$feedback->email}}</td>
        <td>{{$feedback->phone}}</td>
        <td>{{$issues[$feedback->issue]}}</td>
        <td>{{$feedback->feedback}}</td>
        <td><a href="{{url('/view-order/'.$feedback->order_id)}}"  target="_blank" rel="noopener noreferrer">{{$feedback->order_id}}</a></td>
        <td><span class="text-ellipsis">
        @php
        if ($feedback->status == 0) 
         {echo "Chưa xử lý" ;}
        else echo "Đã xử lý";
        @endphp
          @if ($feedback->status == 0)
        <td>
          <a onclick="return confirm('Bạn đã xử lý khiếu nại này?')" href="{{url('handle-feedback/'.$feedback->id)}}" class="active" ui-toggle-class="">
            <i class="fa fa-check"></i>
          </a>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection