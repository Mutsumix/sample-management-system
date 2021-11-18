<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="id=edge">
@if(app('env')=='local')
    <link rel="stylesheet" href="{{asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/timeline.css')}}">
@endif
@if(app('env')=='production')
    <link rel="stylesheet" href="{{secure_asset('css/materialize.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/timeline.css')}}">
@endif
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>SMC台帳管理システム</title>
</head>
<body class="grey lighten-4">
    <!-- 全てのViewで使われるデフォルトのレイアウトページです -->
    <!-- ログインページはナビゲーションバーを表示しないので例外 -->

    <!-- ナビゲーションバーのインクルード-->


@if(Auth::check())
    @include('inc.navbar')
    <main>
        @yield('content')
    </main>
@else
    <main class="pl-0 main-login">
        @yield('content')
    </main>
@endif
    
    <!-- フッターのインクルード-->
    @include('inc.footer')
@if(app('env')=='local')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/materialize.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/ajaxzip3.js')}}" charset="UTF-8"></script>
    <script src="{{asset('js/moment.js')}}"></script>
@endif
@if(app('env')=='production')
    <script src="{{secure_asset('js/jquery.js')}}"></script>
    <script src="{{secure_asset('js/materialize.js')}}"></script>
    <script src="{{secure_asset('js/app.js')}}"></script>
    <script src="{{secure_asset('js/ajaxzip3.js')}}" charset="UTF-8"></script>
    <script src="{{secure_asset('js/moment.js')}}"></script>
@endif
    {{-- <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> --}}
    @include('inc.message')
</body>
</html>