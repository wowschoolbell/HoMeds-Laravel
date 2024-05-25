<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertNewFieldStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('stores', function (Blueprint $table) {
            $table->string('plan_id')->nullable()->after('app_status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('stores', function (Blueprint $table) {
            $table->string('plan_id')->nullable()->after('app_status_id');
        });
    }
}
