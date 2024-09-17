<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name');
            $table->string('country_code');
            $table->string('currency_code');
            $table->string('currency_icon');
            $table->string('is_default')->default('No');
            $table->double('currency_rate');
            $table->string('currency_position');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('multi_currencies');
    }
};
