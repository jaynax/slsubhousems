<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change the status column to enum with the specific allowed values
        Schema::table('tenants', function (Blueprint $table) {
            $table->enum('status', ['Denied', 'Pending', 'Approved'])->default('Pending')->change();
        });
    }

    public function down(): void
    {
        // In case you wanna rollback, change it back to string
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('status')->default('Pending')->change();
        });
    }
};
