<!-- chi tiet spham gio hang -->
<div class="shoping__cart__table">
    <table>
        <thead>
            <tr>
                <th class="shoping__product">Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th></th>
            </tr>
        </thead>
        <tbody >
            @if(Session::get('cart'))
            @foreach(Session::get('cart')->products as $carts)
            <tr >
                <td class="shoping__cart__item">
                    <img style="width:150px; hight:150px" src="{{URL('/public/uploads/product/'.$carts['info']->product_image)}}" alt="">
                    <h5>{{$carts['info']->product_name}}</h5>
                </td>
                <td class="shoping__cart__price">
                    {{$carts['info']->product_price}}
                </td>
                <td class="shoping__cart__quantity">
                    <div class="quantity">
                        <div class="pro-qty">
                            <input data-id="{{$carts['info']->product_id}}" type="text" value="{{$carts['quantity']}}">
                        </div>
                    </div>
                </td>
                <td class="shoping__cart__total">
                    @php
                    $total = $carts['quantity']*$carts['info']->product_price
                @endphp
                {{number_format($total)}}
                </td>
                <td class="shoping__cart__item__close">
                    <a  href="javascript:">
                    <span class="icon_close" data-id = "{{$carts['info']->product_id}}"></span>
                </a>
                </td>
            </tr>
            </tr>
            @endforeach 
        </tbody>
        @endif
    </table>
</div>
</div>