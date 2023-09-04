<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFormDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_form_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId("form_id")->constrained()->onDelete('cascade');
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_form_data');
    }
}
