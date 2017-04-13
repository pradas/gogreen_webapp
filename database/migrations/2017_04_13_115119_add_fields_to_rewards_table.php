<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->text('description');
            $table->text('exchange_info');
            $table->string('contact_web');
            $table->text('contact_info');
            $table->float('exchange_latitude')->nullable();
            $table->float('exchange_longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('exchange_info');
            $table->dropColumn('contact_web');
            $table->dropColumn('contact_info');
            $table->dropColumn('exchange_latitude');
            $table->dropColumn('exchange_longitude');
        });
    }
}
