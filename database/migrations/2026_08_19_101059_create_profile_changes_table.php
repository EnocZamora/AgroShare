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
        Schema::create('profile_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Datos del perfil modificados
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('preferred_language', 10);
            $table->string('department')->nullable();
            $table->string('municipality')->nullable();
            $table->string('profile_photo')->nullable();
            
            // IP y Agente de usuario para auditoría
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_changes');
    }
};