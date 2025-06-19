<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Ajouter un utilisateur"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-gradient-primary text-white text-center py-4">
                            <h4 class="mb-0 text-white">Ajouter un utilisateur</h4>
                        </div>
                       
                        <div class="card-body px-5 py-4">
                            <form method="POST" action="{{ route('assistant.store') }}">
                                @csrf
                                <!-- Prénom -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Prénom <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Entrez le prénom" required>
                                </div>

                                <!-- Nom -->
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Entrez le nom" required>
                                </div>

                               <!-- Rôle -->
                                <!-- Si l'utilisateur connecté est assistant, il ne peut créer que des étudiants -->

                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Rôle <span class="text-danger">*</span></label>
                                    <select id="role_id" name="role_id" class="form-control" onchange="toggleEtudiantFields(this)" required>
                                        @foreach ($roles as $role)
                                        @if (Auth()->user()->role->name === 'assistant')
                                            @if ($role->name === 'etudiant')
                                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                            @endif 
                                        @else
                                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option> 
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Code Étudiant (dynamique) -->
                                <div class="mb-3" id="etudiantFields" style="display: none;">
                                    <div class="form-group">
                                        <label for="code_etudiant">Code Étudiant</label>
                                        <input type="text" name="code_etudiant" id="code_etudiant" class="form-control" value="{{ old('code_etudiant') }}">
                                    </div>
                                </div>

                               <!-- Champs pour l'Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                </div>

                                <!-- Champs pour le Mot de Passe -->
                                <div class="form-group">
                                    <label for="password">Mot de Passe</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
         
                                <!-- Bouton d'ajout -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary w-100">Ajouter l'utilisateur</button>
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
    // Fonction pour afficher/masquer les champs "Code Étudiant" et activer/désactiver les champs "Email" et "Mot de Passe"
    function toggleEtudiantFields(selectElement) {
        const etudiantFields = document.getElementById('etudiantFields'); // Champ "Code Étudiant"
        const emailField = document.getElementById('email');             // Champ "Email"
        const passwordField = document.getElementById('password');       // Champ "Mot de Passe"

        const studentRoleId = "{{ $roles->where('name', 'etudiant')->first()->id ?? '' }}"; // ID du rôle Étudiant

        if (selectElement.value === studentRoleId) {
            // Afficher les champs pour l'Étudiant
            etudiantFields.style.display = 'block';

            // Remplir automatiquement Email et Mot de Passe
            const codeEtudiant = document.getElementById('code_etudiant').value;
            emailField.value = codeEtudiant ? `${codeEtudiant}@supmti.com` : '';
            passwordField.value = codeEtudiant ? codeEtudiant : '';

            // Désactiver Email et Mot de Passe
            emailField.setAttribute('readonly', true);
            passwordField.setAttribute('readonly', true);
        } else {
            // Masquer le champ "Code Étudiant"
            etudiantFields.style.display = 'none';

            // Réinitialiser Email et Mot de Passe
            emailField.value = '';
            passwordField.value = '';

            // Activer Email et Mot de Passe
            emailField.removeAttribute('readonly');
            passwordField.removeAttribute('readonly');
        }
    }

    // Initialisation au chargement de la page
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role_id');
        toggleEtudiantFields(roleSelect);
    });
</script>