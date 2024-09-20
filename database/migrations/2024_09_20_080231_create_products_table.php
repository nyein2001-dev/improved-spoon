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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('category_id');
            $table->text('slug');
            $table->decimal('regular_price', 10, 0)->nullable();
            $table->decimal('offer_price', 10, 0)->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->text('tags')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('approve_by_admin')->default(0);
            $table->integer('popular_item')->default(0);
            $table->integer('trending_item')->default(0);
            $table->integer('featured_item')->default(0);
            $table->double('average_rating')->default(0);
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
        Schema::dropIfExists('products');
    }
};
