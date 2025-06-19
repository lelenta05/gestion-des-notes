<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ;
use App\Models\notes;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    //
     public function mesNotes()
    {
        $notes = Auth::user()->notes;         
        return view('etudiant.mes_notes', compact('notes'));

    }
}
