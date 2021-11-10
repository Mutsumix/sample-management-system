@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">派遣先管理</h4>
            {{-- Search --}}
            <div class="row mb-0">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">search</i>
                            派遣先検索
                        </div>
                        <div class="collapsible-body">
                            <div class="row mb-0">
                                <form action="{{route('workplaces.search')}}" method="POST">
                                    @csrf()
                                    <div class="input-field col s12 m6 l5 xl6">
                                        <input type="text" name="search" id="search">
                                        <label for="search">派遣先検索</label>
                                        <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : ''}}</span>
                                    </div>
                                    <div class="input-field col s12 m6 l4 xl4">
                                        <select name="options" id="options">
                                            <option value="employee_name">社員</option>
                                            <option value="workplace">派遣先</option>
                                            <option value="workplace">契約先</option>
                                            <option value="amount">金額</option>
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
            {{-- Show All Workplace List as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row">
                        <h5 class="pl-15 grey-text text-darken-2">派遣先一覧</h5>
                        {{-- Table that shows Workplace List --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-1">
                                <tr>
                                    <th>社員</th>
                                    <th>契約先</th>
                                    <th>契約開始日</th>
                                    <th>契約終了日</th>
                                    <th>詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any Status to render in view --}}
                                @if($workplaces->count())
                                    @foreach ($workplaces as $workplace)
                                    <tr>
                                        <td>
                                            {{optional($workplace->wpEmployee)->last_name}}
                                            {{optional($workplace->wpEmployee)->first_name}}
                                        </td>
                                        <td>{{optional($workplace->wpClient)->client_name}}</td>
                                        <td>{{date('Y-m-d',strtotime($workplace->start_date))}}</td>
                                        <td>{{date('Y-m-d',strtotime($workplace->end_date))}}</td>
                                        <td>
                                            <a href="{{route('workplaces.show', $workplace->workplace_id)}}" class="btn btn-floating btn-small orange waves-effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- if there are no workplaces then show this message --}}
                                    <tr>
                                        <td colspan="5"><h6 class="grey-text text-darken-2 center">派遣先がありません！</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- WorkPlace Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$workplaces->links('vendor.pagination.default',['paginator' => $workplaces])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to workplaces.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large gradient-45deg-red-pink gradient-shadow" href="{{route('workplaces.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection