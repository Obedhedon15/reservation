<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gerantController;
use App\Http\Controllers\reservationController;
use App\Http\Controllers\salleController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\secretaireController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\userAuthController;
use App\Models\Salle;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

//1.INSCRIPTION_GERANT
Route::get('/registerGerant', [gerantController::class, 'ajouterGerant'])->name('gerant.register');
Route::post('/registerGerant', [gerantController::class, 'handleGerantAjouter'])->name('handleGerantAjouter');
Route::get('/loginGerant', [gerantController::class, 'loginGerant'])->name('gerant.login');
Route::post('/loginGerant', [gerantController::class, 'handleGerantLogin'])->name('handleGerantLogin');
Route::get('/welcomeGerant', [gerantController::class, 'welcomeGerant'])->name('welcome.gerant');


// Routes pour les secrétaires
Route::get('/registerSecretaire', [secretaireController::class, 'ajouterSecretaire'])->name('secretaire.register');
Route::post('/registerSecretaire', [secretaireController::class, 'handleSecretaireAjouter'])->name('handleSecretaireAjouter');
Route::get('/loginSecretaire', [secretaireController::class, 'loginSecretaire'])->name('secretaire.login');
Route::post('/loginSecretaire', [secretaireController::class, 'handleSecretaireLogin'])->name('handleSecretaireLogin');
Route::get('/welcomeSecretaire', [secretaireController::class, 'welcomeSecretaire'])->name('welcome.secretaire');

// Routes pour les utilisateurs
Route::get('/registerUser', [UserAuthController::class, 'ajouterUser'])->name('user.register');
Route::post('/registerUser', [UserAuthController::class, 'handleUserAjouter'])->name('handleUserAjouter');
Route::get('/loginUser', [UserAuthController::class, 'loginUser'])->name('user.login');
Route::post('/loginUser', [UserAuthController::class, 'handleUserLogin'])->name('handleUserLogin');
Route::get('/welcomeUser', [UserAuthController::class, 'welcomeUser'])->name('welcome.user');
Route::get('/listeUser', [UserAuthController::class, 'listeUser'])->name('liste.user');


Route::get('/listeReservation', [reservationController::class, 'listeReservation'])->name('reservation.liste');
Route::get('/listeReservationSecretaire', [reservationController::class, 'listeReservationSecretaire'])->name('reservation.listeSecretaire');
Route::get('/ajouterReservation', [reservationController::class, 'ajouterReservation'])->name('reservationAjouter');
Route::post('/ajouterReservation', [reservationController::class, 'handleReservationAjouter'])->name('handleReservationAjouter');
Route::get('/modifierReservation/{id}', [reservationController::class, 'modifierReservation'])->name('reservation.modifier');
Route::post('/modifierReservation/{id}', [reservationController::class, 'handleReservationModifier'])->name('handleReservationModifier');
Route::get('/reserver-salle/{id}', [reservationController::class, 'reserverSalle'])->name('reservation.salle');



Route::get('/validerReservation/{id}', [reservationController::class, 'validationReservation'])->name('reservation.valider');
Route::post('/validerReservation/{id}', [reservationController::class, 'handleReservationValider'])->name('handleReservationValider');
Route::delete('/supprimerReservation/{id}', [reservationController::class, 'supprimerReservation'])->name('reservation.supprimer');

// Routes pour les SALLES
Route::get('/listeSalle', [salleController::class, 'listeSalle'])->name('salle.liste');
Route::get('/listeSalleClient', [salleController::class, 'listeSalleClient'])->name('salle.listeClient');
Route::get('/listeSalleSecretaire', [salleController::class, 'listeSalleSecretaire'])->name('salle.liste');
Route::get('/ajouterSalle', [salleController::class, 'ajouterSalle'])->name('salleAjouter');
Route::post('/ajouterSalle', [salleController::class, 'handleSalleAjouter'])->name('handleSalleAjouter');
Route::get('/modifierSalle/{id}', [salleController::class, 'modifierSalle'])->name('salle.modifier');
Route::post('/modifierSalle/{id}', [salleController::class, 'handleSalleModifier'])->name('handleSalleModifier');
Route::delete('/supprimerSalle/{id}', [salleController::class, 'supprimerSalle'])->name('salle.supprimer');


// Paiements
Route::get('/paiements', [PaiementController::class, 'index'])->name('paiements.index');
Route::get('/paiements/ajouter/{id}', [PaiementController::class, 'ajouter'])->name('paiements.ajouter');
Route::post('/paiements/ajouter', [PaiementController::class, 'handleAjouter'])->name('paiements.handleAjouter');

// Routes pour retour et notification CinetPay
Route::get('/paiement/retour', [PaiementController::class, 'retour'])->name('paiements.retour');
Route::post('/paiement/notify', [PaiementController::class, 'notify'])->name('paiements.notify');
Route::get('/paiements/ajouterForm', [PaiementController::class, 'formulaire'])->name('formulaire.ajouter');

// Routes pour les administrateurs
Route::get('/registerAdmin', [adminController::class, 'ajouterAdmin'])->name('admin.register');
Route::post('/registerAdmin', [adminController::class, 'handleAdminAjouter'])->name('handleAdminAjouter');

Route::get('/loginAdmin', [adminController::class, 'loginAdmin'])->name('admin.login');
Route::post('/loginAdmin', [adminController::class, 'handleAdminLogin'])->name('handleAdminLogin');

Route::get('/welcomeAdmin', [adminController::class, 'welcomeAdmin'])->name('welcome.admin');



Route::get('/', function () {
    $salles = Salle::all();
    return view('welcome', compact('salles'));
});