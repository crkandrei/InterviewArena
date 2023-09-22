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
        Schema::create('tokens_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Name of the token package');
            $table->integer('token_count')->comment('Number of tokens in the package');
            $table->decimal('cost', 8, 2)->comment('Cost of the token package');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens_packages');
    }
};
