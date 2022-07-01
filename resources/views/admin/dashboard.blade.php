@extends('admin_layout')
@section('content')
<!-- tong quan admin -->
		<div class="row market-updates">
			<div class="col-md-3 market-update-gd" >
				<div class="market-update-block clr-block-2 dash-hov" style ="width: 245px; height: 128px; background: #F32424">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Lượt xem</h4>
					<h4>{{$totalView}}</h4>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1" style ="width: 247px; height: 128px; background: #56ad39">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users"></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Người dùng</h4>
						<h4>{{$userNumber}}</h4>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3" style ="width: 249px; height: 128px; background: orange">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Doanh thu</h4>
						<h4 style="font-size: 16px">{{number_format($totalSale)}} VNĐ</h4>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4" style ="width: 245px; height: 128px; background: #0AA1DD">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Đơn hàng</h4>
						<h4>{{$totalOrder}}</h4>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
			<div class="clearfix"> </div>
				<div class="col-md-12 agile-last-left agile-last-middle">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Báo cáo theo ngày</h3>
						</div>
						<div id="graph"></div>
					</div>
				</div>
			<div>
			<div class="col-md-6 stats-info widget" style="margin-top: 35px; ">
					<div class="area-grids-heading">
						<h3>Đơn hàng</h3>
					</div>
					<div id="donut"></div>
					<script>
						$(document).ready(function () {
							getData();
							var chart = Morris.Bar({
							element: 'graph',
							xkey: 'day',
							ykeys: ['total', 'sum'],
							labels: ['Số đơn hàng', 'Doanh thu'],
							xLabelAngle: 10
							});
							function getData(){
								$.ajax({
									type: "get",
									url: "{{url('get-chart-data')}}",
									dataType: "json",
									success: function (response) {
										chart.setData(response);
									}
								});
							};
							function getDonutData(){
									$.ajax({
										type: "get",
										url: "{{url('get-donut-data')}}",
										dataType: "json",
										success: function (response) {
											donut.setData(response);
										}
								});
							};
							getDonutData();
							var donut = Morris.Donut({
								element: 'donut',
								data: [{"value":"","label":""}],
								colors: ['#e00b00','#002fff','#00e038','#2D619C'],
							});
						});
					</script>
				</div>
				<div class="col-md-6 stats-info widget">
					<div class="stats-info-agileits">
						<div class="stats-title">
							<h4 class="title">Top sản phẩm bán chạy</h4>
						</div>
						<div class="stats-body">
							<ul class="list-unstyled">
								@foreach ($product as $item)
								<a href="{{url('/chi-tiet/'.$item->product_id)}}">
								<li>{{$item->product_name}} <span class="pull-right">{{$item->sold}}</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar green" style="width:{{$item->sold}}%;"></div> 
									</div>
								</li>
								</a>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
@endsection