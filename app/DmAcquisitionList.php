<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DmAcquisitionList extends Model
{

    public static function saveExcelRows($rowData = array(), $acquisition_format = null)
    {

        $errorRow = "";
        $duplicate = array();
        $duplicate_ctr = 0;

        DB::beginTransaction();

        foreach ($rowData as $key => $value) {
          
             try {

                $checkDuplicate = DB::select("select *
                                        from dm_acquisition_lists
                                        where company_name = '".$value['会社名']."'
                                        and ( company_phone =  '".$value['電話番号']."'
                                              or company_mail = '".$value['メール']."')");

                if(empty($checkDuplicate)){
                    
                    //insert to table

                    if ($acquisition_format == 1) {

                        //urizo
                        DB::table('dm_acquisition_lists')->insert([
    						'company_name' => $value['会社名'],					
    						'company_phone' => $value['電話番号'],					
    						'company_url' => $value['url'],					
    						'company_mail' => $value['メール'],					
    						'ad_street' => $value['住所'],					
    						'ad_prefectures' => null,					
    						'ad_municipality' => null,					
    						'closest_station' => null,					
    						'industry' => $value['業種'],					
    						'establishment_year' => null,					
    						'employees_number' => null,	
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

                    } else if ($acquisition_format == 2) {

                        //risuta
                        DB::table('dm_acquisition_lists')->insert([
                            'company_name' => $value['会社名'],                    
                            'company_phone' => $value['TEL番号'],                  
                            'company_url' => $value['トップURL'],                 
                            'company_mail' => $value['メールアドレス'],                    
                            'ad_street' => $value['住所'],                    
                            'ad_prefectures' => null,                   
                            'ad_municipality' => null,                  
                            'closest_station' => null,                  
                            'industry' => $value['業種'],                 
                            'establishment_year' => null,                   
                            'employees_number' => null, 
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

                    } else if ($acquisition_format == 3) {
                        
                        //risutoru
                        DB::table('dm_acquisition_lists')->insert([
                            'company_name' => $value['社名'],                    
                            'company_phone' => $value['電話番号'],                  
                            'company_url' => $value['HP'],                 
                            'company_mail' => $value['メールアドレス'],                    
                            'ad_street' => $value['所在地'],                    
                            'ad_prefectures' => null,                   
                            'ad_municipality' => null,                  
                            'closest_station' => null,                  
                            'industry' => null,                 
                            'establishment_year' => $value['設立'],                   
                            'employees_number' => $value['従業員数'], 
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

                    } else {
                        
                        //other
                        DB::table('dm_acquisition_lists')->insert([
                            'company_name' => $value['会社名'],                    
                            'company_phone' => $value['電話番号'],                  
                            'company_url' => $value['サイトURL'],                 
                            'company_mail' => $value['メールアドレス'],                    
                            'ad_street' => $value['住所'],                    
                            'ad_prefectures' => null,                   
                            'ad_municipality' => null,                  
                            'closest_station' => null,                  
                            'industry' => $value['業種'],                 
                            'establishment_year' => $value['設立'],                   
                            'employees_number' => $value['従業員数'], 
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);

                    }

                } else {

                    //output the excluded record as CSV
                    $duplicate[$duplicate_ctr] = $value;
                    $duplicate_ctr++;

                }

            } catch (\Exception $e) {
                DB::rollback();
                //throw $e;
                $errorRow = $key + 2;
                return $errorRow;
            } 

        }

        DB::commit();

        return $duplicate;
    }

}
