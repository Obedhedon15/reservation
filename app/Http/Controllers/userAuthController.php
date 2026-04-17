<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assurez-vous que le modèle User existe
use App\Models\Salle;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    // Affiche le formulaire d'inscription
    public function ajouterUser()
    {
        return view('auth.registerUser'); // Vue pour l'inscription des utilisateurs
    }


    public function listeSalle()
    {    
        // Récupérer toutes les salles
        $salles = Salle::all(); 
        return view('welcome.user', compact('salles'));
    }
    // Gère l'ajout d'un nouvel utilisateur
    public function handleUserAjouter(Request $request)
    {
       $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ], [
        'nom.required' => 'Le nom est obligatoire.',
        'prenom.required' => 'Le prénom est obligatoire.',
        'telephone.required' => 'Le téléphone est obligatoire.',
        'adresse.required' => 'L\'adresse est obligatoire.',

        'email.required' => 'L\'email est obligatoire.',
        'email.email' => 'L\'email doit être une adresse valide.',
        'email.unique' => 'Cet email est déjà utilisé.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
    ]);

    // Création de l'utilisateur
    User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->back()->with('success', 'Inscription Reussie');
    }

    // Affiche le formulaire de connexion
    public function loginUser()
    {
        return view('auth.loginUser'); // Vue pour la connexion des utilisateurs
    }

    // Gère la connexion de l'utilisateur
    public function handleUserLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.exists' => 'Cet email n\'est pas associé à un compte.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        // Tentative de connexion
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('welcome.user');
        }

        return redirect()->back()->with('error', 'Informations de connexion non reconnues.');
    }

    // Affiche la page de bienvenue
    public function welcomeUser()
    {
        $salles = Salle::all(); // Récupère toutes les salles
    return view('welcome.user', compact('salles')); 
    }

    public function listeUser()
    {
        return view('auth.listeUser'); // Vue pour la page de bienvenue
    }
}