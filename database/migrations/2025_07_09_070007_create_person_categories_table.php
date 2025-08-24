<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->default('');
            $table->integer('parent_id')->default(-1);
            $table->integer('weight')->default(0);
            $table->softDeletes();

            $table->index(['weight'], 'idx_weight');
            $table->timestamps();
        });

        Schema::create('pivot_person_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('people_id');
            $table->unsignedInteger('category_id');

            $table->index('people_id');
            $table->index('category_id');
            $table->unique(['people_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_categories');
        Schema::dropIfExists('pivot_person_categories');
    }
};
