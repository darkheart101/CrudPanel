<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CpMigrationFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_migration_files', function (Blueprint $table) {
            $table->bigIncrements('MigrationFileId');
            $table->string('MigrationFileName');
            $table->string('MigrationTable');
            $table->bigInteger('MigrationModelId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cp_migration_files');
    }
}
