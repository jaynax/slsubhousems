<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('boarding_houses', function (Blueprint $table) {
        $table->string('name')->after('user_id');
        $table->text('description')->nullable()->after('name');
        $table->string('location')->after('description');
        $table->integer('capacity')->default(0)->after('location');
        $table->string('contact_number')->nullable()->after('capacity');
    });
}

public function down()
{
    Schema::table('boarding_houses', function (Blueprint $table) {
        $table->dropColumn(['name', 'description', 'location', 'capacity', 'contact_number']);
    });
}

};
