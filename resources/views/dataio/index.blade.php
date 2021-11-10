@extends('layouts.app')
@section('content')
    <br>
    <div>
        <div class="row white-text">
            <form action="{{route('dataio.outputclient')}}" method="POST">
                @csrf()
                <button type="submit" class="mx-20 offset-xl1 col s8 offset-s2 offset-m2 m4 offset-l2 l4 offset-xl1 xl2 download_button ">
                    <div class="row">
                                <i class="material-icons medium white-text pt-5">supervisor_account</i>
                                <h6 class="no-padding txt-md">社員台帳出力</h6>
                    </div>
                </button>
            </a>
            </form>
        </div>
    </div>
    <br>

@endsection