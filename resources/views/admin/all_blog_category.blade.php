@extends('admin_layout')
@section('content')
<!-- quan ly danh muc blog -->
<section class="wrapper">
    <div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  Quản lý danh mục blog
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
        <th>Tên danh mục blog</th>
        <th>Trạng thái</th>
        <th style="width:30px;"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $blogcate)
        
      <tr>
        <td>{{$blogcate->blogcategory_name}}</td>
        <td><span class="text-ellipsis">
        @php
        if ($blogcate->blogcategory_status == 1) 
         {echo "Hiển thị" ;}
        else echo "Ẩn";
        @endphp
        </span></td>
        <td>
          <a href="{{url('edit-blog-category/'.$blogcate->blogcategory_id)}}" class="active" ui-toggle-class="">
            <i class="fa fa-pencil text-success text-active"></i>
          </a> 
          <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục Blog này không?')" href="{{url('delete-blog-category/'.$blogcate->blogcategory_id)}}" class="active" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <form action="{{url('blogcategory-import-csv')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input  type="file" name="file" accept=".xlsx" required><br>
    <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
  </form>
  <form action="{{url('blogcategory-export-csv')}}" method="POST">
      @csrf
    <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
  </form>
  </div>
</div>
@endsection