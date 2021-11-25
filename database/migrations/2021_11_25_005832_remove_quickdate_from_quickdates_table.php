<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQuickdateFromQuickdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quickdates', function (Blueprint $table) {
            $table->dropColumn('quickdate');
            $table->dropColumn('days');
            $table->dateTime('stdate')->nullable();
            $table->dateTime('enddate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quickdates', function (Blueprint $table) {
            $table->string('quickdate',500);
            $table->string('days',500);
            $table->dropColumn('stdate');
            $table->dropColumn('enddate');
        });
    }
}
