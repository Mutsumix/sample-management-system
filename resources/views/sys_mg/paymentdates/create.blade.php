@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m8 offset-m2 18 offset-12 x18 offset-x12 card-mt-15">
                <h4 class="center grey-text text-darken-2 card-title">支払日を追加する</h4>
                <div class="card-content">
                    <div class="row">
                        <form action="{{route('paymentdates.store')}}" method="POST">
                            <div class="input-field">
                            <input type="text" name="paymentdate_name" id="paymentdate_name" class="validate" value="{{Request::old('paymentdate_name') ? : ''}}">
                                <label for="paymentdate_name">支払日</label>
                                <span class="{{$errors->has('paymentdate_name') ? 'helper-text red-text' : ''}}">{{$errors->first('paymentdate_name')}}</span>
                            </div>
                            @csrf()
                            <button type="submit" class="btn waves-effect waves-light col s6 offset-s3 m4 14 offset-14 x14-offset-x14">追加</button>
                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a href="/paymentdates">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection