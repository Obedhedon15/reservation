<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gerant; // Assurez-vous que ce modèle existe

use Exception;

class GerantController extends Controller
{
    public function ajouterGerant()
    {
        return view('auth.registerGerant'); // Vue d'enregistrement des gerants
    }

    public function handleGerantAjouter(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:gerants,email',
            'password' => 'required|min:8',
            
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
        ]);

        try {
            
            Gerant::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Hash du mot de passe
            ]);
            return redirect()->back()->with('success', 'Gerant ajouté avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout du gerant.');
        }
    }

    public function loginGerant()
    {
        return view('auth.loginGerant');
    }
    public function handleGerantLogin(Request $request)
    
    {
        $request->validate([
            'email' => 'required|exists:gerants,email', // Vérifier dans la table medecins
            'password' => 'required',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.exists' => 'Cet email n\'est pas associé à un compte gerant.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);
    
    try 
    {
        // Debugging: afficher les données
    
        if (auth()->guard('gerant')->attempt($request->only('email', 'password'))) {
            return redirect()->route('welcome.gerant');

        } else {
            return redirect()->back()->with('error', 'Information de connexion non reconnue');
        }
    } 
     catch (Exception $e) 
     {
        \Log::error('Login error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la connexion.');
}

    }
    public function welcomeGerant()
    {
        return view('welcome.gerant');
    }
}
