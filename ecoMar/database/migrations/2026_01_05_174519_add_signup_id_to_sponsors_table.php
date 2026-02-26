<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->unsignedBigInteger('signup_id')->nullable()->after('id');
            $table->foreign('signup_id')->references('id')->on('sponsor_signups')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropForeign(['signup_id']);
            $table->dropColumn('signup_id');
        });
    }
};
