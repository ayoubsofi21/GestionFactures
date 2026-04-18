<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('factureautorises', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_facture');
            $table->string('scan_facture');
            $table->integer('numero_autorisation');
            $table->date('date_creation');
            $table->string('date_saisie');
            $table->string('motif_rejet')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factureautorises');
    }
};
