<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>

        {{-- Haburguesa --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto ">
				<form method="GET" action="{{route('products.search')}}" class="d-flex">
					<input type="search" name="search" class="form-control" placeholder="Buscar producto">
					<button type="submit" class="btn btn-primary mx-2"><i class="fa-solid fa-magnifying-glass"></i></button>
				</form>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Inicio de sesión
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registro</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

							@role('admin')
                            {{-- users --}}
                            <a class="dropdown-item" href="{{route('users.index')}}">
                                Usuarios
                            </a>
							@endrole

							@role('admin')
                            {{-- Products --}}
                            <a class="dropdown-item" href="{{route('products.index')}}">
                                Productos
                            </a>
							@endrole

							@role('admin')
								{{-- categories --}}
								<a class="dropdown-item" href="{{route('categories.index')}}">
									Categorias
								</a>
							@endrole

							@role('user')
								{{-- cart --}}
								<a class="dropdown-item" href="{{route('carts.index')}}">
									Ver carrito
								</a>
							@endrole

                            {{-- Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
