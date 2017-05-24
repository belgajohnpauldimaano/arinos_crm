<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CustomerInformation;

use Session;

class CustomerUpdateController extends Controller
{
    //
    public function file_update($id)
    {

        $checkCustomer = CustomerInformation::where('customer_id', $id)->count();

        if($checkCustomer > 0){

            $customerInformation =CustomerInformation::where('customer_id', $id)->first();

            return view('Fileupdate.file_update', compact('customerInformation'));

        }else{
            
            abort(404,'The resource you are looking for could not be found');

        }
        
    }

    public function customer_update(Request $request, $id)
    {
        $updateCustomer = CustomerInformation::findOrFail($id);

        $updateCustomer->update_date = date('Y-m-d');

        $updateCustomer->person_charge_name = $request->person_charge_name;

        $updateCustomer->company_name = $request->company_name;

        $updateCustomer->company_phone = $request->company_phone;

        $updateCustomer->company_url = $request->company_url;

        $updateCustomer->company_mail = $request->company_mail;

        $updateCustomer->ad_street = $request->ad_street;

        $updateCustomer->ad_prefectures = $request->ad_prefectures;

        $updateCustomer->ad_municipality = $request->ad_municipality;

        $updateCustomer->closest_station = $request->closest_station;

        $updateCustomer->industry = $request->industry;

        $updateCustomer->establishment_year = $request->establishment_year;

        $updateCustomer->employees_number = $request->employees_number;

        $updateCustomer->br_department_charge = $request->br_department_charge;

        $updateCustomer->br_contact_name = $request->br_contact_name;

        $updateCustomer->br_1st_call_date = $request->br_1st_call_date;

        $updateCustomer->br_1st_hanging_time = $request->br_1st_hanging_time;

        $updateCustomer->br_1st_dialogue_content = $request->br_1st_dialogue_content;

        $updateCustomer->br_1st_status = $request->br_1st_status;

        $updateCustomer->br_1st_ng_reason = $request->br_1st_ng_reason;

        $updateCustomer->br_2nd_call_date = $request->br_2nd_call_date;

        $updateCustomer->br_2nd_hanging_time = $request->br_2nd_hanging_time;

        $updateCustomer->br_2nd_dialogue_content = $request->br_2nd_dialogue_content;

        $updateCustomer->br_2nd_status = $request->br_2nd_status;

        $updateCustomer->br_2nd_ng_reason = $request->br_2nd_ng_reason;

        $updateCustomer->br_3rd_call_date = $request->br_3rd_call_date;

        $updateCustomer->br_3rd_hanging_time = $request->br_3rd_hanging_time;

        $updateCustomer->br_3rd_dialogue_content = $request->br_3rd_dialogue_content;

        $updateCustomer->br_3rd_status = $request->br_3rd_status;

        $updateCustomer->br_3rd_ng_reason = $request->br_3rd_ng_reason;

        $updateCustomer->br_4th_call_date = $request->br_4th_call_date;

        $updateCustomer->br_4th_hanging_time = $request->br_4th_hanging_time;

        $updateCustomer->br_4th_dialogue_content = $request->br_4th_dialogue_content;

        $updateCustomer->br_4th_status = $request->br_4th_status;

        $updateCustomer->br_4th_ng_reason = $request->br_4th_ng_reason;

        $updateCustomer->br_5th_call_date = $request->br_5th_call_date;

        $updateCustomer->br_5th_hanging_time = $request->br_5th_hanging_time;

        $updateCustomer->br_5th_dialogue_content = $request->br_5th_dialogue_content;

        $updateCustomer->br_5th_status = $request->br_5th_status;

        $updateCustomer->br_5th_ng_reason = $request->br_5th_ng_reason;

        //--------------------------------------------------------------------------------------------------

        $updateCustomer->wa_department_charge = $request->wa_department_charge;

        $updateCustomer->wa_contact_name = $request->wa_contact_name;

        $updateCustomer->wa_1st_call_date = $request->wa_1st_call_date;

        $updateCustomer->wa_1st_hanging_time = $request->wa_1st_hanging_time;

        $updateCustomer->wa_1st_dialogue_content = $request->wa_1st_dialogue_content;

        $updateCustomer->wa_1st_status = $request->wa_1st_status;

        $updateCustomer->wa_1st_ng_reason = $request->wa_1st_ng_reason;

        $updateCustomer->wa_2nd_call_date = $request->wa_2nd_call_date;

        $updateCustomer->wa_2nd_hanging_time = $request->wa_2nd_hanging_time;

        $updateCustomer->wa_2nd_dialogue_content = $request->wa_2nd_dialogue_content;

        $updateCustomer->wa_2nd_status = $request->wa_2nd_status;

        $updateCustomer->wa_2nd_ng_reason = $request->wa_2nd_ng_reason;

        $updateCustomer->wa_3rd_call_date = $request->wa_3rd_call_date;

        $updateCustomer->wa_3rd_hanging_time = $request->wa_3rd_hanging_time;

        $updateCustomer->wa_3rd_dialogue_content = $request->wa_3rd_dialogue_content;

        $updateCustomer->wa_3rd_status = $request->wa_3rd_status;

        $updateCustomer->wa_3rd_ng_reason = $request->wa_3rd_ng_reason;

        $updateCustomer->wa_4th_call_date = $request->wa_4th_call_date;

        $updateCustomer->wa_4th_hanging_time = $request->wa_4th_hanging_time;

        $updateCustomer->wa_4th_dialogue_content = $request->wa_4th_dialogue_content;

        $updateCustomer->wa_4th_status = $request->wa_4th_status;

        $updateCustomer->wa_4th_ng_reason = $request->wa_4th_ng_reason;

        $updateCustomer->wa_5th_call_date = $request->wa_5th_call_date;

        $updateCustomer->wa_5th_hanging_time = $request->wa_5th_hanging_time;

        $updateCustomer->wa_5th_dialogue_content = $request->wa_5th_dialogue_content;

        $updateCustomer->wa_5th_status = $request->wa_5th_status;

        $updateCustomer->wa_5th_ng_reason = $request->wa_5th_ng_reason;

        //--------------------------------------------------------------------------------------------------

        $updateCustomer->wa_presence_absence = $request->wa_presence_absence;

        $updateCustomer->dm_sending_times = $request->dm_sending_times;

        $updateCustomer->sm_presence_absence = $request->sm_presence_absence;

        $updateCustomer->sm_type = $request->sm_type;

        $updateCustomer->ji_presence_absence = $request->ji_presence_absence;

        $updateCustomer->talk_classification = $request->talk_classification;

        $updateCustomer->ng_flag = $request->ng_flag;

        $updateCustomer->company_name_id = $request->company_name_id;

        $updateCustomer->ng_reason = $request->ng_reason;

        $updateCustomer->transaction_contents = $request->transaction_contents; 


        if($updateCustomer->save()){

            Session::flash('success', 'Customer with customer_id: '.$id.' has been updated');
            return back();
            
        }else{

            Session::flash('error', 'Failed updating customer, try again!');
            return back();

        }

    }
}
