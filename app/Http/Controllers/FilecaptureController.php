<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Validator;

use App\DmSendingCompletionList;
use App\CustomerInformation;
use App\CallList;
use App\DmAcquisitionList;

use Response;

use Session;

use App\NgList;



class FilecaptureController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Filecapture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function call_list(Request $request)
    {
        //disable memory limit
        ini_set("memory_limit",-1);

        //disable maximum execution time
        set_time_limit(0);

        $filetype = $_FILES['call_list_file']['type'];

        $csv_mimetypes = array(
            'text/csv',
            'text/plain',
            'application/csv',
            'text/comma-separated-values',
            'application/excel',
            'application/vnd.ms-excel',
            'application/vnd.msexcel',
            'text/anytext',
            'application/octet-stream',
            'application/txt',
            'application/wps-office.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        $file = $request->file('call_list_file');
        $filename = $file->getClientOriginalName();
        $file_path = $file->getRealPath();      

        //Check if file type is excel file
        if (!in_array($_FILES['call_list_file']['type'], $csv_mimetypes)) {

            //not a csv or excel file
            echo "取込ファイルのフォーマットが異なります";

        } else {

            //Check the 1st and 2nd header of 架電リストファイル(paging list file)

            $header1 = array( 0 => "No",
                            1 => "自社情報",
                            2 => "基本情報",
                            13 => "業務精査",
                            40 => "wantedly",
                            67 => "フラグ" );

            $header2 = array( 0 => null,
                            1 => "担当者",
                            2 => "企業名",
                            3 => "電話番号",
                            4 => "URL",
                            5 => "メールアドレス",
                            6 => "住所",
                            7 => "都道府県",
                            8 => "市区町村",
                            9 => "最寄駅",
                            10 => "業種",
                            11 => "設立年",
                            12 => "従業員数",
                            13 => "先方担当署",
                            14 => "担当者名",
                            15 => "初回架電日",
                            16 => "初回時間",
                            17 => "初回対話内容",
                            18 => "初回ステータス",
                            19 => "初回NG理由",
                            20 => "2回目架電日",
                            21 => "2回目時間",
                            22 => "2回目対話内容",
                            23 => "2回目ステータス",
                            24 => "2回目NG理由",
                            25 => "3回目架電日",
                            26 => "3回目時間",
                            27 => "3回目対話内容",
                            28 => "3回目ステータス",
                            29 => "3回目NG理由",
                            30 => "4回目架電日",
                            31 => "4回目時間",
                            32 => "4回目対話内容",
                            33 => "4回目ステータス",
                            34 => "4回目NG理由",
                            35 => "5回目架電日",
                            36 => "5回目時間",
                            37 => "5回目対話内容",
                            38 => "5回目ステータス",
                            39 => "5回目NG理由",
                            40 => "先方担当部署",
                            41 => "担当者名",
                            42 => "初回架電日",
                            43 => "初回時間",
                            44 => "初回対話内容",
                            45 => "初回ステータス",
                            46 => "初回NG理由",
                            47 => "2回目架電日",
                            48 => "2回目時間",
                            49 => "2回目対話内容",
                            50 => "2回目ステータス",
                            51 => "2回目NG理由",
                            52 => "3回目架電日",
                            53 => "3回目時間",
                            54 => "3回目対話内容",
                            55 => "3回目ステータス",
                            56 => "3回目NG理由",
                            57 => "4回目架電日",
                            58 => "4回目時間",
                            59 => "4回目対話内容",
                            60 => "4回目ステータス",
                            61 => "4回目NG理由",
                            62 => "5回目架電日",
                            63 => "5回目時間",
                            64 => "5回目対話内容",
                            65 => "5回目ステータス",
                            66 => "5回目NG理由",
                            67 => "Wantedly掲載有無",
                            68 => "DM送付有無",
                            69 => "資料送付有無",
                            70 => "資料送付タイプ",
                            71 => "飛込実施有無",
                            72 => "トーク分類");

            //I used this variable to check process time
            $startTime = microtime(true);

            //Read the excel file
            $reader = Excel::selectSheetsByIndex(0)->load($file_path, function () {});
            $totalRows = $reader->get()->count()+1;

            $rowData = array();
            $headerError = "";

            //get all data column
            for($row=1;$row<=$totalRows;$row++) {
                for($column=0;$column<=72;$column++) {
                    $rowData[$row][$column] = $reader->getActiveSheet()->getCellByColumnAndRow($column,$row)->getValue();
                }
            }

            //check 1st header
            foreach($rowData[1] as $key => $value){
                if(isset($header1[$key])) {
                    if($value != $header1[$key]){
                        $headerError = "1";
                    }
                } else {  
                    if($value != null)              
                    $headerError = "1";
                }

            }

            //check 2nd header
            foreach($rowData[2] as $key => $value){
                if(isset($header2[$key])) {
                    if($value != $header2[$key]){
                        $headerError = "2";
                    }
                } else {
                    if($key != 0)
                    $headerError = "2";
                }
            }

            if($headerError != "") {

                //error on header
                echo "取込ファイルのフォーマットが異なります";

            } else {

                //process the excel contents (save first on call_lists table)
                
                $saveExcelOnCallList = CallList::saveExcelRows($rowData);
              
                if($saveExcelOnCallList != "") {

                    //error on excel row
                    echo "取込エラーです。ファイル名：".$filename."、行番号：".$saveExcelOnCallList."";

                } else {

                    //save on customer_information table
                    $saveFromCallListTable = CustomerInformation::saveFromCallListTable();

                    return "ok";

                }

                //uncomment below to check the amount of time
                //dd("Elapsed time is: ". (microtime(true) - $startTime) ." seconds");
            }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dm_acquisition_list(Request $request)
    {
    
        //disable memory limit
        ini_set("memory_limit",-1);

        //disable maximum execution time
        set_time_limit(0);

        try{
            $filetype = $_FILES['dm_acquisition_list_file']['type'];
        } catch (\Exception $e) {           
            return "取込ファイルのフォーマットが異なります";
        }        

        $csv_mimetypes = array(
            'text/csv',
            'text/plain',
            'application/csv',
            'text/comma-separated-values',
            'application/excel',
            'application/vnd.ms-excel',
            'application/vnd.msexcel',
            'text/anytext',
            'application/octet-stream',
            'application/txt',
            'application/wps-office.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        $file = $request->file('dm_acquisition_list_file');
        $filename = $file->getClientOriginalName();
        $file_path = $file->getRealPath();      

        //Check if file type is excel file
        if (!in_array($_FILES['dm_acquisition_list_file']['type'], $csv_mimetypes)) {

            //not a csv or excel file
            echo "取込ファイルのフォーマットが異なります";

        } else {

            //$acquisition_format = $request->input('acquisition_format');
            $acquisition_format = $_POST['acquisition_format'];
            
            $result = "";

            if ($acquisition_format == 1) {
                
                //urizo
                $header = array( 0 => '会社名',      
                                1 => '郵便番号',            
                                2 => '住所',          
                                3 => '電話番号',            
                                4 => 'fax',         
                                5 => 'メール',         
                                6 => 'url',         
                                7 => 'データ元',            
                                8 => '業種',          
                                9 => 'コメント',            
                                10 => '日付',          
                                11 => 'メモ');

            } else if ($acquisition_format == 2) {
                
                //risuta
                $header = array( 0 => '企業名',     
                                1 => '郵便番号',            
                                2 => '住所',          
                                3 => '業種',          
                                4 => 'TEL番号',           
                                5 => 'メールアドレス',         
                                6 => 'メールアドレスチェック',         
                                7 => 'トップURL',          
                                8 => '情報出所',            
                                9 => '件名');

            } else if ($acquisition_format == 3) {
                
                //risutoru
                $header = array(0 => '社名',           
                                1 => '電話番号',             
                                2 => 'FAX番号',            
                                3 => 'メールアドレス',          
                                4 => 'HP',           
                                5 => '郵便番号',             
                                6 => '所在地',          
                                7 => '設立',           
                                8 => '資本金',          
                                9 => '売上高',          
                                10 => '代表者',          
                                11 => '従業員数',             
                                12 => '平均年齢',             
                                13 => '事業内容');

            } else {
                
                //other
                $header = array(0 => '電話番号',            
                                1 => '会社名',         
                                2 => '店舗名',         
                                3 => '郵便番号',            
                                4 => '住所',          
                                5 => 'FAX番号',           
                                6 => 'サイトURL',          
                                7 => 'メールアドレス',         
                                8 => '代表者名',            
                                9 => '担当者名',            
                                10 => '創設',          
                                11 => '設立',          
                                12 => '資本金',         
                                13 => '売上高',         
                                14 => '従業員数',            
                                15 => '平均年齢',            
                                16 => '業種',          
                                17 => '事業所',         
                                18 => 'カテゴリ名');
            }

            $load = Excel::load($file_path, function () {})->get();
            
            $excel_data = $load->toArray();

            $excel_header = array_keys($excel_data[0]);

            $result = "";
            $dmAcquisition_duplicates = array();
            $all_duplicates = array();

            //check if header is correct
            foreach($header as $key => $value)
            { 
                if(!isset($excel_header[$key]))
                {
                    return json_encode([
                                        'error' => 'format',
                                        'msg' => '取込ファイルのフォーマットが異なります'
                                    ]);
                }

                if($value != $excel_header[$key])
                {
                    return json_encode([
                                        'error' => 'format',
                                        'msg' => '取込ファイルのフォーマットが異なります'
                                    ]);
                }
            }

            if($result == "") {

                //save excel_data on dm_acquisition_list
                $saveExcelOnDmAcquisitionList = DmAcquisitionList::saveExcelRows($excel_data, $acquisition_format);
                    
                if(!empty($saveExcelOnDmAcquisitionList) && !is_array($saveExcelOnDmAcquisitionList)) {

                    //error on excel row
                    return json_encode([
                                        'error' => 'format',
                                        'msg' => '取込エラーです。ファイル名：'.$filename.'、行番号：'.$saveExcelOnDmAcquisitionList.''
                                    ]);

                } 
                
                //put duplicates on variable
                $dmAcquisition_duplicates = $saveExcelOnDmAcquisitionList;
                $total_dmAcquisition_duplicates = count($dmAcquisition_duplicates);            

                //save dm_acquisition_list to customer_information
                $saveOnCustomerInformation = CustomerInformation::saveFromDmAcquisitionList($total_dmAcquisition_duplicates);

                if(!empty($saveOnCustomerInformation)) {

                    //Output the excluded record as CSV.                                      
                    //file name:DM取得リストテーブル重複リスト_yyyymmdd.csv 
                    $all_duplicates = array_merge($dmAcquisition_duplicates, $saveOnCustomerInformation);
                    $duplicate_filename = 'DM取得リストテーブル重複リスト_'.date('Ymd');
                   
                    Excel::create($duplicate_filename, function($excel) use ($all_duplicates) {

                        $excel->sheet('Sheet1', function($sheet) use ($all_duplicates) {
                            $sheet->fromArray($all_duplicates);
                        });

                    //})->download('csv');
                    })->store('xlsx', public_path('excel/duplicate_data'));

                    $duplicate_csv_link = route('dm_acquisition_list_duplicate');

                    return json_encode([
                                        'error' => 'duplicate',
                                        'duplicate_csv_link' => $duplicate_csv_link
                                    ]);

                } else {
                   
                    return json_encode([
                                        'error' => 'none',
                                    ]);

                }

            }

            return $result;

        }

    }

    public function dm_acquisition_list_duplicate (Request $request) 
    {
        $duplicate_filename = 'DM取得リストテーブル重複リスト_'.date('Ymd');
        $path = public_path('excel/duplicate_data/'.$duplicate_filename.'.xlsx');
        return response()->download($path);
    }

    public function ng_list(Request $request){

        $updateMsg = false;

        $saveMsg = false;

        $rollback = false;

        $errorData = array();

        $countLineError = 2;

        $rules = [
            'get_ng_list' => 'required|'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return json_encode(['errMsg' => 'Ng List is required']);
        }
        

        ini_set("memory_limit",-1);//disable limit
        
        set_time_limit(0);//disable maximum execution time

        $file = $request->file('get_ng_list');

        $filename = $file->getClientOriginalExtension();

        $file_path = $file->getRealPath();


        $extension = $request->get_ng_list->extension();

        $mimeType = $request->get_ng_list->getMimeType();
        
        $csv_mimetypes = array(
                    'text/csv',
                    'text/plain',
                    'application/csv',
                    'text/comma-separated-values',
                    'application/excel',
                    'application/vnd.ms-excel',
                    'application/vnd.msexcel',
                    'text/anytext',
                    'application/octet-stream',
                    'application/txt',
                    'application/wps-office.xlsx',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                );

        if(in_array($mimeType, $csv_mimetypes)){

            $ng_list_headers = [
                'id', '企業名', '電話番号', 'メールアドレス', '住所', '都道府県', '市区町村', '業種', 'ng理由', '取引内容', '名寄せフラグ'
            ];
            $load = Excel::load($file_path, function () {})->get();
            
            $array_headers = $load->toArray();

            $array_keys = array_keys($array_headers[0]);


            foreach($ng_list_headers as $key => $value) // loop thru each default header to check the uploaded header
            {
                if($value != $array_keys[$key])
                {
                    return json_encode(['errMsg' => '取込ファイルのフォーマットが異なります']); //display error if invalid file format
                }
            }


           DB::beginTransaction();
            
            foreach($array_headers as $headers){

                if($headers['メールアドレス'] != null){

                    $validateIf =  NgList::where('id',$headers['id'])->count();

                    if($validateIf > 0){ // Update ng_list table when there is matching id

                                if(filter_var($headers['メールアドレス'], FILTER_VALIDATE_EMAIL))
                                {
                                    $ngListUpdate = NgList::findOrFail($headers['id']);

                                    $ngListUpdate->update_date = date('Y-m-d');

                                    $ngListUpdate->company_name = $headers['企業名'];

                                    $ngListUpdate->company_phone = $headers['電話番号'];

                                    $ngListUpdate->company_mail = $headers['メールアドレス'];

                                    $ngListUpdate->ad_street = $headers['住所'];

                                    $ngListUpdate->ad_prefectures = $headers['都道府県'];

                                    $ngListUpdate->ad_municipality = $headers['市区町村'];

                                    $ngListUpdate->industry = $headers['業種'];

                                    $ngListUpdate->ng_reason = $headers['ng理由'];

                                    $ngListUpdate->transaction_contents = $headers['取引内容'];

                                    $ngListUpdate->name_id_flag = $headers['名寄せフラグ'];

                                    $ngListUpdate->save();

                                    //update table customer_information

                                    $updateCustomer = NgList::where('name_id_flag', 0)->get();


                                    $countLineError++;

                                    if($updateCustomer){

                                        //compare using company_name
                                        $getDataFromNgList = NgList::where('id', $headers['id'])->get();

                                        foreach($getDataFromNgList as $fetchData){

                                            $newCustomerUpdate = CustomerInformation::where('company_name', $fetchData->company_name)

                                            ->update(['ng_flag' => 1, 'ng_reason' => $fetchData->ng_reason, 'transaction_contents' =>$fetchData->transaction_contents ]);

                                        }
                                        

                                    }else{

                                        //compare using company_name_id

                                        $getDataFromNgList = NgList::where('id', $headers['id'])->get();

                                        foreach($getDataFromNgList as $fetchData){

                                            $newCustomerUpdate = CustomerInformation::where('company_name_id', $fetchData->company_name)

                                            ->update(['ng_flag' => 1, 'ng_reason' => $fetchData->ng_reason, 'transaction_contents' =>$fetchData->transaction_contents ]);

                                        }

                                    }

                                    $updateMsg = true;

                                }else{

                                    $rollback = true;

                                    $errRowTemp = array(
                                    '取込エラーです。ファイル名:' => $file->getClientOriginalName(),
                                    // 'company_mail' => $headers['メールアドレス'],
                                    // '行番号:' => $headers['id'] + 1
                                    '行番号:' => $countLineError++,
                                    );
                                    $errorData[] = $errRowTemp;

                                     

                                }

                    }else{ //Inserting data to ng_list table without processing.



                            if(filter_var($headers['メールアドレス'], FILTER_VALIDATE_EMAIL))
                            {
                                $nglist = new NgList();

                                $nglist->id = $headers['id'];

                                $nglist->entry_date = date('Y-m-d');

                                $nglist->update_date = date('Y-m-d');

                                $nglist->company_name = $headers['企業名'];

                                $nglist->company_phone = $headers['電話番号'];

                                $nglist->company_mail = $headers['メールアドレス'];

                                $nglist->ad_street = $headers['住所'];

                                $nglist->ad_prefectures = $headers['都道府県'];

                                $nglist->ad_municipality = $headers['市区町村'];

                                $nglist->industry = $headers['業種'];

                                $nglist->ng_reason = $headers['ng理由'];

                                $nglist->transaction_contents = $headers['取引内容'];

                                $nglist->name_id_flag = $headers['名寄せフラグ'];

                                $nglist->save();

                                $countLineError++;
                                //update table customer_information

                                    $updateCustomer = NgList::where('name_id_flag', 0)->get();

                                    //dd($updateCustomer);

                                    if($updateCustomer){

                                        //compare using company_name
                                        $getDataFromNgList = NgList::where('id', $headers['id'])->get();

                                        foreach($getDataFromNgList as $fetchData){

                                            $newCustomerUpdate = CustomerInformation::where('company_name', $fetchData->company_name)

                                            ->update(['ng_flag' => 1, 'ng_reason' => $fetchData->ng_reason, 'transaction_contents' =>$fetchData->transaction_contents ]);

                                        }
                                        

                                    }else{

                                        //compare using company_name_id

                                        $getDataFromNgList = NgList::where('id', $headers['id'])->get();

                                        foreach($getDataFromNgList as $fetchData){

                                            $newCustomerUpdate = CustomerInformation::where('company_name_id', $fetchData->company_name)

                                            ->update(['ng_flag' => 1, 'ng_reason' => $fetchData->ng_reason, 'transaction_contents' =>$fetchData->transaction_contents ]);

                                        }

                                    }

                                $saveMsg = true;

                            }else{

                                $rollback = true;

                                $errRowTemp = array(
                                '取込エラーです。ファイル名:' => $file->getClientOriginalName(),
                                // 'company_mail' => $headers['メールアドレス'],
                                // '行番号:' => $headers['id'],
                                '行番号:' => $countLineError++,
                                );
                                $errorData[] = $errRowTemp;

                            }



                    }



                }//what if empty? else{}
                

            }

            

            //response msgs;


            if($rollback){

                DB::rollback();

                return json_encode(['errMsg1' => $errorData]);

            }

            DB::commit();

            // if($saveMsg){

            //     return json_encode(['msg' => 'Data has been saved']);

            // }

            // if($updateMsg){

            //     return json_encode(['msg' => 'Data has been updated']);

            // }

            

            
        }else{

            return json_encode(['errMsg' => '取込ファイルのフォーマットが異なります']); //display error if invalid file format
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dm_completion_list(Request $request)
    {
        $rules = [
            'get_dm_list' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return json_encode(['errCode'=> 1, 'errMsg' => 'File import is required']);
        }
        
        $fileOriginalName = $request->get_dm_list->getClientOriginalName();
        $extension = $request->get_dm_list->extension();
        $mimeType = $request->get_dm_list->getMimeType();
        
        $csv_mimetypes = array(
                    'text/csv',
                    'text/plain',
                    'application/csv',
                    'text/comma-separated-values',
                    'application/excel',
                    'application/vnd.ms-excel',
                    'application/vnd.msexcel',
                    'text/anytext',
                    'application/octet-stream',
                    'application/txt',
                    'application/wps-office.xlsx',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                );
                
        if(in_array($mimeType, $csv_mimetypes)) 
        {
            $default_headers = [
                'no',
                'メールアドレス'
            ];

            $path = $request->file('get_dm_list')->getRealPath();
            $data = Excel::load($path, function () {})->get();
                        
            $exist_in_table = array(); // container of existing data in the dm sending completion list table
            $has_exist_in_table = false; // this will be true if there is exisiting data in the table
            $errRow = array(); // container of error rows that validated
            $rowCtr = 0;


            $excel_data = $data->toArray();
            $headers = array_keys($excel_data[0]);

            $rollBack = false;            

            foreach($default_headers as $key => $value) // loop thru each default header to check the uploaded header
            {
                if($value != $headers[$key])
                {
                    return json_encode(['errCode'=> 1, 'errMsg' => 'Invalid column format']);
                }
            }

            DB::beginTransaction();

            foreach ($excel_data as $key => $value) 
            {
                $company_mail = $value['メールアドレス'];
                if($company_mail != null)
                {                    
                    $DmSendingCompletionList = DmSendingCompletionList::where('company_mail', $company_mail)->count();
                    
                    if($DmSendingCompletionList > 0) // data already existing in the table
                    {
                        $rowCtr++;

                        // create an object with a value of existing in the database table
                        $tmp_exist_arr = array(
                            'no'            => $value['no'],
                            'メールアドレス'   =>$value['メールアドレス']
                        );

                        // passing the object to array
                        $exist_in_table[] = $tmp_exist_arr;
                        $has_exist_in_table = true;

                    }
                    else
                    {

                        $rowCtr++;
                        if(filter_var($company_mail, FILTER_VALIDATE_EMAIL))
                        {
                            // valid email address can proceed to insertion
                            $DmSendingCompletionList = new DmSendingCompletionList();
                            $DmSendingCompletionList->company_mail = $company_mail;
                            $DmSendingCompletionList->save();

                            $CustomerInformation = CustomerInformation::where('company_mail', $company_mail)->first();
                            
                            if($CustomerInformation != null) // check if the were selected customer information
                            {
                                $CustomerInformation->dm_sending_times += 1; // increment by 1
                                $CustomerInformation->save();
                            }

                        }
                        else
                        {
                            // invalid email do rollback
                            // $rollBack = true;
                            // $errRowTemp = array(
                            //         'no' => $value['no'],
                            //         'value' => $company_mail
                            //     );

                            return json_encode(['errCode' => 1, 'errMsg' => '取込エラーです。ファイル名：'.$fileOriginalName.'、行番号：' . $rowCtr]);    

                            //$errRow[] = $errRowTemp;
                        }

                    }

                }
            }

            if($rollBack == true) // check if some email is invalid
            {
                DB::rollback();
                // return an error with message of rows where the error found $errRow -> json object (no,value)
                return json_encode(['errCode'=> 1, 'errMsg' => 'Invalid email format.', 'specificError' => $errRow]);
            }

            DB::commit();
            $duplicate_filename = 'DM送付完了リスト_'.date('Ymd');
            // generate duplicate data into csv
            Excel::create($duplicate_filename, function ($excel) use ($default_headers, $exist_in_table) {
               $excel->sheet('duplicate email', function ($sheet) use ($default_headers, $exist_in_table) {
                   $sheet->fromArray($default_headers);
                   foreach($exist_in_table as $key => $value)
                   {
                        $sheet->row($key + 2, array(
                            $value['no'],
                            $value['メールアドレス']
                        ));
                   }
               } ); 
            })->store('xlsx', public_path('excel/duplicate_data'));

            // joining of customer information and dm sending completion lists and getting only a null company email to from the dm sending completion list
            $CustomerInformation = CustomerInformation::leftjoin('dm_sending_completion_lists', function ($join) {
                        $join->on('dm_sending_completion_lists.company_mail', '=', 'customer_informations.company_mail');
                    })
                    ->whereNull('dm_sending_completion_lists.company_mail') // check for null company email
                    ->get(['customer_informations.*', 'dm_sending_completion_lists.company_mail as temp_mail']);

            $unregistered_filename = 'DM送付未登録リスト'.date('Ymd');

            $has_unregistered_data = false;
            if ($CustomerInformation->count() > 0) // check if there is a selected records from the joins
            {
                Excel::create($unregistered_filename, function ($excel) use ($default_headers, $exist_in_table, $CustomerInformation) {
                $excel->sheet('duplicate email', function ($sheet) use ($default_headers, $exist_in_table, $CustomerInformation) {
                    $sheet->fromModel($CustomerInformation); // this code will save the data to csv from customer_information model
                }); 
                })->store('xlsx', public_path('excel/not_updated_from_csv'));

                $has_unregistered_data = true; // make it true to generate a link for the unregistered data csv
            }

            // deletion of all data in DmSendingCompletionList
            DmSendingCompletionList::getQuery()->delete();

            $unregistered_csv_link = '';
            if ($has_unregistered_data == true) // if there is data in customer information that is no registered in csv file
            {
                // generate a route or link for unregistered data
                $unregistered_csv_link = route('dm_sending_unregistered_list', $unregistered_filename);
            }
            $duplicate_csv_link = '';
            if ($has_exist_in_table == true) // if there is existing data on table dm sending completion list
            {
                // generate a route or link for duplicates
                $duplicate_csv_link = route('dm_completion_list_duplicate');
            }

            return json_encode([
                'errCode'           => 0, 
                'msg'               => 'File successfully imported.', 
                'exist_in_table'    => $exist_in_table, 
                'duplicate_data'    => [
                        'has_exist_in_table' => $has_exist_in_table,
                        'duplicate_csv_link'    =>$duplicate_csv_link,
                    ], 
                'unregistered_data' => [
                        'has_unregistered_data' => $has_unregistered_data,
                        'unregistered_csv_link' => $unregistered_csv_link
                    ]
                ]);
            
        }
        else
        {//キャプチャしたファイルの形式が異なります
            return json_encode(['errCode' => 1, 'errMsg' => '取込ファイルのフォーマットが異なります']);
        }
        
    }

    public function dm_completion_list_duplicate (Request $request) 
    {
        $path = public_path('excel/duplicate_data/duplicate_data.xlsx');
        return response()->download($path);
    }

    public function dm_sending_unregistered_list ($filename)
    {
        $path = public_path('excel/not_updated_from_csv/' . $filename.'.xlsx');
        return response()->download($path);
    }

}
