@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">社員管理</h4>
            {{-- Search --}}
            <div class="row mb-0">
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">search</i>
                            社員検索
                        </div>
                        <div class="collapsible-body">
                            <div class="row mb-0">
                                <form action="{{route('employees.search')}}" method="POST">
                                    @csrf()
                                    <div class="input-field col s12 m6 l5 xl6">
                                        <input type="text" name="search" id="search">
                                        <label for="search">社員検索</label>
                                        <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : ''}}</span>
                                    </div>
                                    <div class="input-field col s12 m6 l4 xl4">
                                        <select name="options" id="options">
                                            <option value="office">所属</option>
                                            <option value="last_name">名字</option>
                                            <option value="first_name">名前</option>
                                            <option value="address_1">住所</option>
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
            {{-- Show All Employee List as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row">
                        <h5 class="pl-15 grey-text text-darken-2">社員一覧</h5>
                        {{-- Table that shows Employee List --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-1">
                                <tr>
                                    <th>ID</th>
                                    <th>写真</th>
                                    <th>名前</th>
                                    <th>所属</th>
                                    <th>入社日</th>
                                    <th>詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any Status to render in view --}}
                                @if($employees->count())
                                    @foreach ($employees as $employee)
                                    <tr {{$employee->leave_date ? "style=text-decoration:line-through;color:red":''}}>
                                        <td>{{$employee->employee_id}}</td>
                                        <td>
                                        {{-- <img class="emp-img" src="{{asset('storage/epmloyee_images').$employee->picture}}"> --}}
                                        <img class="emp-img" src="{{$employee->picture ? asset('images/employee_images/'.$employee->picture) : asset('images/no_image.png')}}">
                                        {{-- <img class="emp-img" src="{{asset('images/no_image.png')}}"> --}}
                                        </td>
                                        <td>{{$employee->last_name}} {{$employee->first_name}}</td>
                                        <td>{{$employee->office}}</td>
                                        <td>{{$employee->join_date}}</td>
                                        <td>
                                            <a href="{{route('employees.show', $employee->employee_id)}}" class="btn btn-floating btn-small orange waves-effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- if there are no employees then show this message --}}
                                    <tr>
                                        <td colspan="6"><h6 class="grey-text text-darken-2 center">社員がいません！</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- Employee Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$employees->links('vendor.pagination.default',['paginator' => $employees])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to employees.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large gradient-45deg-red-pink gradient-shadow" href="{{route('employees.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection