@extends('layouts.app')
@guest
@section('content')
<section>
    <div class="container row">
        <div class="col m8 offset-m1 l6 offset-l3 xl6 offset-xl3 s10 offset-s1 card card-login z-depth-4">
            <div class="card-title card-title-login gradient-bg lighten-2 white-text">
                <h5 class="center flow-text">SMC台帳管理システム</h5>
            </div>
            <div class="card-content">
            <form action="{{route('auth.authenticate')}}" method='POST'>
                <div class="input-field">
                    <i class="material-icons prefix">mail</i>
                    <input type="email" name="mail_address" id="mail_address" class="validate" value="{{old('mail_address') ? : ''}}">
                    <label for="mail_address">メールアドレス</label>
                    <span class="{{$errors->has('mail_address') ? 'helper-text red-text' : '' }}">{{$errors->has('mail_address') ? $errors->first('mail_address') : ''}}</span>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password" id="password">
                    <label for="password">パスワード</label>
                    <span class="{{$errors->has('password') ? 'helper-text red-text' : '' }}">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                </div>
                @csrf()
                <p>
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" />
                        <span>ログイン情報を記憶する</span>
                    </label>
                </p>
                {{-- <a href="#" class="right">パスワードを忘れた</a> --}}
                <br>
                <div class="card-action">
                    <button class="btn col s12 m12 l12 xl12 waves-effect waves-light gradient-bg" type="submit" name="submit">ログイン</button>
                </div>
                <br>
            </form>
            </div>
        </div>
    </div>
</section>
@endsection
@endguest