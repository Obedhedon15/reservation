<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();

            // Référence utilisateur et salle
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('salle_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Informations CinetPay
            $table->string('reference')->unique();
            $table->decimal('montant', 10, 2);

            // Statut du paiement
            $table->enum('status', ['pending', 'paid', 'failed'])
                  ->default('pending');

            // Date de réservation de la salle
            $table->date('date');

            $table->timestamps();

            
    // Empêche la réservation de la même salle deux fois à la même date
    $table->unique(['salle_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
