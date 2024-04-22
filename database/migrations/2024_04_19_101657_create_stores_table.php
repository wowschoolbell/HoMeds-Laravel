<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name',"200")->nullable();
            $table->string('contact_person_name',"200")->nullable();
            $table->string('phone',"200")->nullable();
            $table->string('mobile_number',"200")->nullable();
            $table->string('email',"200")->unique();
            $table->string('gst_number',"200")->nullable();
            $table->string('drug_licence',"200")->nullable();
            $table->string('address',"200")->nullable();
            $table->string('area',"200")->nullable();
            $table->string('state',"200")->nullable();
            $table->string('city',"200")->nullable();
            $table->string('pincode',"200")->nullable();
            $table->text('store_image')->nullable();
            $table->text('store_logo')->nullable();
            $table->string('bank_name',"200")->nullable();
            $table->string('bank_account_number',"200")->nullable();
            $table->string('ifsc_code',"200")->nullable();
            $table->string('app_status',"200")->nullable();
             $table->enum('status', [
                 'active',
                 'in-active',
                 'hold',
                 'waiting for approval',
                'banned',
                ])->default('waiting for approval');
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
        Schema::dropIfExists('stores');
    }
}
