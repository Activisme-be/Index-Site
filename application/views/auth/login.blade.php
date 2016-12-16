<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title> Activisme.be | {{ $title }} </title>

        <link rel="stylesheet" href="{{ base_url('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ base_url('assets/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ base_url('assets/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ base_url('assets/css/AdminLTE.css') }}">
        <link rel="stylesheet" href="{{ base_url('assets/css/square/blue.css') }}">

        {{-- HTML5 Shim and Responsd.js IE8 support of HTML5 elements and media queries. --}}
        {{-- WARNING: Respond.js doesn't work if you wiew the file via file:// --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ base_url() }}"><b>Activisme</b>BE</a>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg">Login om een sessie te starten.</p>

                <form action="" mathod="POST">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Herriner mij
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                Login
                            </button>
                        </div>
                    </div>
                </form>

                <a href="#">Wachtwoord vergeten?</a>
            </div>
        </div>

        {{-- JavaScript --}}
        <script src="{{ base_url('assets/js/jquery.js') }}"></script>
        <script src="{{ base_url('assets/js/bootstrap.js') }}"></script>
        <script src="{{ base_url('assets/js/icheck.js') }}"></script>

        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>