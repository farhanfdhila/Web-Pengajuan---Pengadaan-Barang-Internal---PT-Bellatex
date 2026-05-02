<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KontakController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role')->orderBy('name')->get(['id', 'name', 'role', 'no_hp']);
        
        return Inertia::render('Kontak', [
            'users' => $users
        ]);
    }
}
