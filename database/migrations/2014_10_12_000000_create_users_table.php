<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('workspace_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->boolean('is_email_verified')->default(true);
            $table->string('email_verification_token')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('password_reset_key')->nullable()->unique();
            $table->string('mobile_number')->nullable()->unique();
            $table->string('twitter')->nullable()->unique();
            $table->string('facebook')->nullable()->unique();
            $table->string('linkedin')->nullable()->unique();
            $table->string('address_1')->nullable()->unique();
            $table->string('address_2')->nullable()->unique();
            $table->string('zip')->nullable()->unique();
            $table->string('city')->nullable()->unique();
            $table->string('state')->nullable()->unique();
            $table->string('country')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('language')->nullable();
            $table->string('photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->boolean('super_admin')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
