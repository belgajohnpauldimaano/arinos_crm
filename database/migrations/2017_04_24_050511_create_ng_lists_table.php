<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ng_lists', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->date('entry_date');
            $table->date('update_date');
            $table->char('company_name', 150);
            $table->char('company_phone', 15);
            $table->char('company_mail', 150);
            $table->char('ad_street', 255);
            $table->char('ad_prefectures', 10);
            $table->char('ad_municipality', 30);
            $table->char('industry', 255);
            $table->char('ng_reason', 255);
            $table->char('transaction_contents', 255);
            $table->integer('name_id_flag'); //value 0 or 1
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
        Schema::dropIfExists('ng_lists');
    }
}
