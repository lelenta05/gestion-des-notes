<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='notes'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Importer des notes"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Importer des notes (CSV)</h6>
                        </div>
                        <div class="card-body">
                            <!-- Message de succès -->
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Message d'erreur -->
                            @error('csv_file')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <form action="{{ route('import-notes') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="csv_file">Fichier CSV :</label>
                                    <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">
                                    Lancer l'import
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>