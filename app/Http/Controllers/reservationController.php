<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class ReservationController extends Controller
{
    public function listeReservation()
    {
        $reservations = Reservation::with(['user', 'salle'])->get();
        return view('reservation.liste', compact('reservations'));
    }

    public function reserverSalle($id)
{
    $salle = Salle::findOrFail($id);
    return view('reservation.reserverSalle', compact('salle'));
}

    public function listeReservationSecretaire()
    {
        $reservations = Reservation::with(['user', 'salle'])->get();
        return view('reservation.listeVueSecretaire', compact('reservations'));
    }

    public function ajouterReservation()
    {
        $salles = Salle::all();
        return view('reservation.ajouter', compact('salles'));
    }

    public function handleReservationAjouter(Request $request)
    {
        $request->validate([
            'salle_id' => 'required|exists:salles,id',
            'date_reservation' => 'required|date|after_or_equal:today',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ], [
            'salle_id.required' => 'La salle est obligatoire.',
            'salle_id.exists' => 'La salle sélectionnée est invalide.',
            'date_reservation.required' => 'La date de réservation est obligatoire.',
            
            'heure_debut.required' => 'L\'heure de début est obligatoire.',
            'heure_debut.date_format' => 'Le format de l\'heure de début est invalide.',
            'heure_fin.required' => 'L\'heure de fin est obligatoire.',
            'heure_fin.date_format' => 'Le format de l\'heure de fin est invalide.',
            'heure_fin.after' => 'L\'heure de fin doit être postérieure à l\'heure de début.',
             'statut.required' => 'Le statut est obligatoire.',
        ]);

        // Vérification de conflit de réservation
        $conflit = Reservation::where('salle_id', $request->salle_id)
            ->where('date_reservation', $request->date_reservation)
            ->where(function ($query) use ($request) {
                $query->whereBetween('heure_debut', [$request->heure_debut, $request->heure_fin])
                      ->orWhereBetween('heure_fin', [$request->heure_debut, $request->heure_fin])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('heure_debut', '<=', $request->heure_debut)
                            ->where('heure_fin', '>=', $request->heure_fin);
                      });
            })
            ->exists();

        if ($conflit) {
            return redirect()->back()->with('error', 'Ce créneau horaire est déjà réservé pour cette salle.');
        }

        try {
            Reservation::create([
                'user_id' => Auth::id(),
                'salle_id' => $request->salle_id,
                'date_reservation' => $request->date_reservation,
                'heure_debut' => $request->heure_debut,
                'heure_fin' => $request->heure_fin,
                'statut' => $request->statut,
            ]);

            return redirect()->back()->with('success', 'Réservation ajoutée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de la réservation.');
        }
    }

    public function supprimerReservation($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            return redirect()->back()->with('success', 'Réservation supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de la réservation.');
        }
    }

    public function modifierReservation($id)
{
    $reservation = Reservation::findOrFail($id);
    $salles = Salle::all(); // ✅ récupération des salles
    return view('reservation.updates', compact('reservation', 'salles'));
}

    public function handleReservationModifier(Request $request, $id)
{
    $request->validate([
        'salle_id' => 'required|exists:salles,id',
        'date_reservation' => 'required|date',
        'heure_debut' => 'required|date_format:H:i',
        'heure_fin' => 'required|date_format:H:i|after:heure_debut',
    ]);

    $reservation = Reservation::findOrFail($id);
    $reservation->salle_id = $request->salle_id;
    $reservation->date_reservation = $request->date_reservation;
    $reservation->heure_debut = $request->heure_debut;
    $reservation->heure_fin = $request->heure_fin;
    $reservation->save();

    return redirect()->route('reservation.liste')->with('success', 'Réservation mise à jour avec succès.');
}

public function validationReservation($id)
{
    $reservation = Reservation::findOrFail($id);
    $salles = Salle::all(); // ✅ récupération des salles
    return view('reservation.validerReservation', compact('reservation', 'salles'));
}

public function handleReservationValider(Request $request, $id)
{
     // Validation des données entrantes
    $request->validate([
        'statut' => 'required|string|in:Confirmer,Annuler,Reprogrammer',
    ]);

    $reservation = Reservation::findOrFail($id); // Récupérer le rendez-vous par ID
    $reservation->statut = $request->statut; // Mettre à jour le statut
    $reservation->save(); // Enregistrer les modifications

    return redirect()->back()->with('success', 'Rendez-vous modifié avec succès.');

    
}

}
