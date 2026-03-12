<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('date_of_birth');
            $table->string('birth_place');
            $table->string('marital_status');
            $table->string('profession');
            $table->string('address');
            $table->string('entry_date');
            $table->string('document_number');
            $table->string('place_of_issue');
            $table->string('date_of_issue');
            $table->string('expiry_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
