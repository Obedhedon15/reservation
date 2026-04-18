<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Salle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaiementController extends Controller
{
    /**
     * Affiche le formulaire pour choisir salle + date
     */
    public function ajouter($id)
{
    $salle = Salle::findOrFail($id);
    return view('paiement.ajouter', compact('salle'));
}

    /**
     * Traite la demande de réservation et lance le paiement CinetPay
     */
    public function handleAjouter(Request $request)
    {
        $request->validate([
            'salle_id' => 'required|exists:salles,id',
            'date'     => 'required|date|after_or_equal:today',
            'name'     => 'required|string',
            'email'    => 'required|email',
            'phone'    => 'required|string',
        ]);

        // Vérification si la salle est déjà réservée ce jour-là
        $dejaReserve = Paiement::where('salle_id', $request->salle_id)
            ->where('date', $request->date)
            ->where('status', 'paid')
            ->exists();

        if ($dejaReserve) {
            return back()->withErrors(['date' => 'Cette salle est déjà réservée à cette date.']);
        }

        // Générer une référence unique
        $reference = 'RES-' . strtoupper(Str::random(10));

        $salle = Salle::findOrFail($request->salle_id);

        // Créer un paiement en statut "pending"
        $paiement = Paiement::create([
            'user_id'   => Auth::id(),
            'salle_id'  => $salle->id,
            'reference' => $reference,
            'montant'   => $salle->tarif, // Prix de la salle
            'status'    => 'pending',
            'date'      => $request->date,
        ]);

      // Préparer les données à envoyer à CinetPay
$dataToSend = [
    // Utilisation de config() ou env() avec une sécurité
    'apikey'           => config('services.cinetpay.api_key') ?? env('CINETPAY_API_KEY'),
    'site_id'          => config('services.cinetpay.site_id') ?? env('CINETPAY_SITE_ID'),
    'transaction_id'   => $reference,
    'amount'           => (int) $salle->tarif,
    'currency'         => 'CDF',
    'description'      => 'Réservation de la salle : ' . ($salle->nom ?? 'Inconnue'),
    'return_url'       => env('CINETPAY_RETURN_URL'),
    'notify_url'       => env('CINETPAY_NOTIFY_URL'),
    'customer_name'    => trim($request->name),
    'customer_email'   => $request->email,
    'customer_phone_number' => preg_replace('/\s+/', '', $request->phone),
    'customer_country' => 'CD',
];

    // Afficher les données pour debug et stopper ici
    //dd($dataToSend);

    // La requête vers CinetPay (ne sera pas atteinte tant que dd est là)
    $response = Http::withOptions(['verify' => false])->post('https://api-checkout.cinetpay.com/v2/payment', $dataToSend);

    $data = $response->json();

    

    if (isset($data['code']) && $data['code'] == '201') {
        return redirect()->away($data['data']['payment_url']);
    }

    return back()->with('error', 'Erreur CinetPay : ' . ($data['message'] ?? ''));
}
    /**
     * Callback CinetPay (confirmation serveur)
     */
    public function callback(Request $request)
    {
        $reference = $request->input('transaction_id');

        $paiement = Paiement::where('reference', $reference)->first();

        if (!$paiement) {
            return response()->json(['message' => 'Paiement introuvable'], 404);
        }

        // Vérifier avec CinetPay
        $verify = Http::withOptions(['verify' => false])->post('https://api-checkout.cinetpay.com/v2/payment/check', [
            'apikey'         => env('CINETPAY_API_KEY'),
            'site_id'        => env('CINETPAY_SITE_ID'),
            'transaction_id' => $reference
        ])->json();

        if (isset($verify['data']['status']) && $verify['data']['status'] === 'ACCEPTED') {
            $paiement->update(['status' => 'paid']);
        } else {
            $paiement->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'ok']);
    }

   
}
