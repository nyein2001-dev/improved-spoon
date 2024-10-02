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
        Schema::create('provider_withdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('method', 255);
            $table->double('total_amount');
            $table->double('withdraw_amount');
            $table->double('withdraw_charge');
            $table->double('charge_amount')->default(0);
            $table->text('account_info');
            $table->integer('status')->default(0);
            $table->string('approved_date', 191)->nullable();
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
        Schema::dropIfExists('provider_withdraws');
    }
};
