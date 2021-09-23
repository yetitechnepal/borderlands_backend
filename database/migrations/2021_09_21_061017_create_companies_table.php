<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('bannerImage',500);
            $table->string('bannerImage2',500);
            $table->string('companyName');
            $table->string('companyAbout',2000);
            $table->string('companyStar');
            $table->string('companyAddress');
            $table->string('companyPhone1');
            $table->string('companyPhone2');
            $table->string('companyEmail');
            $table->string('lat');
            $table->string('lon');
            $table->string('websiteURL',1000);
            $table->string('facebookURL',1000);
            $table->string('instaURL',1000);
            $table->string('URL1',1000);
            $table->string('URL2',1000);
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
        Schema::dropIfExists('companies');
    }
}
