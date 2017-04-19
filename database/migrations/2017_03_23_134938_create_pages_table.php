<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('apresentation');
            $table->text('about');
            $table->string('aboutTitle');
            $table->string('logoUrl');
            $table->string('localization');
            $table->string('contactPhone');
            $table->string('contactEmail');
            $table->integer('serviceRowSize');
            $table->integer('serviceRowQuantity');
            $table->text('localizationMapUrl');
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
        Schema::dropIfExists('pages');
    }
}