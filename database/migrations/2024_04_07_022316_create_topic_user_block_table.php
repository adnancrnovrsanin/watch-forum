<?php

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
        Schema::create('topic_user_block', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Topic::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_user_block');
    }
};
