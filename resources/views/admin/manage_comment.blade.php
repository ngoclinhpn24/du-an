@extends('admin_layout')
@section('content')
<!-- quan ly binh luan -->
<section class="wrapper">
    <div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  Quản lý Bình luận
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
        <th>Tên</th>
        <th>Nội dung</th>
        <th>Thời gian</th>
        <th>Sản phẩm</th>
        <th>Trạng thái</th>
        <th>Xóa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($comments as $comment)
      <tr>
        <td>{{$comment->name}}</td>
        <td>{{$comment->comment}}</td>
        <td>{{$comment->created_at}}</td>
        <td>{{$comment->product->product_name}}</td>
        @if($comment->status == 0)
            <td>Hiển thị</td>
        @else
            <td>Ẩn</td>
        @endif
        <td><a onclick="return confirm('Bạn có muốn xóa bình luận này không?')" href="{{url('/delete-comment/'.$comment->id)}}"><i class="fa fa-times text-danger text"></i> </a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@endsection