<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tặng quý khách mã giảm giá tại siêu thị xanh</title>
</head>
<body>
    <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Tên mã giảm giá: {{$coupon->coupon_name}}</li>
          <li class="list-group-item">Mã giảm giá: {{$coupon->coupon_code}}</li>
          <li class="list-group-item">Giảm: {{$coupon->coupon_discount}} 
            @if ($coupon->coupon_discount == 1)
                %
            @else
               VNĐ 
            @endif
        </li>
          <li class="list-group-item">Cho đơn từ: {{$coupon->coupon_min}} VNĐ </li>
          <li class="list-group-item">Hạn sử dụng: {{$coupon->coupon_end}} </li>
        </ul>
      </div>
</body>
</html>