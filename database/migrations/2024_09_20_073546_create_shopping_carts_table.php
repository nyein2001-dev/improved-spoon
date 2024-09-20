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
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('variant_id')->default(0);
            $table->string('variant_name')->nullable();
            $table->string('option_name')->default('0');
            $table->double('option_price')->default(0);
            $table->unsignedInteger('qty')->default(0);
            $table->text('message')->nullable();
            $table->text('account_id')->nullable();
            $table->string('item_type')->default('add_to_cart');
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
        Schema::dropIfExists('shopping_carts');
    }
};
