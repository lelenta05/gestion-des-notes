<?php

namespace App\Traits;

use App\Models\logs;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    //Ce trait permet d'automatiser l'enregistrement des logs pour chaque modèle qui l'utilise.
    public static function bootLogsActivity()
    {
        // Log à la création
        static::created(function ($model) {
            self::logActivity($model, 'created');
        });

        // Log à la mise à jour
        static::updated(function ($model) {
            self::logActivity($model, 'updated');
        });

        // Log à la suppression
        static::deleted(function ($model){
            self::logActivity($model,'deleted');
        });
    }

    protected static function logActivity($model, $action)
    {
        logs::create([
            'entity_name' => class_basename($model),//nom de la classe 
            'action' => $action,
            'details' => [
                'id' => $model->id,
                'attributes' => $model->getAttributes(),//toutes les donnes du modele 
                'changes' => $action === 'updated' ? $model->getChanges() : [] //changemen si mise a jour 
            ],
            'user_id' => Auth::user()->id 
        ]);
    }
}