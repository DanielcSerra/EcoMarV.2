<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sponsors_signups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('sponsors_categories');

            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->enum('status', ['R', 'A', 'P'])->default('P'); // R: Rejeitado, A: Aprovado, P: Pendente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors_signups');
    }
};
