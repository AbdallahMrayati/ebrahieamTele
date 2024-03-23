@extends('layouts.app')

@section('content')
    <div class="wrapper d-flex justify-content-center">
        <div class="login-box">
            <div class="login-logo">
                <a href=""><b>UBXv9</b></a>
            </div>

            <div class="card rounded">
                <div class="card-body rounded login-card-body">
                    <a href="#" class="brand-link">
                        <i class="brand-image fa fa-sign-in-alt text-dark" style="opacity: 1"></i>
                    </a>
                    <p class="login-box-msg">تسجيل الدخول</p>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-alt"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" id="pass" class="form-control"
                                placeholder="كلمة المرور" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <input type="hidden" name="login" value="1">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-warning btn-block">دخول</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                @if ($errors->has('username') || $errors->has('password'))
                                    <label class="badge badge-danger">
                                        {{ $errors->first('username') ?: $errors->first('password') }}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.body.className = "layout-top-nav layout-footer-fixed login-page";
    </script>
@endsection
