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
        Schema::create("Tarefas", function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->integer("tempo")->nullable();
            $table->tinyInteger("status");
            $table->unsignedBigInteger("lista_id");
            $table->foreign("lista_id")->references("id")->on("lista");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tarefas');
    }
};
