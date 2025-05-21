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
        Schema::create('tenants', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('boarding_house_id')->nullable();
    $table->string('name');
    $table->string('contact_number');
    $table->string('status')->default('Pending');
    $table->text('notes')->nullable();
    $table->decimal('due_amount', 10, 2)->default(0);
    $table->string('room_number')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('boarding_house_id')->references('id')->on('boarding_houses')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
