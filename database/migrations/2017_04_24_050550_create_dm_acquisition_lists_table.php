<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmAcquisitionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_acquisition_lists', function (Blueprint $table) {
            $table->char('company_name', 150);
            $table->char('company_phone', 15);
            $table->text('company_url')->nullable();
            $table->char('company_mail', 150);
            $table->char('ad_street', 255);
            $table->char('ad_prefectures', 10)->nullable();
            $table->char('ad_municipality', 30)->nullable();
            $table->char('closest_station', 30)->nullable();
            $table->text('industry')->nullable();
            $table->char('establishment_year', 10)->nullable();
            $table->bigInteger('employees_number')->nullable();
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
        Schema::dropIfExists('dm_acquisition_lists');
    }
}
