<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertNewFieldDiseaseNameItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('items', function (Blueprint $table) {
            
            $table->string('cure_disease_name')->nullable()->after("cure_disease");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('items', function (Blueprint $table) {
            
            $table->string('cure_disease_name')->nullable()->after("cure_disease");
        });
    }
}