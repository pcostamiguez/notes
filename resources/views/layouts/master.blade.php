<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/assets/css/bootstrap.min.css')
    @vite('resources/assets/css/fontawesome.min.css')
    @vite('resources/assets/css/brands.min.css')
    @vite('resources/assets/css/regular.min.css')
    @vite('resources/assets/css/solid.min.css')
    @vite('resources/assets/css/app.css')
    @vite('resources/assets/js/app.js')
    @vite('resources/assets/js/bootstrap.bundle.min.js')
    @vite('resources/assets/js/fontawesome.min.js')
    @vite('resources/assets/js/brands.min.js')
    @vite('resources/assets/js/regular.min.js')
    @vite('resources/assets/js/solid.min.js')
    <title>Notes</title>
</head>
<body style="background: #fafafa">
<nav class="navbar sticky-top navbar-expand-lg border-bottom border-black" style="background-color: #7382a0;"
     data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('home.index') }}">NOTES</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page"
                       href="{{ route('home.index') }}">Início</a>
                </li>
                @if(auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Notas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('note.index') }}">Listar</a></li>
                            <li><a class="dropdown-item" href="{{ route('note.create') }}">Cadastrar</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto">
                @if(auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa-solid fa-bell bell-ring text-warning"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;">
                            <li class="mb-2">
                                <span class="d-block fw-bold">Nova Notificação</span>
                                <small class="text-muted">Você recebeu uma nova mensagem de fulano.</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-center" href="#">Ver todas as <b class="text-danger">99</b>
                                    notificações</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            {{ auth()->user()->email }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Alterar senha</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('note.audit') }}">Auditoria</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Sair</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container my-lg-5 pb-lg-5">
    @yield('content')
</div>
<footer
    class="d-flex flex-wrap justify-content-between align-items-center fixed-bottom py-3 px-4 border-top bg-body-tertiary">
    <p class="col-md-4 mb-0 text-body-secondary">© 2024 Notes - v.1.0.0</p>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary fst-italic">Termos de uso</a></li>
        <li class="nav-item"><a class="nav-link px-2 text-body-secondary fw-bold">Núcleo DEV</a></li>
    </ul>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let forms = document.querySelectorAll('form');
        forms.forEach(function (form) {
            form.addEventListener('submit', function () {
                let submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    let spinner = submitButton.querySelector('.spinner-border');
                    if (spinner) {
                        spinner.classList.remove('d-none');
                    }
                }
            });
        });
    });
</script>

</body>
</html>
