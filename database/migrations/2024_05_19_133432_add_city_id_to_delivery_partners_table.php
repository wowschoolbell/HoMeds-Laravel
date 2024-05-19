<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToDeliveryPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_partners', function (Blueprint $table) {
            $table->dropColumn(['bank_account_number', 'area', 'city', 'state', 'pincode', 'aadhar_image', 'driving_licence_image']);

            $table->unsignedBigInteger('city_id')->nullable()->after('app_statuses_id');
            $table->string('aadhar_front_image')->nullable()->after('aadhar');
            $table->string('aadhar_back_image')->nullable()->after('aadhar_front_image');

            $table->string('driving_licence_front_image')->nullable()->after('driving_licence');
            $table->string('driving_licence_back_image')->nullable()->after('driving_licence_front_image');
        
            $table->string('pan')->nullable()->after('driving_licence_back_image');
            $table->string('pan_image')->nullable()->after('pan');
            $table->string('gender')->nullable()->after('last_name');

            $table->text('bank_acc_number')->nullable()->after('bank_name');
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
            $table->dropColumn(['bank_acc_number', 'city_id', 'aadhar_front_image', 'aadhar_back_image', 'driving_licence_front_image',
                'driving_licence_back_image', 'pan', 'gender', 'pan_image']);

            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('driving_licence_image')->nullable();
            $table->string('aadhar_image')->nullable();
            $table->string('bank_account_number')->nullable()->after('bank_name');

        });
    }
}
