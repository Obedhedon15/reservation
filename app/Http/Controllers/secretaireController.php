<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salle;
use App\Models\Reservation;
use App\Models\Secretaire;
use Illuminate\Support\Facades\Auth;

use Exception;


class SecretaireController extends Controller
{
     public function listeSecretaire()
    {     
        return view('secretaire.liste');
    }
    public function ajouterSecretaire()
    {     
        return view('auth.registerSecretaire');
    }

    public function handleSecretaireAjouter(Request $request)
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
            
            Secretaire::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Hash du mot de passe
            ]);
            return redirect()->back()->with('success', 'Secretaire ajouté avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout du secretaire.');
        }
    }

    public function loginSecretaire()
    {
        return view('auth.loginSecretaire');
    }
    public function handleSecretaireLogin(Request $request)
    
    {
        $request->validate([
            'email' => 'required|exists:secretaires,email', // Vérifier dans la table medecins
            'password' => 'required',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.exists' => 'Cet email n\'est pas associé à un compte gerant.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);
    
    try 
    {
        // Debugging: afficher les données
    
        if (auth()->guard('secretaire')->attempt($request->only('email', 'password'))) {
            return redirect()->route('welcome.secretaire');

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
    public function welcomeSecretaire()
    {
        return view('welcome.secretaire');
    }

}
