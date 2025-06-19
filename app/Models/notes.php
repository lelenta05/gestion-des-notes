<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notes extends Model
{

     protected $fillable = [
        'level',
        'module_name',
        'module_code', 
        'coef_ct',
        'coef_ex',
        'student_code',
        'name',
        'last_name',
        'note_ct',
        'note_ex',
        'note_element',
        'professor_name',
    ];

    //les relations 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Va trouver dans la table users le champ code_etudiant 
     * qui a la même valeur que student_code dans la table notes.
     */
    public function student()
    {
        return $this->belongsTo(User::class,
            'student_code',   // clé étrangère dans notes
            'code_etudiant'   // clé locale dans users
        );
    }

    
}

