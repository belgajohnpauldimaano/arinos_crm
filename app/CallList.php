<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CallList extends Model
{

    public static function saveExcelRows($rowData = array())
    {

        $errorRow = "";

        DB::beginTransaction();

        foreach ($rowData as $key => $value) {
            
            //exclude 1st and 2nd row (headers)
            if($key > 2) {

                try {

                    $checkDuplicate = DB::select("select *
                                            from call_lists
                                            where company_name = '".$value[2]."'
                                            and ( company_phone =  '".$value[3]."'
                                                  or company_mail = '".$value[5]."') 
                                            and ad_prefectures = '".$value[7]."'");

                    if(empty($checkDuplicate)){

                        DB::table('call_lists')->insert([
                            'person_charge_name' => $value[1],
                            'company_name' => $value[2],
                            'company_phone' => $value[3],
                            'company_url' => $value[4],
                            'company_mail' => $value[5],
                            'ad_street' => $value[6],
                            'ad_prefectures' => $value[7],
                            'ad_municipality' => $value[8],
                            'closest_station' => $value[9],
                            'industry' => $value[10],
                            'establishment_year' => $value[11], 
                            'employees_number' => $value[12],
                            'br_department_charge' => $value[13],
                            'br_contact_name' => $value[14],
                            'br_1st_call_date' => $value[15],
                            'br_1st_hanging_time' => $value[16],
                            'br_1st_dialogue_content' => $value[17],
                            'br_1st_status' => $value[18],
                            'br_1st_ng_reason' => $value[19],
                            'br_2nd_call_date' => $value[20],
                            'br_2nd_hanging_time' => $value[21],
                            'br_2nd_dialogue_content' => $value[22],
                            'br_2nd_status' => $value[23],
                            'br_2nd_ng_reason' => $value[24],
                            'br_3rd_call_date' => $value[25],
                            'br_3rd_hanging_time' => $value[26],
                            'br_3rd_dialogue_content' => $value[27],
                            'br_3rd_status' => $value[28],
                            'br_3rd_ng_reason' => $value[29],
                            'br_4th_call_date' => $value[30],
                            'br_4th_hanging_time' => $value[31],
                            'br_4th_dialogue_content' => $value[32],
                            'br_4th_status' => $value[33],
                            'br_4th_ng_reason' => $value[34],
                            'br_5th_call_date' => $value[35],
                            'br_5th_hanging_time' => $value[36],
                            'br_5th_dialogue_content' => $value[37],
                            'br_5th_status' => $value[38],
                            'br_5th_ng_reason' => $value[39],
                            'wa_department_charge' => $value[40],
                            'wa_contact_name' => $value[41],
                            'wa_1st_call_date' => $value[42],
                            'wa_1st_hanging_time' => $value[43],
                            'wa_1st_dialogue_content' => $value[44],
                            'wa_1st_status' => $value[45],
                            'wa_1st_ng_reason' => $value[46],
                            'wa_2nd_call_date' => $value[47],
                            'wa_2nd_hanging_time' => $value[48],
                            'wa_2nd_dialogue_content' => $value[49],
                            'wa_2nd_status' => $value[50],
                            'wa_2nd_ng_reason' => $value[51],
                            'wa_3rd_call_date' => $value[52],
                            'wa_3rd_hanging_time' => $value[53],
                            'wa_3rd_dialogue_content' => $value[54],
                            'wa_3rd_status' => $value[55],
                            'wa_3rd_ng_reason' => $value[56],
                            'wa_4th_call_date' => $value[57],
                            'wa_4th_hanging_time' => $value[58],
                            'wa_4th_dialogue_content' => $value[59],
                            'wa_4th_status' => $value[60],
                            'wa_4th_ng_reason' => $value[61],
                            'wa_5th_call_date' => $value[62],
                            'wa_5th_hanging_time' => $value[63],
                            'wa_5th_dialogue_content' => $value[64],
                            'wa_5th_status' => $value[65],
                            'wa_5th_ng_reason' => $value[66],
                            'wa_presence_absence' => $value[67],
                            'dm_sending_times' => $value[68],
                            'sm_presence_absence' => $value[69],
                            'sm_type' => $value[70],
                            'ji_presence_absence' => $value[71],
                            'talk_classification' => $value[72],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }

                } catch (\Exception $e) {
                    DB::rollback();
                    //throw $e;
                    $errorRow = $key;
                    return $errorRow;
                } 

            }



        }

        DB::commit();
                     
        return $errorRow;
    }

}
