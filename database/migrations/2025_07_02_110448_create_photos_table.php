<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->default('');
            $table->string('slug')->default('');
            $table->string('url')->default('');
            $table->text('description')->nullable();

            $table->boolean('is_published')->default(true);
            $table->integer('display_order')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pivot_photo_media', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('photo_id');
            $table->unsignedBigInteger('media_id');
            $table->integer('order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
        Schema::dropIfExists('pivot_photo_media');
    }
};
