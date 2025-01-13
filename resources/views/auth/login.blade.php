<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
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
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('storage/img/signin-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('register') }}" class="signup-image-link">Tạo tài khoản</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title m-0 pb-3">Chào mừng bạn</h2>
                        @if ($message = Session::get('success'))
                        <h5 class="text-success pb-4">{{ $message }}</h5>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="your_name" placeholder="Tên đăng nhập" value="{{ old('username') }}"/>
                            </div>
                            @error('username')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Mật khẩu"/>
                            </div>
                            @error('password')
                            <p class="text-danger" style="margin-top:-20px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group" style="display:flex; justify-content: space-between;">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                                <a href="{{ route('forgotPassword') }}" class="signup-image-link">Quên mật khẩu</a>
                            </div>
                            <div class="row">
                                <div class="form-group form-button col">
                                    <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập"/>
                                </div>
                                <div class="form-group form-button col" style="padding-top: 20px">
                                    <a href="{{ route('redirectToGoogle') }}" class="btn btn-danger w-100" >
                                        <i class="fa fa-google"></i> Đăng nhập bằng Gmail
                                    </a>
                                </div>
                            </div>
                            
                        </form>
                        
                        
                    </div>
                   
                    
                </div>
            </div>
        </section>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>