@if(Auth::user()->mail_address !=='unlock@sysmac')
<ul id="slide-out" class="sidenav sidenav-fixed grey lighten-4 side-bg">
    <li>
        <div class="user-view">
            <div class="background">
            </div>
        {{-- Get picture of authenticated user --}}
        <a href="{{route('auth.detail')}}"><img class="circle" src="{{Auth::user()->picture ? asset('images/admin_images/'.Auth::user()->picture) : asset('images/no_image.png')}}"></a>
        {{-- Get last and first name authenticated user --}}
        <a href="{{route('auth.detail')}}"><span class="white-text name">{{Auth::user()->last_name}} {{Auth::user()->first_name}}</span></a>
        {{-- Get email of authenticated user --}}
        <a href="{{route('auth.detail')}}"><span class="white-text email">{{Auth::user()->mail_address}}</span></a>
        </div>
    </li>

    <li>
        <a class="waves-effect waves-red" href="/dashboard"><i class="material-icons">dashboard</i>トップページ</a>
    </li>
    <li>
        <a class="waves-effect waves-yellow" href="/employees"><i class="material-icons">supervisor_account</i>社員管理</a>
    </li>
    <li>
        <a class="waves-effect waves-orange" href="/clients"><i class="material-icons">apartment</i>取引先管理</a>
    </li>
    <li>
        <a class="waves-effect waves-green" href="/workplaces"><i class="material-icons">work</i>派遣先管理</a>
    <li>
        <a class="waves-effect waves-teal" href="/dataio"><i class="material-icons">grid_on</i>Excel出力</a>
    </li>
    <li>
        <a class="waves-effect waves-purple" href="/admins"><i class="material-icons">account_circle</i>管理者</a>
    </li>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header"><i class="material-icons pl-15">settings</i><span class="pl-15">管理者定義項目</span></a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="/status" class="waves-effect waves-grey">
                                <i class="material-icons">person_add</i>
                                社員区分
                            </a>
                        </li>
                        <li>
                            <a href="/categories" class="waves-effect waves-grey">
                                <i class="material-icons">business</i>
                                事業区分
                            </a>
                        </li>
                        <li>
                            <a href="/closingdates" class="waves-effect waves-grey">
                                <i class="material-icons">skip_next</i>
                                締め日
                            </a>
                        </li>
                        <li>
                            <a href="/paymentdates" class="waves-effect waves-grey">
                                <i class="material-icons">attach_money</i>
                                支払日
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    </ul>
@endif