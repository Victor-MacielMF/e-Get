<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" href="{{ URL::asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css') }}">
    <link href="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Progress Bar -->
    <script src="js/progressbar.min.js"></script>
    <!-- Parallax -->
    <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
</head>
<body>

    {{-- Navbar --}}
    <header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
            <div class="container" id="nav-container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/">
                        e-Get Marketplace
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbar-links">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" id="products-menu" href="/produtos">Produtos</span></a>
                        <a class="nav-item nav-link" id="services-menu" href="/servicos">Serviços</a>
                        <a class="nav-item nav-link" id="sell-menu" href="/escolha">Vender</a>
                        <a class="nav-item nav-link" id="pay-menu" href="">Carrinho</a>
                        <a class="nav-item nav-link" id="about-menu" href="/vender-produto">Sobre</a>
                    </div>
                </div>
                <div class="justify-contend-end">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link {{(request () -> is ('entrar') || ('login') ||('registrar'))? 'active': ''}}" id="navbar-button"><i class="bi bi-person-circle"></i> Login </a>
                    @else
                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item {{Request::is('meus-dados') ? 'active' : ''}}" href="/meus-dados">Meus dados</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Meus pedidos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Meus produtos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/meus-servicos">Meus serviços</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Lista de desejos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('clientes')}}">Clientes</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sair </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    {{-- Aqui é onde o contéudo é inserido --}}
    <main>
        @yield('content')
        <div id="preenchimento"></div>
    </main>




    <footer>
            <div id="copy-area">
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <p>Desenvolvido por <a href="https://github.com/Victor-MacielMF" target="_blank">Maciel</a> &copy; 2022</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </footer>

    <!-- Scripts do projeto -->
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ClienteRequest') !!}
</body>
</html>
