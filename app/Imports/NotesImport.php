<?php

namespace App\Imports;

use App\Models\notes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NotesImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *Pour chaque ligne du CSV, cette méthode est appelée avec un array $row
    *où les clés sont les en-têtes du fichier (heading row).
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //creation de l'etudiant si elle existe pas 
       $etudiant = User::firstOrCreate(
            ['code_etudiant' => $row['student_code']],
            [
                'name' => $row['first_name'],
                'last_name'  => $row['last_name'],
                'email'      => $row['student_code'] . '@supmti.com',
                'password'   => Hash::make($row['student_code']),
                'role_id'    => 3 // ID du rôle "Étudiant"
            ]
        );
        // Vérifier si la note existe déjà
        $noteExiste = notes::where('student_code', $row['student_code'])
            ->where('module_code', $row['module_code'])
            ->exists();

        if ($noteExiste) {
            return null; // Ne rien insérer, on saute cette ligne
        }

        return new notes([
            'etudiant_id'     => $etudiant->id,
            'name'            => $row['first_name'],
            'last_name'       => $row['last_name'],
            'module_name'    => $row['module_name'],
            'module_code'    => $row['module_code'],
            'note_ct'        => $row['note_ct'],
            'note_ex'        => $row['note_ex'],
            'coef_ct'        => $row['coef_ct'],
            'coef_ex'        => $row['coef_ex'],
            'student_code'   => $row['student_code'],
            'note_element'   => $row['note_element'],
            'level'          => $row['level'],
            'professor_name' => $row['professor_name'],

        ]);
    }
}
