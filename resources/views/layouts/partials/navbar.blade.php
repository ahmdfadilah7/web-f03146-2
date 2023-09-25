<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand font-new-rocker text-uppercase" href="{{ route('home') }}">{{ $setting->nama_website }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item text-uppercase">
                    <a class="nav-link font-nerko-one @if(Request::segment(1)=='') active @endif" aria-current="page" href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                @if(Auth::guard('pengguna')->user() <> '')
                    <li class="nav-item text-uppercase">
                        <a class="nav-link font-nerko-one @if(Request::segment(1)=='story' && Request::segment(2)=='') active @endif" aria-current="page" href="{{ route('story') }}">Story</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a class="nav-link font-nerko-one @if(Request::segment(1)=='story' && Request::segment(2)=='mystory') active @endif" aria-current="page" href="{{ route('story.mystory') }}">My Story</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a class="nav-link font-nerko-one @if(Request::segment(1)=='notif') active @endif" aria-current="page" href="{{ route('notif') }}">Notifications</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a class="nav-link font-nerko-one" aria-current="page" href="{{ route('logout', Auth::guard('pengguna')->user()->role) }}">Logout</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
