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
Schema::create('campaigns', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users');

    $table->date('date_start');
    $table->date('date_end')->nullable();
    $table->string('title');
    $table->string('country');
    $table->text('description')->nullable();
    $table->string('image')->nullable();
    $table->decimal('goal', 10, 2);
    $table->decimal('goal_current', 10, 2)->default(0);
    $table->boolean('is_large')->default(false);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
