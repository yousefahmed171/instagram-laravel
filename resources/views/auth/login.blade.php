<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/img/favicons/logo.png">
    <link href="./dist/fonts/fonts.css" rel="stylesheet">

    <title>تسجيل الدخول إلى انستغرام حسوب</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/album.css') }}" rel="stylesheet">
</head>

<body class="text-center">
<div class="row justify-content-md-center">
    <div class="col-md-6">
        <form class="form-signin"  style="direction:  rtl;" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <img class="mb-4" src="./assets/img/Instagram.png" alt="" style="width: 30%" >
            <h1 class="h3 mb-3 font-weight-normal">تسجيل الدخول</h1>
            <label for="inputEmail" class="sr-only">البريد الالكتروني</label>
            <div class="form-group ">
                <label for="email" class="col-md-4 control-label">البريد الالكتروني</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error ('email') is-invalid @enderror" name="email"
                           value="{{
                     old
                    ('email')
                    }}" required autofocus>

                    @error('email')
                        <span class="help-block">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-4 control-label">كلمة المرور</label>
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control @error ('password') is-invalid @enderror"
                           name="password" required>

                    @error ('password')
                        <span class="help-block">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
                        </label>
                    </div>
                    <label>
                        <a href="{{ route('register') }}" >ليس لديك حساب! أنشئ حساباً جديداً</a>
                    </label>
                </div>
            </div>
            <!-- <input type="email" id="inputEmail" class="form-control" placeholder="البريد الالكتروني" required autofocus>
            <label for="inputPassword" class="sr-only">رمز المرور</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="رمز المرور" required> -->
            <!--       <div class="checkbox mb-3">
                    <label>
                      <input type="checkbox" value="remember-me"> تذكرني
                    </label>
                    <label>
                      <a href="#" >ليس لديك حساب! أنشئ حساباً جديداً</a>
                    </label>
                  </div> -->
            <button class="btn btn-lg btn-primary btn-block" type="submit">تسجيل الدخول</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
        </form>
    </div>
</div>
</body>
</html>
