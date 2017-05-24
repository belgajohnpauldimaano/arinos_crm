<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\CallList;
use App\CustomerIdManagement;
use App\DmAcquisitionList;


class CustomerInformation extends Model
{
    protected $primaryKey = 'customer_id';
    public $incrementing = false;

    public static function saveFromCallListTable()
    {
        $callListAll = CallList::all();

        foreach($callListAll as $key => $callList){

            //check for duplicate

            if($callList->ad_prefectures) {
                $search_ad_prefectures = " = '".$callList->ad_prefectures."'";
            } else {
                $search_ad_prefectures = 'is null';
            }

            $checkDuplicate = DB::select("select *
                                    from customer_informations
                                    where company_name = '".$callList->company_name."'
                                    and ( company_phone =  '".$callList->company_phone."'
                                          or company_mail = '".$callList->company_mail."') 
                                    and ad_prefectures ".$search_ad_prefectures."");

            if($checkDuplicate){
                
                //duplicate
                $ci = CustomerInformation::where('customer_id', $checkDuplicate[0]->customer_id)->first();

            } else {
                 
                //no duplicate
                $ci = new CustomerInformation();

                $ci->customer_id = CustomerIdManagement::update_customer_id();
                $ci->entry_date = date('Y-m-d');
                $ci->company_name_id = self::create_company_name_id($callList->company_name);
                $ci->ng_flag = 0;                 
                $ci->ng_reason = null;              
                $ci->transaction_contents = null;

            }

            $ci->update_date = date('Y-m-d');
            $ci->person_charge_name = $callList->person_charge_name; 
            $ci->company_name = $callList->company_name;
            $ci->company_phone = $callList->company_phone;
            $ci->company_url = $callList->company_url;
            $ci->company_mail = $callList->company_mail;
            $ci->ad_street = $callList->ad_street;
            $ci->ad_prefectures = $callList->ad_prefectures;
            $ci->ad_municipality = $callList->ad_municipality;
            $ci->closest_station = $callList->closest_station;
            $ci->industry = $callList->industry;
            $ci->establishment_year = $callList->establishment_year; 
            $ci->employees_number = $callList->employees_number;
            $ci->br_department_charge = $callList->br_department_charge;
            $ci->br_contact_name = $callList->br_contact_name;
            $ci->br_1st_call_date = $callList->br_1st_call_date;
            $ci->br_1st_hanging_time = $callList->br_1st_hanging_time;
            $ci->br_1st_dialogue_content = $callList->br_1st_dialogue_content;
            $ci->br_1st_status = $callList->br_1st_status;
            $ci->br_1st_ng_reason = $callList->br_1st_ng_reason;
            $ci->br_2nd_call_date = $callList->br_2nd_call_date;
            $ci->br_2nd_hanging_time = $callList->br_2nd_hanging_time;
            $ci->br_2nd_dialogue_content = $callList->br_2nd_dialogue_content;
            $ci->br_2nd_status = $callList->br_2nd_status;
            $ci->br_2nd_ng_reason = $callList->br_2nd_ng_reason;
            $ci->br_3rd_call_date = $callList->br_3rd_call_date;
            $ci->br_3rd_hanging_time = $callList->br_3rd_hanging_time;
            $ci->br_3rd_dialogue_content = $callList->br_3rd_dialogue_content;
            $ci->br_3rd_status = $callList->br_3rd_status;
            $ci->br_3rd_ng_reason = $callList->br_3rd_ng_reason;
            $ci->br_4th_call_date = $callList->br_4th_call_date;
            $ci->br_4th_hanging_time = $callList->br_4th_hanging_time;
            $ci->br_4th_dialogue_content = $callList->br_4th_dialogue_content;
            $ci->br_4th_status = $callList->br_4th_status;
            $ci->br_4th_ng_reason = $callList->br_4th_ng_reason;
            $ci->br_5th_call_date = $callList->br_5th_call_date;
            $ci->br_5th_hanging_time = $callList->br_5th_hanging_time;
            $ci->br_5th_dialogue_content = $callList->br_5th_dialogue_content;
            $ci->br_5th_status = $callList->br_5th_status;
            $ci->br_5th_ng_reason = $callList->br_5th_ng_reason;
            $ci->wa_department_charge = $callList->wa_department_charge;
            $ci->wa_contact_name = $callList->wa_contact_name;
            $ci->wa_1st_call_date = $callList->wa_1st_call_date;
            $ci->wa_1st_hanging_time = $callList->wa_1st_hanging_time;
            $ci->wa_1st_dialogue_content = $callList->wa_1st_dialogue_content;
            $ci->wa_1st_status = $callList->wa_1st_status;
            $ci->wa_1st_ng_reason = $callList->wa_1st_ng_reason;
            $ci->wa_2nd_call_date = $callList->wa_2nd_call_date;
            $ci->wa_2nd_hanging_time = $callList->wa_2nd_hanging_time;
            $ci->wa_2nd_dialogue_content = $callList->wa_2nd_dialogue_content;
            $ci->wa_2nd_status = $callList->wa_2nd_status;
            $ci->wa_2nd_ng_reason = $callList->wa_2nd_ng_reason;
            $ci->wa_3rd_call_date = $callList->wa_3rd_call_date;
            $ci->wa_3rd_hanging_time = $callList->wa_3rd_hanging_time;
            $ci->wa_3rd_dialogue_content = $callList->wa_3rd_dialogue_content;
            $ci->wa_3rd_status = $callList->wa_3rd_status;
            $ci->wa_3rd_ng_reason = $callList->wa_3rd_ng_reason;
            $ci->wa_4th_call_date = $callList->wa_4th_call_date;
            $ci->wa_4th_hanging_time = $callList->wa_4th_hanging_time;
            $ci->wa_4th_dialogue_content = $callList->wa_4th_dialogue_content;
            $ci->wa_4th_status = $callList->wa_4th_status;
            $ci->wa_4th_ng_reason = $callList->wa_4th_ng_reason;
            $ci->wa_5th_call_date = $callList->wa_5th_call_date;
            $ci->wa_5th_hanging_time = $callList->wa_5th_hanging_time;
            $ci->wa_5th_dialogue_content = $callList->wa_5th_dialogue_content;
            $ci->wa_5th_status = $callList->wa_5th_status;
            $ci->wa_5th_ng_reason = $callList->wa_5th_ng_reason;
            $ci->wa_presence_absence = $callList->wa_presence_absence;
            $ci->dm_sending_times = $callList->dm_sending_times;
            $ci->sm_presence_absence = $callList->sm_presence_absence;
            $ci->sm_type = $callList->sm_type;
            $ci->ji_presence_absence = $callList->ji_presence_absence;
            $ci->talk_classification = $callList->talk_classification;
            $ci->capture_status = 0;
            $ci->save();

        }

        //truncate call list table
        CallList::truncate();

    }


    public static function create_company_name_id($company_name = null) {

        $company_name_id = "";

        $company_form = array('株式会社',
                            '有限会社', 
                            '合名会社',    
                            '合資会社',    
                            '合同会社',
                            '財団法人',
                            '独立行政法人', 
                            '一般財団法人', 
                            '一般社団法人', 
                            '公益社団法人', 
                            '公益財団法人', 
                            '国立大学法人', 
                            '公立大学法人', 
                            '学校法人',    
                            '医療法人',    
                            '行政書士法人', 
                            '司法書士法人', 
                            '社会福祉法人', 
                            '商工会議所',   
                            '税理士法人',   
                            '特定非営利活動法人',
                            '弁護士法人',
                            '（株）', 
                            '（有）', 
                            '（名）', 
                            '（資）', 
                            '（同）', 
                            '（財）', 
                            '（独）', 
                            '（一財）', 
                            '（一社）', 
                            '（公社）', 
                            '（公財）', 
                            '（国法）', 
                            '（大）', 
                            '（学）', 
                            '（医）', 
                            '（行）', 
                            '（司）', 
                            '（福）', 
                            '（商工）', 
                            '（税）', 
                            '（特非）', 
                            '（弁）', 
                            '㈱', 
                            '㈲',  
                            '㈴',   
                            '㈾',   
                            '㈶',  
                            '㈻');  

        $company_name_id = str_replace($company_form, "", $company_name);
        $company_name_id = str_replace(" ", "", $company_name_id);

        return $company_name_id;
    }

    public static function saveFromDmAcquisitionList($duplicate_ctr = 0)
    {
        $duplicate = array();
        $duplicate_ctr = $duplicate_ctr++;
        
        $dmAcquisitionAll = DmAcquisitionList::all();

        foreach($dmAcquisitionAll as $key => $dmAcquisition){

            //check for duplicate

            if($dmAcquisition->ad_prefectures) {
                $search_ad_prefectures = " = '".$dmAcquisition->ad_prefectures."'";
            } else {
                $search_ad_prefectures = 'is null';
            }

            $checkDuplicate = DB::select("select *
                                    from customer_informations
                                    where company_name = '".$dmAcquisition->company_name."'
                                    and ( company_phone =  '".$dmAcquisition->company_phone."'
                                          or company_mail = '".$dmAcquisition->company_mail."') 
                                    and ad_prefectures ".$search_ad_prefectures."");

            if($checkDuplicate) {

                //duplicate         
                $attributes = $dmAcquisition->getAttributes();                     

                $duplicate[$duplicate_ctr]['company_name'] = $attributes['company_name'];
                $duplicate[$duplicate_ctr]['company_phone'] = $attributes['company_phone'];
                $duplicate[$duplicate_ctr]['company_url'] = $attributes['company_url'];
                $duplicate[$duplicate_ctr]['company_mail'] = $attributes['company_mail'];
                $duplicate[$duplicate_ctr]['ad_street'] = $attributes['ad_street'];
                $duplicate[$duplicate_ctr]['ad_prefectures'] = $attributes['ad_prefectures'];
                $duplicate[$duplicate_ctr]['ad_municipality'] = $attributes['ad_municipality'];
                $duplicate[$duplicate_ctr]['closest_station'] = $attributes['closest_station'];
                $duplicate[$duplicate_ctr]['industry'] = $attributes['industry'];
                $duplicate[$duplicate_ctr]['establishment_year'] = $attributes['establishment_year'];
                $duplicate[$duplicate_ctr]['employees_number'] = $attributes['employees_number'];

                $duplicate_ctr++;

            } else {
                 
                //no duplicate
                $dm = new CustomerInformation();

                $dm->customer_id = CustomerIdManagement::update_customer_id();
                $dm->entry_date = date('Y-m-d');
                $dm->update_date = date('Y-m-d');
                $dm->person_charge_name = null;
                $dm->company_name = $dmAcquisition->company_name;
                $dm->company_phone = $dmAcquisition->company_phone;
                $dm->company_url = $dmAcquisition->company_url;
                $dm->company_mail = $dmAcquisition->company_mail;
                $dm->ad_street = $dmAcquisition->ad_street;
                $dm->ad_prefectures = $dmAcquisition->ad_prefectures;
                $dm->ad_municipality = $dmAcquisition->ad_municipality;
                $dm->closest_station = $dmAcquisition->closest_station;
                $dm->industry = $dmAcquisition->industry;
                $dm->establishment_year = $dmAcquisition->establishment_year; 
                $dm->employees_number = $dmAcquisition->employees_number;
                $dm->br_department_charge = null;
                $dm->br_contact_name = null;
                $dm->br_1st_call_date = null;
                $dm->br_1st_hanging_time = null;
                $dm->br_1st_dialogue_content = null; 
                $dm->br_1st_status = null;
                $dm->br_1st_ng_reason = null;
                $dm->br_2nd_call_date = null;
                $dm->br_2nd_hanging_time = null;
                $dm->br_2nd_dialogue_content = null;
                $dm->br_2nd_status = null;
                $dm->br_2nd_ng_reason = null;
                $dm->br_3rd_call_date = null;
                $dm->br_3rd_hanging_time = null;
                $dm->br_3rd_dialogue_content = null; 
                $dm->br_3rd_status = null;
                $dm->br_3rd_ng_reason = null;
                $dm->br_4th_call_date = null;
                $dm->br_4th_hanging_time = null;
                $dm->br_4th_dialogue_content = null; 
                $dm->br_4th_status = null;
                $dm->br_4th_ng_reason = null;
                $dm->br_5th_call_date = null;
                $dm->br_5th_hanging_time = null;
                $dm->br_5th_dialogue_content = null; 
                $dm->br_5th_status = null; 
                $dm->br_5th_ng_reason = null; 
                $dm->wa_department_charge = null; 
                $dm->wa_contact_name = null; 
                $dm->wa_1st_call_date = null; 
                $dm->wa_1st_hanging_time = null; 
                $dm->wa_1st_dialogue_content = null;  
                $dm->wa_1st_status = null; 
                $dm->wa_1st_ng_reason = null; 
                $dm->wa_2nd_call_date = null; 
                $dm->wa_2nd_hanging_time = null; 
                $dm->wa_2nd_dialogue_content = null;  
                $dm->wa_2nd_status = null; 
                $dm->wa_2nd_ng_reason = null; 
                $dm->wa_3rd_call_date = null; 
                $dm->wa_3rd_hanging_time = null; 
                $dm->wa_3rd_dialogue_content = null;  
                $dm->wa_3rd_status = null; 
                $dm->wa_3rd_ng_reason = null; 
                $dm->wa_4th_call_date = null; 
                $dm->wa_4th_hanging_time = null; 
                $dm->wa_4th_dialogue_content = null;  
                $dm->wa_4th_status = null; 
                $dm->wa_4th_ng_reason = null; 
                $dm->wa_5th_call_date = null; 
                $dm->wa_5th_hanging_time = null; 
                $dm->wa_5th_dialogue_content = null;  
                $dm->wa_5th_status = null; 
                $dm->wa_5th_ng_reason = null;
                $dm->wa_presence_absence = 0;
                $dm->dm_sending_times = 0;
                $dm->sm_presence_absence = 0;
                $dm->sm_type = null;
                $dm->ji_presence_absence = 0;
                $dm->talk_classification = null;
                $dm->company_name_id = self::create_company_name_id($dmAcquisition->company_name);             
                $dm->ng_flag = 0;                 
                $dm->ng_reason = null;              
                $dm->transaction_contents = null;
                $dm->capture_status = 1;

                $dm->save();
            }


        }

        //truncate dm_acquisition_lists table
        DmAcquisitionList::truncate();

        return $duplicate;

    }

}
