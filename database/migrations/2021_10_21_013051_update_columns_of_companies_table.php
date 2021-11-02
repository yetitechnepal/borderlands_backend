<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsOfCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('bannerImage',500)->nullable()->change();
            $table->string('bannerImage2',500)->nullable()->change();
            $table->string('companyName')->nullable()->change();
            $table->string('companyAbout',2000)->nullable()->change();
            $table->string('companyStar')->nullable()->change();
            $table->string('companyAddress')->nullable()->change();
            $table->string('companyPhone1')->nullable()->change();
            $table->string('companyPhone2')->nullable()->change();
            $table->string('companyEmail')->nullable()->change();
            $table->string('lat')->nullable()->change();
            $table->string('lon')->nullable()->change();
            $table->string('websiteURL',1000)->nullable()->change();
            $table->string('facebookURL',1000)->nullable()->change();
            $table->string('instaURL',1000)->nullable()->change();
            $table->string('URL1',1000)->nullable()->change();
            $table->string('URL2',1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
