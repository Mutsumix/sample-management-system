@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">締め日管理</h4>
        <div class="row">
            {{-- show all ClosingDates list as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row mb-0">
                        <h5 class="pl-15 grey-text text-darken-2">締め日一覧</h5>
                        {{-- Table that shows ClosingDates list --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-2">
                                <tr>
                                    <th>締め日</th>
                                    <th>作成日</th>
                                    <th>更新日</th>
                                    <th>オプション</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any ClosingDates to render in view --}}
                                @if($closingdates->count())
                                    @foreach ($closingdates as $closingdate)
                                    <tr>
                                        <td>{{$closingdate->closingdate_name}}</td>
                                        <td>{{date('Y-m-d',strtotime($closingdate->created_at))}}</td>
                                        <td>{{date('Y-m-d',strtotime($closingdate->updated_at))}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                <a href="{{route('closingdates.edit', $closingdate->id)}}" class="btn btn-floating btn-small orange"><i class="material-icons">mode_edit</i></a>
                                            </div>
                                            <div class="col">
                                            <form action="{{route('closingdates.destroy', $closingdate->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-floating btn-small red"><i class="material-icons">delete</i></button>
                                            </form>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- if there are no ClosingDates the show this message --}}
                                    <tr>
                                        <td colspan="5"><h6 class="grey-text text-darken-2 center">締め日がありません！</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- ClosingDates Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$closingdates->links('vendor.pagination.default',['paginator' => $closingdates])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
        </div>
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to closingdates.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large gradient-45deg-red-pink gradient-shadow" href="{{route('closingdates.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection