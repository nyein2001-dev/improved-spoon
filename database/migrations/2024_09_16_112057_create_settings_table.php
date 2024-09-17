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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('maintenance_mode')->default(0);
            $table->string('logo')->nullable();
            $table->string('logo_two')->nullable();
            $table->string('logo_three')->nullable();
            $table->string('favicon')->nullable();
            $table->string('contact_email', 191)->nullable();
            $table->integer('enable_subscription_notify')->default(1);
            $table->integer('enable_save_contact_message')->default(1);
            $table->string('text_direction')->default('LTR');
            $table->string('timezone')->nullable();
            $table->string('sidebar_lg_header')->nullable();
            $table->string('sidebar_sm_header')->nullable();
            $table->string('topbar_phone', 191)->nullable();
            $table->string('topbar_email', 191);
            $table->string('topbar_address')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('currency_name', 191)->nullable();
            $table->string('currency_icon', 191)->nullable();
            $table->double('currency_rate', 8, 2)->default(1);
            $table->string('theme_one', 191);
            $table->string('subscriber_image')->nullable();
            $table->string('subscription_bg')->nullable();
            $table->string('home2_subscription_bg')->nullable();
            $table->string('home3_subscription_bg')->nullable();
            $table->string('blog_page_subscription_image')->nullable();
            $table->string('default_avatar')->nullable();
            $table->string('home2_contact_foreground')->nullable();
            $table->string('home2_contact_background')->nullable();
            $table->string('home2_contact_call_as')->nullable();
            $table->string('home2_contact_phone')->nullable();
            $table->string('home2_contact_available')->nullable();
            $table->string('home2_contact_form_title')->nullable();
            $table->text('home2_contact_form_description')->nullable();
            $table->string('how_it_work_background')->nullable();
            $table->string('how_it_work_foreground')->nullable();
            $table->string('how_it_work_title')->nullable();
            $table->text('how_it_work_description')->nullable();
            $table->text('how_it_work_items')->nullable();
            $table->integer('selected_theme')->default(0);
            $table->integer('blog_left_right')->default(0);
            $table->string('theme_one_color')->nullable();
            $table->string('theme_two_color')->nullable();
            $table->string('theme_three_color')->nullable();
            $table->string('login_image')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('footer_logo_two')->nullable();
            $table->string('footer_logo_three')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('app_version')->default('1.1');
            $table->string('commission_type')->default('commission');
            $table->string('frontend_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
