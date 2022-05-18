<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishsAndFishCoordinates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fishs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('魚類名稱');
            $table->string('scientific_name')->unique()->comment("學名");
            $table->string('distribution')->comment('原生分佈');
            $table->timestamps();
        });
        Schema::create('fish_coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('fish_id');
            $table->string('surveyor')->comment('勘查者');
            $table->string('survey_method')->comment('勘查手法');
            $table->integer('survey_hours')->comment('勘查時數');
            $table->date('survey_day')->comment('勘查日期');
            $table->integer('abundance')->comment('豐度(數量)');
            $table->string('survey_place')->comment('採集地點');
            $table->decimal('longitude',10,6)->comment('經度');
            $table->decimal('latitude',10,6)->comment('緯度');
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
        Schema::dropIfExists('fishs');
        Schema::dropIfExists('fish_coordinates');
    }
}
