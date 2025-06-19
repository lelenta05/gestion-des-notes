<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='notes'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Liste des notes"></x-navbars.navs.auth>

           @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Liste des notes</h6>

                            <div>
                                <form method="POST" action="{{route('admin.destroyNotes')}}" onsubmit="return confirm('Voulez-vous vraiment supprimer tous les notes  ? Cette action est irréversible.')">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">
                                        Supprimer tous les notes
                                    </button>
                                </form>
                            </div>

                            <!-- Formulaire de recherche -->
                           
                            <form method="GET" action="{{ route('notes-index') }}" class="w-100" style="max-width: 300px;">
                                <input type="text" name="search" class="form-control me-2" placeholder="Rechercher par code module" value="{{ request('search') }}">
                                <button type="submit" class=" btn btn-info btn-sm ">
                                       Recherche  
                                </button>
                            </form>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            @if($notes->isEmpty())
                                <div class="alert alert-primary mx-4 my-4 text-white">Aucune note trouvée.</div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Étudiant</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Module</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code module</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Professeur</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Coefficient Contrôle Continu</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Coefficient Examen</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contrôle continu</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Examen</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Élément</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Niveau</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Importé le</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($notes as $note)
                                                <tr>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $note->student?->name ?? 'Prénom inconnu' }} {{ $note->student?->last_name ?? 'Nom inconnu' }}
                                                    </td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->module_name }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center ">{{ $note->module_code }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->professor_name }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->coef_ct }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->coef_ex }}</td>

                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->note_ct }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->note_ex }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->note_element }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->level }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $note->created_at->format('d/m/Y H:i') }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">
                                                        <a href="{{ route('notes-edit', ['id'=>$note->id]) }}" class="btn btn-sm btn-warning">
                                                            Modifier
                                                        </a>
                                                        <form action="{{ route('notes-delete', ['id'=>$note->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                 Supprimer
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $notes->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>