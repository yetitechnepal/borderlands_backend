<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHotdealsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->boolean('hotdeals');
            $table->boolean('featured');
            $table->boolean('mostpopular');
            $table->boolean('topdeals');
            $table->boolean('highlights');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('hotdeals');
            $table->dropColumn('featured');
            $table->dropColumn('mostpopular');
            $table->dropColumn('topdeals');
            $table->dropColumn('highlights');
        });
    }
}
