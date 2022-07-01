@include('header')
<!-- trang chia se blog cua nguoi dung -->
<div class="container mb-4 main-container">
    <div class="row">
        <div class="col-lg-3 pb-5" style="margin-right: 40px; margin-top: 40px">
            <div class="author-card pb-3">
                <div class="author-card-profile">
                    <div class="author-card-avatar">
                        <a href="https://www.fahasa.com/30-thuc-don-bua-an-hang-ngay.html" target="_blank">
                            <img src="images/share-5.jpg" alt="">
                        </a>
                    </div>
                    <div class="share-cook" style="margin-top: 20px">
                        <strong style="color:red">Khi 1 bài đăng được chia sẻ ^-^</strong>
                        <ul>
                            <li><b>Bạn sẽ được nhận ngay 5 point </b></li>
                            <li><b>Cứ 100 view bạn sẽ được 1 point </b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <h3 style="text-align: center; font-size:30px;  margin-bottom: 8px">Chia sẻ công thức nấu ăn ngon</h3>
            <p style="text-align: center;  margin-bottom: 25px; color:orange"><b>Nhanh tay chia sẻ công thức nấu ăn, nhận hàng ngàn ưu đãi nào ^-^</b></p>
            <form role="form" method="POST" action="{{url('/add-blog')}}" enctype="multipart/form-data">
                @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tiêu đề Blog</label>
                <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control" name="title" placeholder="Nhập tiêu đề Blog" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ảnh minh họa</label>
                <input type="file" class="form-control" name="images" id="exampleInputEmail1" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tóm tắt</label>
                <textarea id="editor2" style="resize :none" rows="4" type="text" class="form-control" name="summary"  placeholder="Mô tả ngắn" required>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả chi tiết</label>
                <textarea id="editor3" style="resize :none" rows="8" type="text" class="form-control" name="content"  placeholder="Mô tả Blog" required>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Danh mục blog</label>
                <select name="blogcategory_id" class="form-control input-lg m-bot15" required>
                    @foreach ($blogcate as $cate)
                    <option value="{{$cate->blogcategory_id}}">{{$cate->blogcategory_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sản phẩm giới thiệu</label>
                <select class="form-control" multiple  name="product[]" rows = "5" required>
                    @foreach ($products as $pro)
                    <option value="{{$pro->product_id}}">{{$pro->product_name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-success" onclick="alert('Bạn đã chia sẻ blog thành công!')">Gửi bài viết</button>
            </form>
        </div>
    </div>
</div>

@include('footer')




