@props(['titlePage'])

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="d-flex align-items-center justify-content-between w-100">
            {{-- Titre à gauche --}}
            <div class="flex-shrink-0">
                <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
            </div>

            {{-- Barre de recherche au centre (admin/assistant uniquement) --}}
            <div class="flex-grow-1 d-flex justify-content-center">
                @php
                    $userRole = Auth()->user()->role->name ?? '';
                    $route = $userRole === 'admin' ? 'admin.dashboard' : ($userRole === 'assistant' ? 'assistant.dashboard' : null);
                @endphp
                @if($route)
                <form method="GET" action="{{ route($route) }}" class="w-100" style="max-width: 300px;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher un utilisateur" value="{{ request('search') }}">
                        <button type="submit" class=" btn btn-info btn-sm mt-3">
                            <i class="fas fa-search"></i> Recherche
                        </button>
                    </div>
                </form>
                @endif
            </div>
            
            {{-- Bouton Sign Out à droite --}}
            <div class="flex-shrink-0 ms-3">
                <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                    @csrf
                </form>
                <a href="#" class="nav-link text-body font-weight-bold px-0"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="d-sm-inline d-none btn btn-danger">Déconnexion </span>
                </a>
            </div>
            <div > 
                <ul class="navbar-nav  justify-content-end">
              
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                        
            </ul>
            </div>
        </div>
    </div>
</nav>
