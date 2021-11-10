@extends('layouts.app')
@section('content')
    <br>
    <div>
        <div class="row white-text">
            <a href="/employees" class="white-text">
                <div class="mx-20 card-panel gradient-45deg-light-blue-cyan lighten-1 col s8 offset-s2 m4 offset-m2 l4 offset-l2 xl2 offset-xl1 ml-14">
                
                    <div class="row">
                        <div class="col s7 xl7">
                            <i class="material-icons medium white-text pt-5">supervisor_account</i>
                            <h6 class="no-padding txt-md">社員管理</h6>
                        </div>
                        <div class="col s5 xl5">
                            <p class="no-padding center mt txt-sm">{{$t_employees}} 人</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/clients" class="white-text">
                <div class="mx-20 card-panel gradient-45deg-red-pink lighten-1 col s8 offset-s2 m4 l4 xl2">
                    <div class="row">
                        <div class="col s7 xl7">
                            <i class="material-icons medium white-text pt-5">apartment</i>
                            <h6 class="no-padding txt-md">取引先管理</h6>
                        </div>
                        <div class="col s5 xl5">
                            <p class="no-padding center mt txt-sm">{{$t_clients}} 社</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/workplaces" class="white-text">
                <div class="mx-20 card-panel gradient-45deg-amber-amber lighten-1 col s8 offset-s2 m4 offset-m2 l4 offset-l2 xl2">
                    <div class="row">
                        <div class="col s7 xl7">
                            <i class="material-icons medium white-text pt-5">work</i>
                            <h6 class="no-padding txt-md">派遣先管理</h6>
                        </div>
                        <div class="col s5 xl5">
                            <p class="no-padding center mt txt-sm">{{$t_workplaces}} 社</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="/admins" class="white-text">
                <div class="mx-20 card-panel gradient-45deg-green-teal accent-4 col s8 offset-s2 m4 l4 xl2">
                    <div class="row">
                        <div class="col s7 xl7">
                            <i class="material-icons medium white-text pt-5">person</i>
                            <h6 class="no-padding txt-md">管理者</h6>
                        </div>
                        <div class="col s5 xl5">
                            <p class="no-padding center mt txt-sm">{{$t_admins}} 人</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row white-text">
            <a href="https://invoice.sysmac.co.jp/" target="_blank" rel="noopener noreferrer" class="white-text">
                <div class="mx-20 card-panel gradient-45deg-light-blue-cyan lighten-1 col s8 offset-s2 m4 offset-m2 l4 offset-l2 xl2 offset-xl1 ml-14">
                
                    <div class="row">
                        <div class="col s7 xl7">
                            <i class="material-icons medium white-text pt-5">description</i>
                            <h6 class="no-padding txt-md">見積・請求書管理</h6>
                        </div>
                        <div class="col s5 xl5">
                            <p class="no-padding center mt txt-sm">外部リンク</p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="https://kintai.sysmac.co.jp/" target="_blank" rel="noopener noreferrer" class="white-text">
                <div class="mx-20 card-panel gradient-45deg-red-pink lighten-1 col s8 offset-s2 m4 l4 xl2">
                    <div class="row">
                        <div class="col s7 xl7">
                            <i class="material-icons medium white-text pt-5">beach_access</i>
                            <h6 class="no-padding txt-md">有休管理</h6>
                        </div>
                        <div class="col s5 xl5">
                            <p class="no-padding center mt txt-sm">外部リンク</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    {{-- <div class="container-fluid">
        <div class="card-panel">
            <canvas id="employee"></canvas>
        </div>
    </div> --}}
    <br>
    {{-- include the chart.js with javascript using canvas --}}

@endsection