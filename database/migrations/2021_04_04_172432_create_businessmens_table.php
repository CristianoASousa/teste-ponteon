<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessmensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessmens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dad_businessmen_id')
                ->nullable()
                ->constrained('businessmens')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('cell')->unique();
            $table->string('state');
            $table->string('city');
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
        Schema::dropIfExists('businessmens');
    }
}
