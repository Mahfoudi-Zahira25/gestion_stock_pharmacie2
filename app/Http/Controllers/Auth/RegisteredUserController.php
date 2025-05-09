<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Valider les nouveaux champs
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',   // Nouveau champ
            'role' => 'required|string|in:pharmacien,responsable', // Nouveau champ
            'id_depot' => 'nullable|exists:depots,id', // Nouveau champ, si c'est optionnel
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Créer l'utilisateur dans la base de données
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,  // Nouveau champ
            'role' => $request->role,      // Nouveau champ
            'id_depot' => $request->id_depot, // Nouveau champ
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Connexion automatique après l'inscription
        auth()->login($user);

        // Rediriger après l'inscription
        return redirect(RouteServiceProvider::HOME);
    }
}
