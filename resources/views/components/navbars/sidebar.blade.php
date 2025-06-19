@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('admin.dashboard') }} ">
            <img src="{{asset('assets/img/logo-gestion-note.png')}}" class="navbar-brand-img h-100" alt="main_logo">

            <span class="ms-2 font-weight-bold text-white">Gestion des notes </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

           
           @if(Auth()->user()->role->name === 'admin')
                 <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Les fonctionnalités</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white  "href="{{route('profile.edit')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">person</i> 
                    </div>
                   <span class="nav-link-text ms-1">Mon Profil</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>

             <li class="nav-item">
                <a class="nav-link text-white  "href="{{route('admin.dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">home</i> 
                    </div>
                    <span class="nav-link-text ms-1">Gestion des utilisateurs</span>
                </a>
            </li>
           

           <li class="nav-item">
    <a class="nav-link text-white " href="{{route('notes-index')}}">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons">edit_note</i> 
        </div>
        <span class="nav-link-text ms-1">Gestion des notes</span>
    </a>
</li>


            <li class="nav-item">
                <a class="nav-link text-white "
                    href="{{ route('admin.create') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">person_add</i>
                    </div>
                    <span class="nav-link-text ms-1">Creation des utilisateurs</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link text-white  " href="{{route('import-notes-form')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons">note_add</i> 
                    </div>
                    <span class="nav-link-text ms-1">Importation des notes (csv)</span>
                </a>
            </li>

           
            <li class="nav-item">
                <a class="nav-link text-white  " href="{{route('admin.logs')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                       <i class="material-icons">admin_panel_settings</i>
                    </div>
                     <span class="material-symbols-outlined">Logs </span>
                </a>
            </li>
          
                <!-- Ajoute tous les liens spécifiques à l'admin ici -->
            @elseif(Auth()->user()->role->name === 'assistant')
                <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Les fonctionnalités</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white  "href="{{route('profile.edit')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">person</i> 
                    </div>
                    <span class="nav-link-text ms-1">Mon profil</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>

             <li class="nav-item">
                <a class="nav-link text-white  "href="{{route('assistant.dashboard')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">home</i> 
                    </div>
                    <span class="nav-link-text ms-1">Gestion des etudiants</span>
                </a>
            </li>
           

            <li class="nav-item">
                <a class="nav-link text-white " href="{{route('notes-index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons">edit_note</i> 
                    </div>
                      <span class="nav-link-text ms-1">Gestion des notes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white "
                    href="{{ route('assistant.create') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">person_add</i>
                    </div>
                    <span class="nav-link-text ms-1">Creation d'un etudiant</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link text-white  " href="{{route('import-notes-form')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons">note_add</i> 
                    </div>
                    <span class="nav-link-text ms-1">Importation des notes (csv)</span>
                </a>
            </li>
           
                <!-- Ajoute ici les liens spécifiques à l'assistant -->
            @elseif(Auth()->user()->role->name === 'etudiant')
             <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Les fonctionnalités</h6>
            </li>
             <li class="nav-item">
                <a class="nav-link text-white  "href="{{route('profile.edit')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons">person</i> 
                    </div>
                    <span class="nav-link-text ms-1">Mon profil</span>
                </a>
            </li> 
             <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>  
             <li class="nav-item">
                <a class="nav-link text-white  " href="{{route('etudiant.mesNotes')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons ">sticky_note_2</i>
                    </div>
                    <span class="nav-link-text ms-1">Mes notes</span>
                </a>
            </li>
        
            @endif
        </ul>
           
</aside>
