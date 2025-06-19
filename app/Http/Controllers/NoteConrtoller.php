<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\NotesImport;
use App\Models\notes;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class NoteConrtoller extends Controller
{

    //affichage 
    public function index(Request $request)
    {
        $me=Auth::user();
        $query=notes::with('student');
        if($me->role->nom === 'etudiant'){
            //voire que ses  notes 
            $query->where('student_code',$me->code_etudiant);
        }
        //recherche sur la colonne module de code 
         if ($request->has('search') && $request->search != '') {
        $query->where('module_code', 'LIKE', '%' . $request->search . '%');
        }
        //recuperer la page de notes
        $notes=$query->orderBy('created_at','desc')->paginate(15);
        return view('notes.index_notes',compact('notes'));

    }

    //affichage du formulaire
    public function showImport()
    {
        return view('notes.create_notes');
    }

    //traitement pour valide (store)
    public function importNotes(Request $request)
    {
        $request->validate([
            'csv_file' =>'required|file|mimes:csv,txt'
        ]);
        //lancement de l'importation via Laravel Excel
        Excel::import(new NotesImport,$request->file('csv_file'));

        return redirect()->route('notes-index')->with('success','Importation des notes reussie ');
    }

    public function edit($id)
    {
        $note=notes::findorFail($id);
        return view('notes.edit-note',compact('note'));
    }

    public function update (Request $request,$id)
    {
         $request->validate([
        'module_name'    => 'required|string|max:255',
        'module_code'    => 'required|string|max:255',
        'note_ct'        => 'nullable|numeric',
        'note_ex'        => 'nullable|numeric',
        'coef_ct'        => 'nullable|numeric',
        'coef_ex'        => 'nullable|numeric',
        'note_element'   => 'nullable|numeric',
        'level'          => 'nullable|string|max:255',
        'professor_name' => 'nullable|string|max:255',
    ]);

    $note = notes::findOrFail($id); // Trouver la note à mettre à jour

    // Mettre à jour les données
    $note->update([
        'module_name'    => $request->module_name,
        'module_code'    => $request->module_code,
        'note_ct'        => $request->note_ct,
        'note_ex'        => $request->note_ex,
        'coef_ct'        => $request->coef_ct,
        'coef_ex'        => $request->coef_ex,
        'note_element'   => $request->note_element,
        'level'          => $request->level,
        'professor_name' => $request->professor_name,
    ]);

    return redirect()->route('notes-index')->with('success', 'La note a été mise à jour avec succès.');
    }

    public function delete($id)
{
    $note = notes::findOrFail($id);
    $note->delete();

    return redirect()->route('notes-index')->with('success', 'La note a été supprimée avec succès.');
}
}
