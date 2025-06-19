<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Liste des utilisateurs"></x-navbars.navs.auth>

           @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-gradient-primary text-white">
                            <h4 class="mb-0 text-white">Liste des utilisateurs</h4>
                        </div>
                        <div class="card-body">
                           

                            <!-- Tableau des utilisateurs -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Prénom</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Code Etudiant</th>
                                            <th>Rôle</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                        @if ($user->role->name === 'etudiant')
                                              <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->code_etudiant }}</td>
                                                <td>{{ $user->role->name ?? 'Aucun rôle' }}</td>
                                                <td>
                                                    <a href="{{ route('assistant.edit',['id'=> $user->id]) }}" class="btn btn-sm btn-warning">Modifier</a>
                                                    <form action="{{ route('assistant.delete', ['id'=>$user->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                       @endif
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Aucun Etudiant trouvé</td>
                                            </tr> 
                                         
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-3">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>