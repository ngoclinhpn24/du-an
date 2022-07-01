@extends('admin_layout')
@section('content')
<!-- quan ly san pham -->
<section class="wrapper">
    <div class="table-agile-info">
<div class="panel panel-default">
<div class="panel-heading">
  Quản lý sản phẩm
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
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Hình ảnh</th>
        <th>Danh mục</th>
        <th>Trạng thái</th>
        <th style="width:30px;"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($all_product as $product)
      <tr>
        <td>{{$product->product_id}}</td>
        <td>{{$product->product_name}}</td>
        <td>{{ $product->product_quantity }}</td>
        <td>{{ number_format($product->product_price,0,',','.') }}đ</td>
        <td><img src="public/uploads/product/{{ $product->product_image }}" height="100" width="100"></td>
        <td>{{ $product->category_name }}</td>
        <td><span class="text-ellipsis">
        @php
        if ($product->product_status == 1) 
         {echo "Hiển thị" ;}
        else echo "Ẩn";
        @endphp
        </span></td>
        <td>
          <a href="{{url('edit-product/'.$product->product_id)}}" class="active" ui-toggle-class="">
            <i class="fa fa-pencil text-success text-active"></i>
          </a> 
          <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" href="{{url('delete-product/'.$product->product_id)}}" class="active" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <form action="{{url('import-product-csv')}}" method="POST" enctype="multipart/form-data">
    @csrf
  <input type="file" name="file" accept=".xlsx" required><br>
 <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
</form>
 <form action="{{url('export-product-csv')}}" method="POST">
    @csrf
 <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
</form>
</div>
</div>
@endsection