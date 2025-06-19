<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | Ici tu choisis l’algorithme utilisé pour hasher les mots de passe.
    | Par défaut, Laravel utilise bcrypt, mais tu peux aussi passer à argon2.
    |
    */

    'driver' => env('HASH_DRIVER', 'bcrypt'),

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Ces options sont uniquement pour l’algorithme bcrypt.
    | Le coût par défaut est 10. Tu peux l’augmenter pour plus de sécurité,
    | mais cela demandera plus de ressources CPU.
    |
    */

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Ces options sont uniquement pour argon2id ou argon2i.
    |
    */

    'argon' => [
        'memory'  => env('ARGON_MEMORY', 1024),
        'threads' => env('ARGON_THREADS', 2),
        'time'    => env('ARGON_TIME', 2),
    ],

];
