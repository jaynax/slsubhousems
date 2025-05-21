<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardingHousesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boarding_houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK to users 
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->integer('capacity')->default(0);
            $table->timestamps();

            // Foreign key constraint to users table
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Delete BHs if user is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
}
