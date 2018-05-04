<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{--- Dashboard--}}
        {{--- Charts--}}
        {{--- Tables--}}
        {{--- Components--}}
        {{--- - Navbar--}}
        {{--- - Cards--}}
        {{--- Map--}}

        {{--супер админ - имеет доступ на все страницы из меню--}}
        {{--админ - имеет доступ на dasboards, charts, components--}}
        {{--менеджер - имеет доступ на tables--}}
        {{--пользователи - имеет доступ на components.--}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('dashboard.index')}}">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('charts.index')}}">Charts</a>
                        </li>
                    @endif
                    @if(Auth::user()->role == 'manager' || Auth::user()->role == 'super_admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('tables.index')}}">Tables</a>
                        </li>
                    @endif
                    @if(Auth::user()->role == 'user' || Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cards.index')}}">Cards</a>
                        </li>
                    @endif
                <li class="nav-item">
                    <a class="nav-link disabled" href="{{route('map.index')}}">Map</a>
                </li>
                @else

                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else

                    @if(Auth::user()->url_avatar == null)
                        <img src="{{asset('/img/avatars/default_avatar.jpg')}}" style="width: 32px; height: 32px; background: red; margin: auto 0">
                    @else
                        <img src="{{Auth::user()->url_avatar}}">
                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>