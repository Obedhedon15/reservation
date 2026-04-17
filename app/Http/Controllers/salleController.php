<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Assurez-vous d'importer la classe Carbon
use Exception;

class SalleController extends Controller
{
     public function listeSalle()
    {    
        // Récupérer toutes les salles
        $salles = Salle::all(); 
        return view('salle.liste', compact('salles'));
    }

     public function listeSalleClient()
    {    
        // Récupérer toutes les salles
        $salles = Salle::all(); 
        return view('salle.listeVueClient', compact('salles'));
    }

    public function listeSalleSecretaire()
    {    
        // Récupérer toutes les salles
        $salles = Salle::all(); 
        return view('salle.listeVueSecretaire', compact('salles'));
    }

     public function ajouterSalle()
    {     
        return view('salle.ajouter');
    }

    public function handleSalleAjouter(Request $request)
{
   

    $request->validate([
        'salle' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tarif' => 'required|string|max:255',
        'accueil' => 'required',
        'equipement' => 'required|string|max:255',
        'statut' => 'nullable|string|max:255',
    ], [
        'salle.required' => 'Mettez le nom de la salle.',
        'photo.image' => 'Le fichier doit être une image.',
        'tarif.required' => 'Ajoutez un tarif pour la salle.',
        'accueil.required' => 'Ajoutez la capacité d\'accueil.',
        'equipement.required' => 'Ajoutez l\'équipement.',
        'statut.string' => 'Ajoutez un statut valide.',
    ]);

    try {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('salles', $photoName, 'public');
        } else {
            $photoPath = null;
        }

        Salle::create([
            'salle' => $request->salle,
            'photo' => $photoPath,
            'tarif' => $request->tarif,
            'accueil' => $request->accueil,
            'equipement' => $request->equipement,
            'statut' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Salle ajoutée avec succès.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }

    }
    public function handleSalleModifier(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'tarif' => 'required|numeric',
        'accueil' => 'required|string',
        'equipement' => 'required|string',
        'statut' => 'required|string',
        // ajoute ici d'autres validations si nécessaire
    ]);

    $salle = Salle::findOrFail($id);

    $salle->nom = $request->input('nom');
    $salle->tarif = $request->input('tarif');
    $salle->accueil = $request->input('accueil');
    $salle->equipement = $request->input('equipement');
    $salle->statut = $request->input('statut');

    $salle->save();

    return redirect()->route('salle.liste')->with('success', 'Salle modifiée avec succès.');
}

public function supprimerSalle($id)
{
    $salle = Salle::findOrFail($id);
    $salle->delete();

    return redirect()->route('salle.liste')->with('success', 'Salle supprimée avec succès.');
}
}
