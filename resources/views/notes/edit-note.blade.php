<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='notes'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Modifier une note"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-bolder">Modifier la note</h6>
                        </div>
                        <div class="card-body px-4 pt-2 pb-4">
                            <form method="POST" action="{{ route('notes-update', ['id' => $note->id]) }}">
                                @csrf
                                @method('PUT')

                                <!-- Nom du module -->
                                <div class="form-group mb-3">
                                    <label for="module_name" class="form-label">Nom du module <span class="text-danger">*</span></label>
                                    <input type="text" name="module_name" id="module_name" class="form-control @error('module_name') is-invalid @enderror" 
                                           value="{{ old('module_name', $note->module_name) }}"  required>
                                    @error('module_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Code du module -->
                                <div class="form-group mb-3">
                                    <label for="module_code" class="form-label">Code du module <span class="text-danger">*</span></label>
                                    <input type="text" name="module_code" id="module_code" class="form-control @error('module_code') is-invalid @enderror" 
                                           value="{{ old('module_code', $note->module_code) }}"  required>
                                    @error('module_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Note Contrôle Continu -->
                                <div class="form-group mb-3">
                                    <label for="note_ct" class="form-label">Note Contrôle Continu</label>
                                    <input type="number" step="0.01" name="note_ct" id="note_ct" class="form-control @error('note_ct') is-invalid @enderror" 
                                           value="{{ old('note_ct', $note->note_ct) }}" >
                                    @error('note_ct')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Note Examen -->
                                <div class="form-group mb-3">
                                    <label for="note_ex" class="form-label">Note Examen</label>
                                    <input type="number" step="0.01" name="note_ex" id="note_ex" class="form-control @error('note_ex') is-invalid @enderror" 
                                           value="{{ old('note_ex', $note->note_ex) }}">
                                    @error('note_ex')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Coefficient Contrôle Continu -->
                                <div class="form-group mb-3">
                                    <label for="coef_ct" class="form-label">Coefficient Contrôle Continu</label>
                                    <input type="number" step="0.01" name="coef_ct" id="coef_ct" class="form-control @error('coef_ct') is-invalid @enderror" 
                                           value="{{ old('coef_ct', $note->coef_ct) }}" >
                                    @error('coef_ct')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Coefficient Examen -->
                                <div class="form-group mb-3">
                                    <label for="coef_ex" class="form-label">Coefficient Examen</label>
                                    <input type="number" step="0.01" name="coef_ex" id="coef_ex" class="form-control @error('coef_ex') is-invalid @enderror" 
                                           value="{{ old('coef_ex', $note->coef_ex) }}" >
                                    @error('coef_ex')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Note Élément -->
                                <div class="form-group mb-3">
                                    <label for="note_element" class="form-label">Note Élément</label>
                                    <input type="number" step="0.01" name="note_element" id="note_element" class="form-control @error('note_element') is-invalid @enderror" 
                                           value="{{ old('note_element', $note->note_element) }}" >
                                    @error('note_element')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Niveau -->
                                <div class="form-group mb-3">
                                    <label for="level" class="form-label">Niveau</label>
                                    <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" 
                                           value="{{ old('level', $note->level) }}" >
                                    @error('level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Nom du professeur -->
                                <div class="form-group mb-3">
                                    <label for="professor_name" class="form-label">Nom du professeur</label>
                                    <input type="text" name="professor_name" id="professor_name" class="form-control @error('professor_name') is-invalid @enderror" 
                                           value="{{ old('professor_name', $note->professor_name) }}">
                                    @error('professor_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Boutons -->
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    <a href="{{ route('notes-index') }}" class="btn btn-secondary">Annuler</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>