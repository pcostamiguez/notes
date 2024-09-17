<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('css/bootstrap.min.css')
    @vite('css/fontawesome.min.css')
    @vite('css/app.css')
    @vite('js/app.js')
    @vite('js/bootstrap.bundle.min.js')
    @vite('js/fontawesome.min.js')
    <title>Notes</title>
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg border-bottom border-body" style="background-color: #2299dd;" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">NOTES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Início</a>
                </li>
                @if(auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Notas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Listar</a></li>
                        <li><a class="dropdown-item" href="#">Cadastrar</a></li>
                    </ul>
                </li>
                @endif
            </ul>
            <div class="ms-auto d-flex align-items-center">
                @if(auth()->check())
                    <a href="/logout" class="mb-0 text-white text-decoration-none">Sair</a>
                @endif
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid mt-4 pb-3">
    @yield('content')
</div>
<footer class="d-flex flex-wrap justify-content-between align-items-center fixed-bottom py-3 px-4 border-top bg-body-tertiary">
    <p class="col-md-4 mb-0 text-body-secondary">© 2024 Notes, Inc</p>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
    </ul>
</footer>

</body>
</html>
