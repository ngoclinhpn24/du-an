@include('header')
@include('nav_user')
<!-- doi qua -->
        <div class="col-lg-8 pb-5">
            <div class="gift card">

            </div>
            <div class="d-flex justify-content-end pb-3">
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="myTable">
                    <thead>
                        <tr>
                            <th>Điểm</th>
                            <th>Quà tặng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gifts as $gift)
                            
                        
                        <tr>
                            <td>{{$gift->point}}</td>
                            <td>{{$gift->gift}}</td>
                            <td>
                                <a href="javascript:" onclick="exchangepoint({{$gift->point}})">
                                    <button class="btn btn-success">Đổi quà</button>
                                </a>
                            </td>
                          </tr>
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('footer')
<script>
    function reloadPoint(){
        $.ajax({
            type: "GET",
            url: "get-point",
            success: function (response) {
                $('.point').empty();
                $('.point').html(response);

            }
        });
    }
    function exchangepoint(point) {
        $.ajax({
            type: "GET",
            url: "exchange-gift/" + point,
            success: function (response) {
                $('.gift').empty();
                $('.gift').html(response);
                reloadPoint();

            }
        });
    }
</script>

