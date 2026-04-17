<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salle;
use App\Models\Reservation;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Exception;

class adminController extends Controller
{
    public function listeAdmin()
    {     
        return view('admin.liste');
    }

    public function ajouterAdmin()
    {     
        return view('auth.registerAdmin');
    }

    public function handleAdminAjouter(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
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
            Admin::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Hash du mot de passe
            ]);
            return redirect()->back()->with('success', 'Administrateur ajouté avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de l\'administrateur.');
        }
    }

    public function loginAdmin()
    {
        return view('auth.loginAdmin');
    }

    public function handleAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:admins,email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.exists' => 'Cet email n\'est pas associé à un compte administrateur.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        try {
            if (auth()->guard('admin')->attempt($request->only('email', 'password'))) {
                return redirect()->route('welcome.admin');
            } else {
                return redirect()->back()->with('error', 'Information de connexion non reconnue');
            }
        } catch (Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la connexion.');
        }
    }

    public function welcomeAdmin()
    {
        return view('welcome.admin');
    }
}
