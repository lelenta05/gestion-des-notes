<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='users'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Modifier un utilisateur"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-gradient-primary text-white text-center py-4">
                            <h4 class="mb-0 text-white">Modifier un utilisateur</h4>
                        </div>
                       
                        <div class="card-body px-5 py-4">
                            <form method="POST" action="{{ route('admin.update', ['id' => $user->id]) }}">
                                @csrf
                                @method('PUT')

                                <!-- Prénom -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Prénom <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        class="form-control" 
                                        placeholder="Entrez le prénom" 
                                        value="{{ old('name', $user->name) }}" 
                                        required>
                                </div>

                                <!-- Nom -->
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        id="last_name" 
                                        name="last_name" 
                                        class="form-control" 
                                        placeholder="Entrez le nom" 
                                        value="{{ old('last_name', $user->last_name) }}" 
                                        required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        class="form-control" 
                                        placeholder="Entrez l'adresse email" 
                                        value="{{ old('email', $user->email) }}" 
                                        required>
                                </div>

                                 <!-- Mot de passe -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Nouveau mot de passe <span class="text-muted">(Laissez vide pour ne pas changer)</span></label>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        class="form-control" 
                                        placeholder="Entrez un nouveau mot de passe">
                                </div>

                               <!-- Rôle -->
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Rôle <span class="text-danger">*</span></label>
                                    <select 
                                        id="role_id" 
                                        name="role_id" 
                                        class="form-select" 
                                        onchange="toggleEtudiantFields(this)" 
                                        required>
                                        <option value="" disabled>Choisissez un rôle</option>
                                        @foreach ($roles as $role)
                                            <option 
                                                value="{{ $role->id }}" 
                                                {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Code Étudiant (dynamique) -->
                                <div class="mb-3" id="etudiantFields" style="display: {{ $user->role_id == ($roles->where('name', 'etudiant')->first()->id ?? '') ? 'block' : 'none' }};">
                                    <label for="code_etudiant" class="form-label">Code Étudiant</label>
                                    <input 
                                        type="text" 
                                        id="code_etudiant" 
                                        name="code_etudiant" 
                                        class="form-control" 
                                        placeholder="Entrez le code étudiant" 
                                        value="{{ old('code_etudiant', $user->code_etudiant) }}">
                                </div>

                                <!-- Bouton de modification -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary w-100">Modifier l'utilisateur</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary  w-100">Annuler</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

<script>
    // Fonction pour afficher/masquer le champ "Code Étudiant"
    function toggleEtudiantFields(selectElement) {
        const etudiantFields = document.getElementById('etudiantFields');
        const studentRoleId = "{{ $roles->where('name', 'etudiant')->first()->id ?? '' }}"; // ID du rôle Étudiant
        etudiantFields.style.display = (selectElement.value === studentRoleId) ? 'block' : 'none';
    }
</script>