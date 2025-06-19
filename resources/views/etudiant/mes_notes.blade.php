<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='notes'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Liste des notes"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Mes notes</h6>
                          
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
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($notes as $note)
                                                <tr>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">
                                                        {{ $note->student?->name ?? 'Prénom inconnu' }} {{ $note->student?->last_name ?? 'Nom inconnu' }}
                                                    </td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->module_name }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->module_code }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->professor_name }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->coef_ct }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->coef_ex }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->note_ct }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->note_ex }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->note_element }}</td>
                                                    <td class="text-xs font-weight-bold mb-0 text-center">{{ $note->level }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $note->created_at->format('d/m/Y H:i') }}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>