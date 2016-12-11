<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSolutionsTableAddStatusZr extends Migration
{
    public function up()
    {
        Schema::table('solutions', function (Blueprint $table) {
            \DB::statement("ALTER TABLE solutions DROP COLUMN status;");
            $table->enum('status', ['OK', 'CE', 'FF', 'NC', 'CC', 'CT', 'UE', 'ZR'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solutions', function (Blueprint $table) {
            \DB::statement("ALTER TABLE solutions DROP COLUMN status;");
            $table->enum('status', ['CE', 'FF', 'NC', 'CC', 'CT', 'UE'])->nullable();
        });
    }
}
