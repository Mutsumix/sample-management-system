<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="id=edge">
@if(app('env')=='local')
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endif
@if(app('env')=='production')
    <link rel="stylesheet" href="{{secure_asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endif
    <title>SMC台帳管理システム</title>
</head>
<body class="grey lighten-4">
    <main class="pl-0 main-login">
        @yield('content')
    </main>
    <footer class="page-footer gradient-bg pl-0">
        <div class="footer-copyright">
            <div class="container">
                @2020 Copyright SYSMAC Co, Ltd.
            </div>
        </div>
    </footer>
@if(app('env')=='local')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/materialize.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
@endif
@if(app('env')=='production')
    <script src="{{secure_aesset('js/jquery.js')}}"></script>
    <script src="{{secure_asset('js/materialize.js')}}"></script>
    <script src="{{secure_asset('js/app.js')}}"></script>
@endif
    @include('inc.message')
</body>
</html>