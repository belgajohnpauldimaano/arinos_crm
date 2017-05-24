<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_lists', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->char('person_charge_name',50);
            $table->char('company_name',150);
            $table->char('company_phone',15);
            $table->char('company_url',150);
            $table->char('company_mail',150);
            $table->char('ad_street',255);
            $table->char('ad_prefectures',10);
            $table->char('ad_municipality',30);
            $table->char('closest_station',30);
            $table->char('industry',255);
            $table->char('establishment_year',10);
            $table->bigInteger('employees_number');

            $table->char('br_department_charge', 50);
            $table->char('br_contact_name', 50);
            $table->char('br_1st_call_date', 15);
            $table->char('br_1st_hanging_time', 15);
            $table->char('br_1st_dialogue_content', 255);
            $table->char('br_1st_status', 30);
            $table->char('br_1st_ng_reason', 50);
            //
            $table->char('br_2nd_call_date', 15);
            $table->char('br_2nd_hanging_time', 15);
            $table->char('br_2nd_dialogue_content', 255);
            $table->char('br_2nd_status', 30);
            $table->char('br_2nd_ng_reason', 50);
            //
            $table->char('br_3rd_call_date', 15);
            $table->char('br_3rd_hanging_time', 15);
            $table->char('br_3rd_dialogue_content', 255);
            $table->char('br_3rd_status', 30);
            $table->char('br_3rd_ng_reason', 50);
            //
            $table->char('br_4th_call_date', 15);
            $table->char('br_4th_hanging_time', 15);
            $table->char('br_4th_dialogue_content', 255);
            $table->char('br_4th_status', 30);
            $table->char('br_4th_ng_reason', 50);
            //
            $table->char('br_5th_call_date', 15);
            $table->char('br_5th_hanging_time', 15);
            $table->char('br_5th_dialogue_content', 255);
            $table->char('br_5th_status', 30);
            $table->char('br_5th_ng_reason', 50);
            //

            $table->char('wa_department_charge', 50);
            $table->char('wa_contact_name', 50);
            $table->char('wa_1st_call_date', 15);
            $table->char('wa_1st_hanging_time', 15);
            $table->char('wa_1st_dialogue_content', 255);
            $table->char('wa_1st_status', 30);
            $table->char('wa_1st_ng_reason', 50);
            //
            $table->char('wa_2nd_call_date', 15);
            $table->char('wa_2nd_hanging_time', 15);
            $table->char('wa_2nd_dialogue_content', 255);
            $table->char('wa_2nd_status', 30);
            $table->char('wa_2nd_ng_reason', 50);
            //
            $table->char('wa_3rd_call_date', 15);
            $table->char('wa_3rd_hanging_time', 15);
            $table->char('wa_3rd_dialogue_content', 255);
            $table->char('wa_3rd_status', 30);
            $table->char('wa_3rd_ng_reason', 50);
            //
            $table->char('wa_4th_call_date', 15);
            $table->char('wa_4th_hanging_time', 15);
            $table->char('wa_4th_dialogue_content', 255);
            $table->char('wa_4th_status', 30);
            $table->char('wa_4th_ng_reason', 50);
            //
            $table->char('wa_5th_call_date', 15);
            $table->char('wa_5th_hanging_time', 15);
            $table->char('wa_5th_dialogue_content', 255);
            $table->char('wa_5th_status', 30);
            $table->char('wa_5th_ng_reason', 50);
            //
            $table->integer('wa_presence_absence');//value: 0 or 1
            $table->integer('dm_sending_times');//value: 0 or 1
            $table->integer('sm_presence_absence');//value: 0 or 1
            $table->char('sm_type', 255);
            $table->integer('ji_presence_absence');//value: 0 or 1
            $table->char('talk_classification', 255);

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
        Schema::dropIfExists('call_lists');
    }
}
