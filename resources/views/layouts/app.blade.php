<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('app.default_title'))</title>
    <meta name="description" content="@yield('meta_description', __('app.default_meta'))">
    
    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --verde-bosque: #146834;
            --verde-hoja: #6EAF3B;
            --beige-tierra: #F3E9D2;
            --cafe-tierra: #8B5A2B;
            --oscuro-texto: #1E293B;
            --gris-fondo: #FAF8F5;
            --blanco: #FFFFFF;
        }

        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: var(--gris-fondo); 
            color: var(--oscuro-texto); 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }

        .font-poppins { font-family: 'Poppins', sans-serif; }

        .navbar-agro { 
            background-color: var(--blanco); 
            border-bottom: 2px solid var(--beige-tierra); 
            box-shadow: 0 4px 20px rgba(20, 104, 52, 0.05); 
        }

        .brand-logo { height: 42px; width: auto; object-fit: contain; }

        .nav-link-custom { 
            color: var(--oscuro-texto) !important; 
            font-weight: 500; 
            padding: 8px 16px !important; 
            border-radius: 8px; 
            transition: all 0.2s ease; 
        }

        .nav-link-custom:hover { 
            color: var(--verde-bosque) !important; 
            background-color: rgba(110, 175, 59, 0.12); 
        }

        .nav-link-custom.active { 
            color: var(--blanco) !important; 
            background-color: var(--verde-bosque); 
            font-weight: 600; 
        }

        .btn-agro-primary { 
            background: linear-gradient(135deg, var(--verde-bosque) 0%, var(--verde-hoja) 100%); 
            color: var(--blanco); 
            font-weight: 600; 
            border: none; 
            border-radius: 8px; 
            padding: 8px 18px; 
            transition: opacity 0.2s; 
        }
        .btn-agro-primary:hover { opacity: 0.9; color: var(--blanco); }

        .btn-agro-outline { 
            border: 1.5px solid var(--verde-hoja); 
            color: var(--verde-bosque); 
            font-weight: 600; 
            border-radius: 8px; 
            padding: 7px 18px; 
            background: transparent; 
            transition: all 0.2s; 
        }
        .btn-agro-outline:hover { background-color: var(--verde-hoja); color: var(--blanco); border-color: var(--verde-hoja); }

        .card-tierra {
            background-color: var(--beige-tierra);
            border: 1px solid rgba(139, 90, 43, 0.15);
            color: var(--oscuro-texto);
        }

        .badge-cafe {
            background-color: var(--cafe-tierra);
            color: var(--blanco);
        }

        .footer-agro { 
            background-color: var(--beige-tierra); 
            border-top: 1px solid rgba(20, 104, 52, 0.1); 
            margin-top: auto; 
        }
    </style>
    @stack('styles')
</head>
<body>

    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light navbar-agro py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="AgroShare" class="brand-logo" onerror="this.onerror=null; this.remove(); document.getElementById('text-brand').classList.remove('d-none');">
                    <span id="text-brand" class="fw-bold font-poppins fs-4 text-dark d-none">
                        Agro<span style="color: var(--verde-bosque);">Share</span>
                    </span>
                </a>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav me-auto ms-lg-4 mb-2 mb-lg-0 font-poppins">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-grid-fill me-1" style="color: var(--verde-hoja);"></i> {{ __('nav.explore') }}
                            </a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom {{ request()->routeIs('publication.create') ? 'active' : '' }}" href="{{ route('publication.create') }}">
                                    <i class="bi bi-plus-circle-fill me-1" style="color: var(--verde-hoja);"></i> {{ __('nav.publish') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom {{ request()->routeIs('producer.dashboard') ? 'active' : '' }}" href="{{ route('producer.dashboard') }}">
                                    <i class="bi bi-chat-left-dots-fill me-1" style="color: var(--verde-hoja);"></i> {{ __('nav.deals') }}
                                </a>
                            </li>
                            @if(in_array(auth()->user()->rol_sistema ?? '', ['admin', 'auditor']))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom text-danger {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-shield-lock-fill me-1"></i> {{ __('nav.admin') }}
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <div class="d-flex align-items-center gap-3 font-poppins">
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle d-flex align-items-center gap-1 border border-success border-opacity-25 bg-white text-dark px-2 py-1 rounded-2 shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ __('app.change_lang_tooltip') }}">
                                <i class="bi bi-globe" style="color: var(--verde-bosque);"></i>
                                <span class="text-uppercase fw-semibold" style="font-size: 0.8rem;">{{ app()->getLocale() }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="{{ url('lang/es') }}"><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">ES</span> Español</a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="{{ url('lang/mi') }}"><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">MI</span> Miskito</a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="{{ url('lang/my') }}"><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">MY</span> Mayangna</a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2 py-1.5" href="{{ url('lang/ga') }}"><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">GA</span> Garífuna</a></li>
                            </ul>
                        </div>

                        <div class="vr bg-secondary opacity-25"></div>

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-agro-outline btn-sm">{{ __('nav.login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-agro-primary btn-sm">{{ __('nav.register') }}</a>
                        @else
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-2 px-3">{{ __('nav.logout') }}</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="footer-agro py-4">
        <div class="container text-center font-poppins">
            <p class="fw-bold fs-6 mb-1 text-dark" style="color: var(--cafe-tierra) !important;">AgroShare Nicaragua</p>
            <small class="text-secondary">&copy; {{ date('Y') }} AgroShare. {{ __('app.rights') }}</small>
        </div>
    </footer>

    <div class="modal fade" id="welcomeLangModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-3 card-tierra">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-poppins fw-bold text-dark">
                        <i class="bi bi-translate me-2" style="color: var(--cafe-tierra);"></i> {{ __('app.welcome_title') }}
                    </h5>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="text-secondary mb-4">{{ __('app.welcome_desc') }}</p>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ url('lang/es') }}" onclick="localStorage.setItem('agro_lang_selected', 'true')" class="btn btn-agro-primary px-3 py-2">Español</a>
                        <a href="{{ url('lang/mi') }}" onclick="localStorage.setItem('agro_lang_selected', 'true')" class="btn btn-agro-outline px-3 py-2">Miskito</a>
                        <a href="{{ url('lang/my') }}" onclick="localStorage.setItem('agro_lang_selected', 'true')" class="btn btn-agro-outline px-3 py-2">Mayangna</a>
                        <a href="{{ url('lang/ga') }}" onclick="localStorage.setItem('agro_lang_selected', 'true')" class="btn btn-agro-outline px-3 py-2">Garífuna</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (!localStorage.getItem('agro_lang_selected')) {
                var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeLangModal'));
                welcomeModal.show();
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>