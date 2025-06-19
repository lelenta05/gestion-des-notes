<x-layout bodyClass="">
    <div class="container text-center mt-5">
        <h1>Bienvenue sur l'Application Web de Gestion des Notes des Etudiants de l'Ecole SUPMTI</h1>
        <p class="mb-4">Veuillez vous connecté :</p>
        <div class="d-flex justify-content-center gap-3">
           
            <!-- Bouton Login -->
            <a href="{{ route('login') }}" class="btn btn-primary w-10">Login</a>
        </div>
    </div>
   
    <div class="text-center mt-3 ">
        <img src="{{ asset('assets/img/ecole.jpeg') }}" alt="Image Welcome">
    </div>
</x-layout>
    