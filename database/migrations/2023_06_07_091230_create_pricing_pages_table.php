<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('admin_id')->default(0);
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('testimonial_image')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->string('testimonial_subtitle')->nullable();
            $table->string('testimonial_author')->nullable();
            $table->string('testimonial_paragraph')->nullable();
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
        Schema::dropIfExists('pricing_pages');
    }
}
