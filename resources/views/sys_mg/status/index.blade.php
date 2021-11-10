@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">社員区分管理</h4>
        <div class="row">
            {{-- show all Status list as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row mb-0">
                        <h5 class="pl-15 grey-text text-darken-2">社員区分一覧</h5>
                        {{-- Table that shows Status list --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-2">
                                <tr>
                                    <th>社員区分</th>
                                    <th>作成日</th>
                                    <th>更新日</th>
                                    <th>オプション</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any Status to render in view --}}
                                @if($status->count())
                                    @foreach ($status as $state)
                                    <tr>
                                        <td>{{$state->status_name}}</td>
                                        <td>{{date('Y-m-d',strtotime($state->created_at))}}</td>
                                        <td>{{date('Y-m-d',strtotime($state->updated_at))}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    {{--  --}}
                                                <a href="{{route('status.edit', $state->id)}}" class="btn btn-floating btn-small waves-effect waves-light orange"><i class="material-icons">mode_edit</i></a>
                                            </div>
                                            <div class="col">
                                                {{--  --}}
                                            <form action="{{route('status.destroy', $state->id)}}" method="POST">
                                                {{--  --}}
                                                @method('DELETE')
                                                {{--  --}}
                                                @csrf
                                                <button type="submit" class="btn btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></button>
                                            </form>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- if there are no status the show this message --}}
                                    <tr>
                                        <td colspan="5"><h6 class="grey-text text-darken-2 center">社員区分がありません！</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- Status Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$status->links('vendor.pagination.default',['paginator' => $status])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
        </div>
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to status.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light gradient-45deg-red-pink gradient-shadow" href="{{route('status.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection