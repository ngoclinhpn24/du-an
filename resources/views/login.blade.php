@include('header')
	<div class="wrapper" style="background-image: url('images/bg-registration-form-3.jpg');">  
        <div class="form-modal">

            <div class="form-toggle">
                <button id="login-toggle" onclick="toggleLogin()">đăng nhập</button>
                <button id="signup-toggle" onclick="toggleSignup()">đăng ký</button>
            </div>

            <div id="login-form">
                <form action="{{URL('/login')}}" method="post">
					{{csrf_field()}}
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="Mật khẩu" required/>
                    <span class="remember" >
                        <input type="checkbox" class="checkbox" checked>
                        <label for="remember-me">Ghi nhớ đăng nhập</label>
                    </span>
                    <h6><a href="#">Quên mật khẩu</a></h6>
                    <button type="submit" class="btn login">Đăng nhập</button>
                </form>
            </div>

            <div id="signup-form">
                <form action="{{URL('/add-user')}}" method="POST">
					{{csrf_field()}}
                    <input type="email" name="user_email" placeholder="Email" required/>
					<input type="text" name="user_name" placeholder="Tên" required/>
                    <input type="text" name="user_phone" placeholder="Số điện thoại" required/>
                    <input type="text" name="user_address" placeholder="Địa chỉ" required/>
                    <input type="password" name="user_password" placeholder="Mật khẩu" required/>
                    <input type="password" placeholder="Xác nhận mật khẩu" required/>
                    <button type="submit" class="btn signup">Đăng ký</button>
                </form>
            </div>

        </div>
    </div>
    <script>
        function toggleSignup() {
            document.getElementById("login-toggle").style.backgroundColor = "#fff";
            document.getElementById("login-toggle").style.color = "#222";
            document.getElementById("signup-toggle").style.backgroundColor = "#57b846";
            document.getElementById("signup-toggle").style.color = "#fff";
            document.getElementById("login-form").style.display = "none";
            document.getElementById("signup-form").style.display = "block";
        }

        function toggleLogin() {
            document.getElementById("login-toggle").style.backgroundColor = "#57B846";
            document.getElementById("login-toggle").style.color = "#fff";
            document.getElementById("signup-toggle").style.backgroundColor = "#fff";
            document.getElementById("signup-toggle").style.color = "#222";
            document.getElementById("signup-form").style.display = "none";
            document.getElementById("login-form").style.display = "block";
        }

    </script>

@include('footer')