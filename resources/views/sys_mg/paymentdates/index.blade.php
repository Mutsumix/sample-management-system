@extends('layouts.app')
@section('content')
    <div class="container">
        <h4 class="grey-text text-darken-2 center">支払日管理</h4>
        <div class="row">
            {{-- show all PaymentDates list as a card --}}
            <div class="card col s12 m12 l12 xl12">
                <div class="card-content">
                    <div class="row mb-0">
                        <h5 class="pl-15 grey-text text-darken-2">支払日一覧</h5>
                        {{-- Table that shows PaymentDates list --}}
                        <table class="responsive-table col s12 m12 l12 xl12">
                            <thead class="grey-text text-darken-2">
                                <tr>
                                    <th>支払日</th>
                                    <th>作成日</th>
                                    <th>更新日</th>
                                    <th>オプション</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Check if there are any PaymentDates to render in view --}}
                                @if($paymentdates->count())
                                    @foreach ($paymentdates as $paymentdate)
                                    <tr>
                                        <td>{{$paymentdate->paymentdate_name}}</td>
                                        <td>{{date('Y-m-d',strtotime($paymentdate->created_at))}}</td>
                                        <td>{{date('Y-m-d',strtotime($paymentdate->updated_at))}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                <a href="{{route('paymentdates.edit', $paymentdate->id)}}" class="btn btn-floating btn-small orange"><i class="material-icons">mode_edit</i></a>
                                            </div>
                                            <div class="col">
                                            <form action="{{route('paymentdates.destroy', $paymentdate->id)}}" method="POST">
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
                                    {{-- if there are no PaymentDates the show this message --}}
                                    <tr>
                                        <td colspan="5"><h6 class="grey-text text-darken-2 center">支払日がありません！</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{-- PaymentDates Table End --}}
                    </div>
                    {{-- Show Pagination Links --}}
                    <div class="center">
                        {{$paymentdates->links('vendor.pagination.default',['paginator' => $paymentdates])}}
                    </div>
                </div>
            </div>
            {{-- Card END --}}
        </div>
    </div>

{{-- This is the button that is located at the right buttom, that navigated us to paymentdates.create View --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large gradient-45deg-red-pink gradient-shadow" href="{{route('paymentdates.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div>
@endsection