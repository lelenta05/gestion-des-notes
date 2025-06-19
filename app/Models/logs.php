<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logs extends Model
{

    protected $fillable =[
        'entity_name',
        'action',
        'details',
        'user_id'
    ];

    protected $casts=[ 'details'=> 'array'];//convertir automatiquement json en array

    //les relations 
    public function user()
    {
        return $this -> belongsTo(User::class);
    }
}
