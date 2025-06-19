<?php

namespace App\Http\Controllers;

use App\Models\logs;
use App\Models\Role;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
     public function index(Request $request)
    {
       $query = logs::query();

    // Appliquer les filtres si renseignés
    if ($request->user_type) {
        $query->whereHas('user.role', function ($q) use ($request) {
            $q->where('name', $request->user_type);
        });
    }

    if ($request->action) {
        $query->where('action', $request->action);
    }

    $logs = $query->with(['user.role'])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.logs', compact('logs'));
    }
}
