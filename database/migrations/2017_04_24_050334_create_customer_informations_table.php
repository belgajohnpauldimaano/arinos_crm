char<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_informations', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->integer('customer_id')->unsigned();// primary_key
            $table->date('entry_date');
            $table->date('update_date');
            $table->char('person_charge_name', 50)->nullable();
            $table->char('company_name', 150);
            $table->char('company_phone', 15);
            $table->text('company_url')->nullable();
            $table->char('company_mail', 150);
            $table->char('ad_street', 255);
            $table->char('ad_prefectures', 10)->nullable();
            $table->char('ad_municipality', 30)->nullable();
            $table->char('closest_station', 30)->nullable();
            $table->text('industry')->nullable();
            $table->integer('establishment_year')->nullable();
            $table->bigInteger('employees_number')->nullable();

            $table->char('br_department_charge', 50)->nullable();
            $table->char('br_contact_name', 50)->nullable();
            $table->char('br_1st_call_date', 15)->nullable();
            $table->char('br_1st_hanging_time', 15)->nullable();
            $table->char('br_1st_dialogue_content', 255)->nullable();
            $table->char('br_1st_status', 30)->nullable();
            $table->char('br_1st_ng_reason', 50)->nullable();
            //
            $table->char('br_2nd_call_date', 15)->nullable();
            $table->char('br_2nd_hanging_time', 15)->nullable();
            $table->char('br_2nd_dialogue_content', 255)->nullable();
            $table->char('br_2nd_status', 30)->nullable();
            $table->char('br_2nd_ng_reason', 50)->nullable();
            //
            $table->char('br_3rd_call_date', 15)->nullable();
            $table->char('br_3rd_hanging_time', 15)->nullable();
            $table->char('br_3rd_dialogue_content', 255)->nullable();
            $table->char('br_3rd_status', 30)->nullable();
            $table->char('br_3rd_ng_reason', 50)->nullable();
            //
            $table->char('br_4th_call_date', 15)->nullable();
            $table->char('br_4th_hanging_time', 15)->nullable();
            $table->char('br_4th_dialogue_content', 255)->nullable();
            $table->char('br_4th_status', 30)->nullable();
            $table->char('br_4th_ng_reason', 50)->nullable();
            //
            $table->char('br_5th_call_date', 15)->nullable();
            $table->char('br_5th_hanging_time', 15)->nullable();
            $table->char('br_5th_dialogue_content', 255)->nullable();
            $table->char('br_5th_status', 30)->nullable();
            $table->char('br_5th_ng_reason', 50)->nullable();
            //

            $table->char('wa_department_charge', 50)->nullable();
            $table->char('wa_contact_name', 50)->nullable();
            $table->char('wa_1st_call_date', 15)->nullable();
            $table->char('wa_1st_hanging_time', 15)->nullable();
            $table->char('wa_1st_dialogue_content', 255)->nullable();
            $table->char('wa_1st_status', 30)->nullable();
            $table->char('wa_1st_ng_reason', 50)->nullable();
            //
            $table->char('wa_2nd_call_date', 15)->nullable();
            $table->char('wa_2nd_hanging_time', 15)->nullable();
            $table->char('wa_2nd_dialogue_content', 255)->nullable();
            $table->char('wa_2nd_status', 30)->nullable();
            $table->char('wa_2nd_ng_reason', 50)->nullable();
            //
            $table->char('wa_3rd_call_date', 15)->nullable();
            $table->char('wa_3rd_hanging_time', 15)->nullable();
            $table->char('wa_3rd_dialogue_content', 255)->nullable();
            $table->char('wa_3rd_status', 30)->nullable();
            $table->char('wa_3rd_ng_reason', 50)->nullable();
            //
            $table->char('wa_4th_call_date', 15)->nullable();
            $table->char('wa_4th_hanging_time', 15)->nullable();
            $table->char('wa_4th_dialogue_content', 255)->nullable();
            $table->char('wa_4th_status', 30)->nullable();
            $table->char('wa_4th_ng_reason', 50)->nullable();
            //
            $table->char('wa_5th_call_date', 15)->nullable();
            $table->char('wa_5th_hanging_time', 15)->nullable();
            $table->char('wa_5th_dialogue_content', 255)->nullable();
            $table->char('wa_5th_status', 30)->nullable();
            $table->char('wa_5th_ng_reason', 50)->nullable();
            //
            $table->integer('wa_presence_absence');//value: 0 or 1
            $table->bigInteger('dm_sending_times');
            $table->integer('sm_presence_absence');//value: 0 or 1
            $table->char('sm_type', 255)->nullable();
            $table->integer('ji_presence_absence');//value: 0 or 1
            $table->char('talk_classification', 255)->nullable();
            $table->char('company_name_id');
            $table->integer('ng_flag');//value: 0 or 1
            $table->char('ng_reason', 255)->nullable();
            $table->char('transaction_contents', 255)->nullable();
            $table->integer('capture_status');

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
        Schema::dropIfExists('customer_informations');
    }
}
