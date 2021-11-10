@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m8 offset-m2 18 offset-12 x18 offset-x12 card-mt-15">
                <h4 class="center grey-text text-darken-2 card-title">締め日を更新する</h4>
                <div class="card-content">
                    <div class="row">
                        <form action="{{route('closingdates.update', $closingdate->id)}}" method="POST">
                            <div class="input-field">
                            <input type="text" name="closingdate_name" id="closingdate_name" value="{{Request::old('closingdate_name') ? : $closingdate->closingdate_name}}">
                                <label for="closingdate_name">締め日</label>
                                <span class="{{$errors->has('closingdate_name') ? 'helper-text red-text' : ''}}">{{$errors->first('closingdate_name')}}</span>
                            </div>
                            @method('PUT')
                            @csrf()
                            <button type="submit" class="btn waves-effect waves-light col s6 offset-s3 m4 14 offset-14 x14-offset-x14">更新</button>
                        </form>
                    </div>
                    <div class="card-action">
                        <a href="/closingdates">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection