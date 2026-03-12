<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            
            // APENAS UMA VEZ - usando foreignId que já cria a coluna e a chave estrangeira
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            
            $table->string('type');  // 'image', 'signature', 'fingerprint'
            $table->string('path');  // Caminho do arquivo
            $table->timestamps();
            $table->softDeletes();   // Para deleção suave (opcional)
            
            // Índice para melhor performance nas buscas
            $table->index(['card_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}