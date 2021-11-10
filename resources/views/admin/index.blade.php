@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">管理者</h4>
            {{-- Show All Admins List as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row mb-0">
                        <h5 class="pl-15 grey-text text-darken-2">管理者一覧</h5>
                        {{-- Table that shows Admins List --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-1">
                                <tr>
                                    <th>ID</th>
                                    <th>写真</th>
                                    <th>氏名</th>
                                    <th>ユーザー名</th>
                                    <th>メールアドレス</th>
                                    <th>オプション</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($admins->count())
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{$admin->admin_id}}</td>
                                        <td>
                                            <img class="emp-img" src="{{$admin->picture ? asset('images/admin_images/'.$admin->picture) : asset('images/no_image.png')}}">
                                        </td>
                                        <td>{{$admin->last_name}} {{$admin->first_name}}</td>
                                        <td>{{$admin->username}}</td>
                                        <td>{{$admin->mail_address}}</td>
                                        <td>
                                            <div class="row mb-0">
                                                <div class="col">
                                                    <a href="{{route('admins.edit', $admin->admin_id)}}" class="btn btn-floating btn-small waves-effect waves-light orange"><i class="material-icons">mode_edit</i></a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{route('admins.destroy', $admin->admin_id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf()
                                                        <button type="submit" class="btn btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    {{-- if there are no admins then show this message --}}
                                        <tr>
                                            <td colspan="5"><h6 class="grey-text text-darken-2 center">管理者がいません！</h6></td>
                                        </tr>
                                    @endif
                                    {{-- if we are searching then show this link --}}
                                    @if(isset($search))
                                        <tr>
                                            <td colspan="4">
                                                <a href="/admins" class="right">全て表示する</a>
                                            </td> 
                                        </tr>
                                    @endif
                            </tbody>
                        </table>
                        {{-- Admins Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$admins->links('vendor.pagination.default',['paginator' => $admins])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to clitens.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light  gradient-45deg-red-pink gradient-shadow" href="{{route('admins.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection