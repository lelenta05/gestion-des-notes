<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="logs"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Logs d'application"></x-navbars.navs.auth>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 shadow">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h6 class="mb-0">Logs d'application</h6>
                            <form method="GET" class="d-flex align-items-center gap-2 mb-0 flex-wrap">
                                <!-- Filtre par type d'utilisateur -->
                                <select name="user_type" class="form-select form-select-sm" style="min-width:140px;">
                                    <option value="">Tous les utilisateurs</option>
                                    <option value="admin" {{ request('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="assistant" {{ request('user_type') == 'assistant' ? 'selected' : '' }}>Assistant</option>
                                    <option value="etudiant" {{ request('user_type') == 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                                </select>

                                <!-- Filtre par action -->
                                <select name="action" class="form-select form-select-sm" style="min-width:140px;">
                                    <option value="">Toutes les actions</option>
                                    <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Création</option>
                                    <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Modification</option>
                                    <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Suppression</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search"></i> Recherche
                                </button>
                            </form>
                        </div>
                       <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rôle</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Entité</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="min-width:180px">Détails</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($logs as $log)
                                            <tr>
                                                <td class="text-xs text-nowrap text-secondary">
                                                    {{ $log->created_at ? $log->created_at->format('Y-m-d H:i:s') : '-' }}
                                                </td>
                                                <td class="text-xs">
                                                    {{ $log->user->name ?? 'Utilisateur inconnu' }}
                                                </td>
                                                <td class="text-xs">
                                                    {{ $log->user->role->name ?? 'Non défini' }}
                                                </td>
                                                <td class="text-xs">
                                                    {{ $log->entity_name ?? 'Non défini' }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $log->action == 'deleted' ? 'danger' : ($log->action == 'created' ? 'success' : 'info') }} text-xs px-2 py-1">
                                                        {{ ucfirst($log->action) }}
                                                    </span>
                                                </td>
                                                <td style="max-width:300px;">
                                                    <pre class="text-xs  p-2 rounded mb-0" style="white-space:pre-wrap;word-break:break-word;">{{ json_encode($log->details, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-xs font-weight-bold text-secondary">
                                                    Aucun log trouvé.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>