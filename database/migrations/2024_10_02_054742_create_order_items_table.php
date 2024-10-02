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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('author_id');
            $table->integer('user_id');
            $table->string('option_name', 255)->nullable();
            $table->double('option_price')->default(0);
            $table->integer('variant_id')->nullable();
            $table->string('variant_name', 255)->nullable();
            $table->integer('qty')->default(0);
            $table->text('message')->nullable();
            $table->string('account_id', 255)->nullable();
            $table->string('approve_by_user', 255)->default('pending');
            $table->string('has_review', 255)->default('no');
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
        Schema::dropIfExists('order_items');
    }
};
