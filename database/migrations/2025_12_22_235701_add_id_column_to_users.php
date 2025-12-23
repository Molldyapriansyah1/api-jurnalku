<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add id column (auto-increment, primary key)
            $table->id()->first();
        });
        
        // Copy id_user values to id
        DB::statement('UPDATE users SET id = id_user');
        
        // Optional: Drop id_user if you don't need it anymore
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropColumn('id_user');
        // });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};