<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_partners', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('app_statuses_id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('photo')->nullable();
            $table->integer('phone');
            $table->string('aadhar')->nullable();
            $table->string('aadhar_image')->nullable();
            $table->string('driving_licence')->nullable();
            $table->string('driving_licence_image')->nullable();
            $table->text('address')->nullable();
            $table->text('area')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('area_mapping_state')->nullable();
            $table->string('area_mapping_area')->nullable();
            $table->string('area_mapping_city')->nullable();
            $table->string('area_mapping_pincode')->nullable();
        });


        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_partners');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
}
