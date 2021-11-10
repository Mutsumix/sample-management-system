@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">取引先管理</h4>
            {{-- Search --}}
            <div class="row mb-0">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">search</i>
                            取引先検索
                        </div>
                        <div class="collapsible-body">
                            <div class="row mb-0">
                                <form action="{{route('clients.search')}}" method="POST">
                                    @csrf()
                                    <div class="input-field col s12 m6 l5 xl6">
                                        <input type="text" name="search" id="search">
                                        <label for="search">取引先検索</label>
                                        <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : ''}}</span>
                                    </div>
                                    <div class="input-field col s12 m6 l4 xl4">
                                        <select name="options" id="options">
                                            <option value="client_name">取引先名</option>
                                            <option value="address_1">住所</option>
                                            <option value="remark">備考</option>
                                        </select>
                                        <label for="options">検索項目：</label>
                                    </div>
                                    <br>
                                    <div class="col 12">
                                        <button type="submit" class="btn waves-effect waves-light">検索</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            {{-- Search End --}}
            {{-- Show All Client List as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row">
                        <h5 class="pl-15 grey-text text-darken-2">取引先一覧</h5>
                        {{-- Table that shows Client List --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-1">
                                <tr>
                                    <th>取引先CD</th>
                                    <th>取引先名</th>
                                    <th>本社/支社</th>
                                    {{-- <th>登録日</th> --}}
                                    <th>最終更新日</th>
                                    <th>詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any Status to render in view --}}
                                @if($clients->count())
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{sprintf('%04d', $client->client_id)}}</td>
                                        <td>{{$client->client_name}}</td>
                                        <td>{{$client->office}}</td>
                                        {{-- <td>{{$client->created_at}}</td> --}}
                                        <td>{{date('Y-m-d',strtotime($client->updated_at))}}</td>
                                        <td>
                                            <a href="{{route('clients.show', $client->client_id)}}" class="btn btn-floating btn-small orange waves-effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                            {{-- <a href="{{route('clients.show')}}" class="btn btn-floating btn-small orange waves-effect waves-light teal lighten-2"><i class="material-icons">list</i></a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- if there are no clients then show this message --}}
                                    <tr>
                                        <td colspan="5"><h6 class="grey-text text-darken-2 center">取引先がありません！</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- Client Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$clients->links('vendor.pagination.default',['paginator' => $clients])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to clitens.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large gradient-45deg-red-pink gradient-shadow" href="{{route('clients.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection