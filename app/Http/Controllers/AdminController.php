<?php

namespace App\Http\Controllers;

use App\Models\notes;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User ;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        
        $users=User::with('role')//la fonction role dans le modele de user
        ->when($request->query('search'),function ($query, $search){
             $query->where ('name','LIKE',"%$search%")
            ->orWhere('last_name','LIKE',"%$search%")
            ->orWhere('code_etudiant','LIKE',"%$search%");
        })->paginate(15);
       
        return view('admin.index',compact('users'));
    }

    public function create()
    {
        $roles =Role::all();
        return view('admin.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $valid=$request->validate([
            'name'=> 'required|string|max:225',
             'last_name'=> 'required|string|max:225',
             'email' => 'nullable|email|unique:users',
             'password' => 'nullable|min:6',
             'role_id' => 'required|exists:roles,id',
             'code_etudiant'=> 'nullable|string|max:255|unique:users,code_etudiant',

        ]);
         // Vérifier si le rôle est "Étudiant" avant de sauvegarder le code étudiant
        $studentRoleId = Role::where('name', 'etudiant')->first()->id;//cherche dans role etudiant et on prend son id 
        $codeEtudiant = ($valid['role_id'] == $studentRoleId) ? $valid['code_etudiant'] : null;//apres compare si c'est etudiant on prend .sinon on envoier null

        // Générer automatiquement l'email et le mot de passe si le rôle est "Étudiant"
        $email = ($valid['role_id'] == $studentRoleId && $codeEtudiant) ? $codeEtudiant . '@supmti.com' : $valid['email'];
        $password = ($valid['role_id'] == $studentRoleId && $codeEtudiant) ? Hash::make($codeEtudiant) : Hash::make($valid['password']);

        User::create([
            'name' => $valid['name'],
            'last_name'=> $valid['last_name'],
            'email'=> $email,
            'password'=> $password,
            'role_id'=> $valid['role_id'],
            'code_etudiant' =>  $codeEtudiant ,
         ]);
        return redirect()->route('admin.dashboard')->with('success','Utilisateur créé avec succès !');
    }

    public function edit ($id)
    {
        $user=User::findorFail($id);
        $roles=Role::all();
        return view('admin.edit',compact(['user','roles']));
    }

    public function update(Request $request ,  $id)
    {
        $user=User::findorFail($id);

        $valid=$request->validate([
            'name'=> 'required|string|max:225',
             'last_name'=> 'required|string|max:225',
             'email' => 'nullable|email|unique:users,email,'.$user->id,//ignore l'id lors de la verification 
             'password' => 'nullable|min:6',
             'role_id' => 'required|exists:roles,id',
             'code_etudiant'=> 'nullable|string|max:255|unique:users,code_etudiant,'.$user->id,
         ]);

          // Vérifier si le rôle est "Étudiant" avant de sauvegarder le code étudiant
         $studentRoleId = Role::where('name', 'etudiant')->first()->id;
        $codeEtudiant = ($valid['role_id'] == $studentRoleId) ? $valid['code_etudiant'] : null;

        // Générer automatiquement l'email et le mot de passe si le rôle est "Étudiant"
        $email = ($valid['role_id'] == $studentRoleId && $codeEtudiant) ? $codeEtudiant . '@supmti.com' : $valid['email'];
        $password = $request->filled('password')  ? Hash::make($valid['password'])  : ($valid['role_id'] == $studentRoleId && $codeEtudiant ? Hash::make($codeEtudiant) : $user->password);
         $user->update([
            'name' => $valid['name'],
            'last_name'=> $valid['last_name'],
            'email'=> $email,
            'password' => $password ,
            'role_id'=> $valid['role_id'],
            'code_etudiant' =>  $codeEtudiant,

         ]);

        return redirect()->route('admin.dashboard')->with('success','Utilisateur a été mise à jour avec succès !');
    }

    public function delete( $id)
    {
        $user=User::findorFail($id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success','Utilisateur a été supprime avec succès !');
    }

    //supprimer  tous les notes 
    public function destroyNotes()
    {
        //supprimer tous les notes 
        notes::truncate();
        return redirect()->back()->with('success', 'Toutes les notes ont été supprimés.');

    }

     //supprimer tous les utilisateur sauf l'admin 
    public function destroyUser()
    {
        //supprimer tous les utilisateurs sauf les admins 
        User::where('role_id','!=','1')->delete() ; 
        return redirect()->back()->with('success', 'Toutes les notes ont été supprimés.');
    }
}
