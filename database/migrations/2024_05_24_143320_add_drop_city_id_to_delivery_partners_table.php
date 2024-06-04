<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDropCityIdToDeliveryPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_partners', function (Blueprint $table) {
            $table->dropColumn(['area_mapping_state', 'area_mapping_area', 'area_mapping_city', 'area_mapping_pincode']);

            $table->text('drop_city_id')->nullable()->after('city_id');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['area', 'city', 'state', 'pincode']);
            $table->unsignedBigInteger('city_id')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_partners', function (Blueprint $table) {
            $table->dropColumn(['drop_city_id']);

            $table->string('area_mapping_area')->nullable();
            $table->string('area_mapping_city')->nullable();
            $table->string('area_mapping_state')->nullable();
            $table->string('area_mapping_pincode')->nullable();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->string('area')->nullable()->after('address');
            $table->string('city')->nullable()->after('area');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');

            $table->dropColumn(['city_id']);
        });
    }
}
