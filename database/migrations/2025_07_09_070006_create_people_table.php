<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->default('');
            $table->string('slug')->default('');
            $table->string('title')->default('');
            $table->string('tagline')->default('');
            $table->string('email')->default('');
            $table->string('phone')->default('');
            $table->text('bio')->nullable();
            $table->string('sidebar', 1000)->default('');
            $table->boolean('is_published')->default(true);

            $table->integer('display_order')->default(0);
            $table->unsignedBigInteger('avatar_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
