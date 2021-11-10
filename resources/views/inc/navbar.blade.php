<header>
    <nav class="gradient-bg">
        <div class="container">
            <div class="nav-wrapper">
            <a href="{{route('dashboard')}}" class="brand-logo hide-on-med-and-down">SMC台帳管理システム</a>
            <a href="{{route('dashboard')}}" class="brand-logo show-on-medium-and-down hide-on-med-and-up">SMCMS</a>
                <ul>
                    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                </ul>
                <ul class="right">
                    <a href="{{route('auth.logout')}}">ログアウト</a>
                    {{-- <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1"> --}}
                            {{-- {{Auth::user()->last_name}} {{Auth::user()->first_name}} --}}
                            {{-- <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
</header>
{{-- Dropdown Structure --}}
<ul id="dropdown1" class="dropdown-content">
<li><a href="{{route('auth.detail')}}">プロフィール</a></li>
<li class="divider"></li>
<li><a href="{{route('auth.logout')}}">ログアウト</a></li>
</ul>

@include('inc.sidenav')