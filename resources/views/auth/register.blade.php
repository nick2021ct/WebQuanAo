<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng kí</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/images/logos/favicon.png') }}" />

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/styleLogin.css') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/7d23d1769b.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Đăng kí</h2>
                        <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Tên đăng nhập" value="{{ old('username') }}"/>
                            </div>
                            @error('username')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Mật khẩu"/>
                            </div>
                            @error('password')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="repeat_password" id="re_pass" placeholder="Xác nhận mật khẩu"/>
                            </div>
                            @error('repeat_password')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}"/>
                            </div>
                            @error('email')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="name"><i class="fa-solid fa-user"></i></label>
                                <input type="text" name="fullname" id="name" placeholder="Họ và tên" value="{{ old('fullname') }}"/>
                            </div>
                            @error('fullname')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="name"><i class="fa-solid fa-location-dot"></i></label>
                                <input type="text" name="address" id="name" placeholder="Địa chỉ" value="{{ old('address') }}"/>
                            </div>
                            @error('address')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="phone"><i class="fa-solid fa-phone"></i></label>
                                <input type="text" name="phone" id="phone" placeholder="Số điện thoại" value="{{ old('phone') }}"/>
                            </div>
                            @error('phone')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            {{-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" checked/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> --}}
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('storage/img/signup-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('login') }}" class="signup-image-link">Bạn đã có tài khoản</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>