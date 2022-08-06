<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="rocsel.com">
        <meta name="keyword" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>لوحة التحكم</title>

        <link href="{{asset('admin/css/basic.css')}}" rel="stylesheet">
        <link href="{{asset('admin/css/style.css?v=1.0.1')}}" rel="stylesheet">
        <link href="{{asset('admin/css/all.css')}}" rel="stylesheet">
        <meta name="robots" content="noindex">
    </head>
    <body class="c-app flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <h1 class="text-center mb-4 ">لوحة التحكم</h1>
                    <form action="<?= RC_url("logging") ?>" method="post">
                        @csrf
                        <div class="card-group">
                            <div class="card p-4">
                                <div class="card-body">
                                    <!--<div class="alert alert-danger">sadd</div>-->
                                    <?= $content ?? "" ?>
                                    <h3 class="mb-4">تسجيل دخول</h3>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="text" name="email" placeholder="البريد الإلكتروني">
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="password" name="password" placeholder="كلمة المرور">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit" name="submit" value="1">تسجيل دخول</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <!--<button cl  ass="btn btn-link px-0" type="button">Forgot password?</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>