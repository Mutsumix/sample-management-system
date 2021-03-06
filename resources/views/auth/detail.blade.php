@extends('layouts.app')
@section('content')
    <div class="container">
            <div class="card-panel grey-text text-darken-2 mt-20">
                <h4 class="grey-text text-darken-1 center">プロフィール</h4>
                    <div class="row">
                        <div class="row collection mt-20">
                            {{-- Show this image on small devices --}}
                            <div class="hide-on-med-only hide-on-large-only row">
                                <div class="col s8 offset-s2 mt-20">
                                    <img src="{{Auth::user()->picture ? asset('images/admin_images/'.Auth::user()->picture) : asset('images/no_image.png')}}" class="p5 card-panel emp-img-big">
                                </div>
                            </div>
                            <div class="col m8 l8 xl8">
                            <h5 class="pl-15 mt-20">{{Auth::user()->last_name}} {{Auth::user()->first_name}}</h5>
                            <p class="pl-15 mt-20"><i class="material-icons left">person</i>{{Auth::user()->username}}</p>
                            <p class="pl-15 mt-20"><i class="material-icons left">email</i>{{Auth::user()->mail_address}}</p>
                            </div>
                        </div>
                        {{-- Hide this image on small devices --}}
                        <div class="hide-on-small-only col m4 l4 x13">
                            <img src="{{ Auth::user()->picture ? asset('images/admin_images/'.Auth::user()->picture) : asset('images/no_image.png')}}" class="p5 card-panel emp-img-big">
                        </div>
                    </div>
                    <a class="btn orange col s8 offset-s2 m6 offset-m3 l4 xl4 offset-xl4" href="{{route('admins.edit', Auth::user()->admin_id)}}">更新</a>
            </div>
    </div>
@endsection