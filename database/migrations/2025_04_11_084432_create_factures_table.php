<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */ 
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->date('date_reception_facture')->nullable();
            $table->date('date_facture')->nullable();
            $table->string('numero_facture')->nullable();
            $table->string('numero_autorisation_dfccb')->nullable();
            $table->string('scan_facture')->nullable(); // Chemin du fichier
            $table->unsignedBigInteger('fournisseur_id')->nullable();
            $table->decimal('montant_ht', 15, 2)->nullable();
            $table->decimal('taux_tva', 5, 2)->default(20.00);
            $table->decimal('montant_ttc', 15, 2)->nullable();
            $table->text('remarque')->nullable();
            $table->enum('type_facture', ['M', 'C', 'Ct', 'D'])->nullable(); // M: Marché, C: Consultation, Ct: Contrat, D: Divers
            $table->string('numero_bl_attachement')->nullable();
            $table->string('numero_marche_bc_devis')->nullable();
            $table->string('objet_facture')->nullable(); // ex : Maintenance des serveurs Power IBM
            $table->string('entite')->nullable(); // ex : DE
            // // Relation avec fournisseurs (clé étrangère)
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('set null');
             $table->timestamps();
            
        });
    }
     

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
