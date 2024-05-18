<?php

use App\Models\AppStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('app_status');
            $table->dropColumn('status');

            $table->unsignedBigInteger('user_id')->after('id');
            $table->unsignedBigInteger('app_status_id')->nullable()->after('ifsc_code');
            $table->unsignedBigInteger('status_id')->nullable()->after('ifsc_code');
        });

        Schema::table('app_statuses', function (Blueprint $table) {
            $table->string('type')->nullable()->after('id');
        });

        AppStatus::where('name', '!=', NULL)
            ->update(['type' => AppStatus::STATUS]);

        $appStatus          = new AppStatus();
        $appStatus->type    = AppStatus::APP_STATUS;
        $appStatus->name    = 'HoMeds';
        $appStatus->save();

        $appStatus          = new AppStatus();
        $appStatus->type    = AppStatus::APP_STATUS;
        $appStatus->name    = 'White Label';
        $appStatus->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('app_status_id');
            $table->dropColumn('status_id');
            $table->dropColumn('user_id');

            $table->string('email',"200")->unique();
            $table->string('app_status',"200")->nullable();
            $table->enum('status', [
                 'active',
                 'in-active',
                 'hold',
                 'waiting for approval',
                'banned',
                ])->default('waiting for approval');
        });

        Schema::table('app_statuses', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        AppStatus::whereIn('name', ['HoMeds', 'White Label'])->delete();
    }
}
