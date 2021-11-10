@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                    <div>
                        <h4 class="center grey-text text-darken-2 card-title">管理者情報を追加する</h4>
                    </div>
                    <hr>
                    <div class="card-content">
                        <form action="{{route('admins.store')}}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">person_outline</i>
                                    <input type="text" name="last_name" id="last_name" value="{{Request::old('last_name') ? : ''}}">
                                    <label for="last_name">名字</label>
                                    <span class="{{$errors->has('last_name') ? 'helper-text red-text' : ''}}">{{$errors->first('last_name')}}</span>
                                </div>

                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">person_outline</i>
                                    <input type="text" name="first_name" id="first_name" value="{{Request::old('first_name') ? : ''}}">
                                    <label for="first_name">名前</label>
                                    <span class="{{$errors->has('first_name') ? 'helper-text red-text' : ''}}">{{$errors->first('first_name')}}</span>
                                </div>

                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" name="username" id="username" value="{{Request::old('username') ? : ''}}">
                                    <label for="username">ユーザー名</label>
                                    <span class="{{$errors->has('username') ? 'helper-text red-text' : ''}}">{{$errors->first('username')}}</span>
                                </div>

                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">lock</i>
                                    <input type="password" name="password" id="password" value="{{Request::old('password') ? : ''}}">
                                    <label for="password">パスワード</label>
                                    <span class="{{$errors->has('password') ? 'helper-text red-text' : ''}}">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                                </div>
                                
                                <div class="input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" name="mail_address" id="mail_address" value="{{Request::old('mail_address') ? : ''}}">
                                    <label for="mail_address">メールアドレス</label>
                                    <span class="{{$errors->has('mail_address') ? 'helper-text red-text' : ''}}">{{$errors->first('mail_address')}}</span>
                                </div>

                                <div class="file-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                    <div class="btn">
                                        <span>写真</span>
                                        <input type="file" name="picture">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input type="text" class="file-path validate" value="{{old('picture') ? : ''}}">
                                        <span class="{{$errors->has('picture') ? 'helpertext red-text' : '' }}">{{$errors->has('picture') ? $errors->first('picture') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                                
                            @csrf()
                            <div class="row">
                                <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 l4 offset-l4 xl4 offset-xl4">追加</button>
                            </div>
                        </form>
                    </div>
                <div class="card-action">
                    <a href="/admins">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection