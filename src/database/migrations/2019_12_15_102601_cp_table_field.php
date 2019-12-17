<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CpTableField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_table_fields', function (Blueprint $table) {
            $table->bigIncrements('TableFieldId');
            $table->bigInteger('TableFieldMigrationId');
            $table->string('TableFieldName');
            $table->string('TableFieldType');
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
        Schema::dropIfExists('cp_table_fields');
    }
}
