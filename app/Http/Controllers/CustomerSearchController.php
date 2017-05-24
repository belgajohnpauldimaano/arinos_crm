<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\CustomerInformation;

class CustomerSearchController extends Controller
{

    protected $burName = array();

    protected $wanName = array();

    public function index () 
    {
        $prefectures = [
            '-',
            '北海道',
            '青森県',
            '岩手県',
            '宮城県',
            '秋田県',
            '山形県',
            '福島県',
            '茨城県',
            '栃木県',
            '群馬県',
            '埼玉県',
            '千葉県',
            '東京都',
            '神奈川県',
            '新潟県',
            '富山県',
            '石川県',
            '福井県',
            '山梨県',
            '長野県',
            '岐阜県',
            '静岡県',
            '愛知県',
            '三重県',
            '滋賀県',
            '京都府',
            '大阪府',
            '兵庫県',
            '奈良県',
            '和歌山県',
            '鳥取県',
            '島根県',
            '岡山県',
            '広島県',
            '山口県',
            '徳島県',
            '香川県',
            '愛媛県',
            '高知県',
            '福岡県',
            '佐賀県',
            '長崎県',
            '熊本県',
            '大分県',
            '宮崎県',
            '鹿児島県',
            '沖縄県'
        ];

        $industry_major = [
            '-',
            '建設業',
            '製造業',
            '電気･ガス･熱供給･水道業',
            '情報通信業',
            '運輸業､郵便業',
            '卸売業､小売業',
            '金融業､保険業',
            '不動産業､物品賃貸業',
            '学術研究､専門･技術サービス業',
            '宿泊業､飲食サービス業',
            '生活関連サービス業､娯楽業',
            '教育､学習支援業',
            '医療､福祉',
            '複合サービス事業',
            'サービス業(他に分類されないもの)',
            '公務（他に分類されない）',
            '農業､林業',
            '漁業',
            '鉱業、採石業、砂利採取業'
        ];

        return view('customer.customer_search', ['prefectures' => $prefectures, 'industry_major' => $industry_major]);
    }

    public function search_minor_industry (Request $request) 
    {
        $industry_minor = [
            '-' => [
                '-',
            ],
            '建設業' => [ //1
                '総合工事業 総合工事業',
                '左官工事業',
                '板金・金物工事業など（職別工事）',
                '電気工事業',
                '管工事業（設備工事）'
            ],
            '製造業' => [ //2
                '食料品製造業',
                '飲料･たばこ･飼料製造業',
                '繊維工業',
                '木材･木製品製造業',
                '家具･装備品製造業',
                'パルプ･紙･紙加工品製造業',
                '印刷･同関連業',
                '化学工業',
                '石油製品',
                'プラスチック製品製造業',
                'ゴム製品製造業',
                '鉄鋼業',
                '非鉄金属製造業',
                '金属製品製造業',
                '電子部品･デバイス･電子回路製造業',
                '電気機械器具製造業'
            ],
            '電気･ガス･熱供給･水道業' => [ //3
                '電気業',
                'ガス業',
                '熱供給業',
                '水道業'
            ],
            '情報通信業' => [ //4
                '通信業放送業',
                '情報サービス業',
                'インターネット附随サービス業',
                '新聞業',
                '出版業など映像･音声･文字情報制作業'
            ],
            '運輸業､郵便業' => [ //5
                '鉄道業',
                '道路旅客運送業',
                '道路貨物運送業',
                '水運業',
                '航空運輸業',
                '倉庫業',
                '運輸に附帯するサービス業',
                '郵便業'
            ],
            '卸売業､小売業' => [ //6
                '各種商品卸売業',
                '繊維･衣服等卸売業',
                '飲食料品卸売業',
                '建築材料',
                '鉱物･金属材料等卸売業',
                '機械器具卸売業',
                'その他の卸売業',
                '各種商品小売業',
                '織物･衣服･身の回り品小売業',
                '飲食料品小売業',
                '機械器具小売業',
                'その他の小売業',
                '無店舗小売業'
            ],
            '金融業､保険業' => [ //7
                '銀行業',
                '協同組織金融業',
                '貸金業',
                'クレジットカード業等非預金信用機関',
                '金融商品取引業',
                '商品先物取引業',
                '補助的金融業等',
                '保険業'
            ],
            '不動産業､物品賃貸業' => [ //8
                '不動産取引業',
                '不動産賃貸業･管理業',
                '物品賃貸業'
            ],
            '学術研究､専門･技術サービス業' => [ //9
                '学術･開発研究機関',
                '法律事務所',
                '特許事務所',
                '著述業',
                '広告業',
                '建築設計業',
                '技術サービス業'
            ],
            '宿泊業､飲食サービス業' => [ //10
                '宿泊業',
                '飲食店',
                '持ち帰り･配達飲食サービス業'
            ],
            '生活関連サービス業､娯楽業' => [ //11
                '洗濯･理容･美容･浴場業､旅行業',
                '冠婚葬祭業などその他の生活関連サービス業',
                '映画館､スポーツ施設など娯楽業'
            ],
            '教育､学習支援業' => [ //12
                '各種教室などその他の教育',
                '学習支援業'
            ],
            '医療､福祉' => [ //13
                '医療業',
                '保健衛生､社会保険･社会福祉･介護事業'
            ],
            '複合サービス事業' => [ //14 
                '郵便局､協同組合'
            ],
            'サービス業(他に分類されないもの)' => [ //15
                '廃棄物処理業',
                '自動車整備業',
                '機械等修理業',
                '職業紹介･労働者派遣業',
                'その他の事業サービス業',
                '政治･経済･文化団体､宗教',
                'その他のサービス業'
            ],
            '公務（他に分類されない）' => [ //16
                '国家公務､地方公務'
            ],
            '農業､林業' => [ //17
                '耕種農業',
                '畜産農業',
                '園芸サービス業',
                '林業'
            ],
            '漁業' => [ //18
                '海面漁業',
                '水産養殖業'
            ],
            '鉱業、採石業、砂利採取業' => [ //19
                '金属鉱業',
                '石炭・亜炭鉱業',
                '採石業',
                '砂・砂利・玉石採取業'
            ]
        ];
        
        $data = $request->industry;

        return json_encode($industry_minor[$data]);
    }

    public function search_customer (Request $request) 
    {
        //SQL QUERY FOR LATEST STATUS 

        $arrayBur = array();

        $arrayBurName = array();

        $arrayWan = array();

        $arrayWanName = array();

        if($request->call_situation != '-')
        
        {

        $customerBrStatus = CustomerInformation::where('customer_id',$request->customer_id)->get(['br_1st_status', 'br_2nd_status', 'br_3rd_status', 'br_4th_status', 'br_5th_status']);

        $customerWaStatus = CustomerInformation::where('customer_id',$request->customer_id)->get(['wa_1st_status', 'wa_2nd_status', 'wa_3rd_status', 'wa_4th_status', 'wa_5th_status']);
        
        

        foreach($customerBrStatus as $brStatus)
        {

            $arrayBr = json_decode(json_encode($brStatus), true);

         

            foreach($arrayBr as $br => $valB){

                if(!empty($valB)){

                    $arrayBur[] = $valB;

                    $arrayBurName[] = $br;

                }else{

                    continue;

                }
            }

            $this->burName = end($arrayBurName);
            
        }

        

        foreach($customerWaStatus as $waStatus)
        {
            $arrayWa = json_decode(json_encode($waStatus), true);
    
            foreach($arrayWa as $wa => $valW){

               if(!empty($valW)){

                    $arrayWan[] = $valW;

                    $arrayWanName[] = $wa;

                }else{

                    continue;

                }

            }

            $this->wanName = end($arrayWanName);
        }
    }

        //  dd($this->burName);

        // dd($request->call_situation.' = '.$request->status);

        $CustomerInformation = CustomerInformation::where(function ($query) use ($request) {

            $query->orWhere(function ($q) use($request) {
                
                if ($request->customer_id) 
                {
                    $q->where('customer_id', $request->customer_id);
                }

                if ($request->business_name) 
                {
                 $q->where('company_name', 'like', '%'. $request->business_name.'%'); 
                }
                
                if ($request->prefectures != '-') 
                {
                    $q->where('ad_prefectures', 'like', '%'. $request->prefectures.'%');
                }

                if ($request->municipality) 
                {
                    $q->where('ad_municipality', 'like', '%'. $request->municipality.'%');
                }

                if ($request->year_establish_from != '-' && $request->year_establish_from != '-') 
                {
                    $q->where(function ($years) use($request) {
                        $years->where('establishment_year', '>=' , $request->year_establish_from);
                        $years->where('establishment_year', '<=', $request->year_establish_to);
                    });
                }

                if ($request->sub_industry != '-') 
                {
                    $q->where('industry', 'like', '%'. $request->sub_industry.'%');
                }

                if ($request->number_employee_min != '-' && $request->number_employee_max != '-') 
                {

                    $q->where(function ($emp) use($request) {
                        $emp->where('employees_number', '>=' , $request->number_employee_min);
                        $emp->where('employees_number', '<=', $request->number_employee_max);
                    });
                }



                $q->where(function ($qs) use($request) {
        
                    if($request->call_situation === '業務精査')
                    {

                        $qs->where($this->burName, $request->status);

                    }else{

                        $qs->where($this->wanName, $request->status);
                    }

                });

                if($request->dm_sending_list != '-')
                {
                     $q->where('dm_sending_times', $request->dm_sending_list);
                }
               

                if ($request->contact_name) 
                {
                    $q->where('person_charge_name', 'like', '%'.$request->contact_name.'%');
                }

            });
            
            // ===BACKUP QUERY===
            // $query->where('company_name', 'like', '%'. $request->business_name.'%');
            // $query->where('ad_prefectures', 'like', '%'. $request->prefectures.'%');
            
            // $query->where('ad_municipality', 'like', '%'. $request->municipality.'%');

            // $query->where(function ($years) use($request) {
            //     $years->where('establishment_year', '>=' , $request->year_establish_from);
            //     $years->where('establishment_year', '<=', $request->year_establish_to);
            // });
            

            // $query->where('industry', 'like', '%'. $request->sub_industry.'%');

            // $query->where(function ($emp) use($request) {
            //     $emp->where('employees_number', '>=' , $request->number_employee_min);
            //     $emp->where('employees_number', '<=', $request->number_employee_max);
            // });
            // $query->where('dm_sending_times', $request->dm_sending_list);

            // $query->where('person_charge_name', 'like', '%'.$request->contact_name.'%');
            // ===BACKUP QUERY===

        })->paginate($request->paginate_count);
        
        return view('customer.customer_search_result', ['CustomerInformation' => $CustomerInformation, 'paginate_count' => $request->paginate_count])->render();
    }

    public function generateCSV (Request $request) 
    {

        //SQL QUERY FOR LATEST STATUS 

        $arrayBur = array();

        $arrayBurName = array();

        $arrayWan = array();

        $arrayWanName = array();

        if($request->call_situation != '-')
        
        {

        $customerBrStatus = CustomerInformation::where('customer_id',$request->customer_id)->get(['br_1st_status', 'br_2nd_status', 'br_3rd_status', 'br_4th_status', 'br_5th_status']);

        $customerWaStatus = CustomerInformation::where('customer_id',$request->customer_id)->get(['wa_1st_status', 'wa_2nd_status', 'wa_3rd_status', 'wa_4th_status', 'wa_5th_status']);
        
        

        foreach($customerBrStatus as $brStatus)
        {

            $arrayBr = json_decode(json_encode($brStatus), true);

         

            foreach($arrayBr as $br => $valB){

                if(!empty($valB)){

                    $arrayBur[] = $valB;

                    $arrayBurName[] = $br;

                }else{

                    continue;

                }
            }

            $this->burName = end($arrayBurName);
            
        }

        

        foreach($customerWaStatus as $waStatus)
        {
            $arrayWa = json_decode(json_encode($waStatus), true);
    
            foreach($arrayWa as $wa => $valW){

               if(!empty($valW)){

                    $arrayWan[] = $valW;

                    $arrayWanName[] = $wa;

                }else{

                    continue;

                }

            }

            $this->wanName = end($arrayWanName);
        }
    }

        $CustomerInformation = CustomerInformation::where(function ($query) use ($request) {
            $query->orWhere(function ($q) use($request) {
                
                if ($request->customer_id) 
                {
                    $q->where('customer_id', $request->customer_id);
                }

                if ($request->business_name) 
                {
                 $q->where('company_name', 'like', '%'. $request->business_name.'%'); 
                }
                
                if ($request->prefectures != '-') 
                {
                    $q->where('ad_prefectures', 'like', '%'. $request->prefectures.'%');
                }

                if ($request->municipality) 
                {
                    $q->where('ad_municipality', 'like', '%'. $request->municipality.'%');
                }

                if ($request->year_establish_from != '-' && $request->year_establish_from != '-') 
                {
                    $q->where(function ($years) use($request) {
                        $years->where('establishment_year', '>=' , $request->year_establish_from);
                        $years->where('establishment_year', '<=', $request->year_establish_to);
                    });
                }

                if ($request->sub_industry != '-') 
                {
                    $q->where('industry', 'like', '%'. $request->sub_industry.'%');
                }

                if ($request->number_employee_min != '-' && $request->number_employee_max != '-') 
                {

                    $q->where(function ($emp) use($request) {
                        $emp->where('employees_number', '>=' , $request->number_employee_min);
                        $emp->where('employees_number', '<=', $request->number_employee_max);
                    });
                }



                $q->where(function ($qs) use($request) {
        
                    if($request->call_situation === '業務精査')
                    {

                        $qs->where($this->burName, $request->status);

                    }else{

                        $qs->where($this->wanName, $request->status);
                    }

                });

                if($request->dm_sending_list != '-')
                {
                     $q->where('dm_sending_times', $request->dm_sending_list);
                }
               

                if ($request->contact_name) 
                {
                    $q->where('person_charge_name', 'like', '%'.$request->contact_name.'%');
                }
                
            });

        })->get();

        $filename = '顧客情報_' . date('Ymd');
        Excel::create($filename, function ($excel) use ($CustomerInformation) {
            $excel->sheet('customer informations', function ($sheet) use ($CustomerInformation) {
                $sheet->fromModel($CustomerInformation);
            })->download('xlsx');
        });
    }
}