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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('membership_id');
            $table->string('membership_name');
            $table->string('plan')->nullable();
            $table->string('currency')->nullable();
            $table->text('description')->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->text('cover_image')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
