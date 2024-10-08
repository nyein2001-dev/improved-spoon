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
        Schema::create('tawk_chats', function (Blueprint $table) {
            $table->id();
            $table->string('chat_link');
            $table->integer('status')->default(1);
            $table->string('widget_id')->nullable();
            $table->string('property_id')->nullable();
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
        Schema::dropIfExists('tawk_chats');
    }
};
