@extends('layouts.main')


@section('content')
	<div id="masthead" class="site-header">
		<h1>更新画面</h1>
	</div> <!-- .site-header -->
	
	<div class="site-main" role="main">

	@if(Session::has('error'))

		<p>{{Session::get('error')}}</p>

	@endif

	@if(Session::has('success'))

		<p>{{Session::get('success')}}</p>

	@endif

	<form action="{{ route('customer_update', $customerInformation->customer_id )}}" method="POST">
	{{ csrf_field() }}
		<div class="update-info">
			<div class="group">
				<h2>【基本情報】</h2>
				<dl class="first">
					<dt>顧客ID</dt>
					<dd>
						<input type="text" value="{{$customerInformation->customer_id}}" disabled />
					</dd>

					<div class="button">
						<button class="btn-blue">更新</button>
						<a href="{{route('customer_search')}}" class="btn-blue">戻る</a>
					</div>
				</dl>

				<dl>
					<dt>登録日</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->entry_date }}" disabled />
					</dd>

					<dt>更新日</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->update_date }}" disabled />
					</dd>
				</dl>
			</div>

			<div class="group">
				<h2>【自社情報】</h2>
				<dl class="first">
					<dt>担当者</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->person_charge_name }}" name="person_charge_name"/>
					</dd>
				</dl>
			</div>

			<div class="group">
				<h2>【顧客情報】</h2>
				<dl class="first">
					<dt>企業名</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->company_name }}" name="company_name"/>
					</dd>

					<dt>電話番号</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->company_phone }}" name="company_phone"/>
					</dd>
				</dl>

				<dl>
					<dt>URL</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->company_url }}" name="company_url"/>
					</dd>

					<dt>メールアドレス</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->company_mail }}" name="company_mail"/>
					</dd>
				</dl>

				<dl>
					<dt>住所</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->ad_street }}" name="ad_street"/>
					</dd>
				</dl>

				<dl>
					<dt>都道府県</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->ad_prefectures }}" name="ad_prefectures"/>
					</dd>

					<dt>市区町村</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->ad_municipality }}" name="ad_municipality"/>
					</dd>

					<dt>最寄駅</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->closest_station }}" name="closest_station"/>
					</dd>
				</dl>

				<dl>
					<dt>業種</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->industry }}" name="industry"/>
					</dd>

					<dt>設立年</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->establishment_year }}" name="establishment_year"/>
					</dd>

					<dt>従業員数</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->employees_number }}" name="employees_number"/>
					</dd>
				</dl>
			</div>

			<div class="group">
				<h2>【業務精査】</h2>
				<dl class="first">
					<dt>先方担当署</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_department_charge }}" name="br_department_charge" />
					</dd>

					<dt>担当者名</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_contact_name }}" name="br_contact_name"/>
					</dd>
				</dl>

				<dl>
					<dt>回数</dt>
					<dt class="head">架電日</dt>
					<dt class="head">架電時間</dt>
					<dt class="head">対話内容</dt>
					<dt class="head">ステータス</dt>
					<dt class="head">NG理由</dt>
				</dl>

				<dl>
					<dt>初回</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_1st_call_date }}" name="br_1st_call_date"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_1st_hanging_time }}" name="br_1st_hanging_time"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_1st_dialogue_content }}" name="br_1st_dialogue_content"/>
					</dd>
					<dd>
						<select name="br_1st_status">
							<option value="{{ $customerInformation->br_1st_status }}">{{ $customerInformation->br_1st_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_1st_ng_reason }}" name="br_1st_ng_reason"/>
					</dd>
				</dl>

				<dl>
					<dt>2回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_2nd_call_date }}" name="br_2nd_call_date" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_2nd_hanging_time }}" name="br_2nd_hanging_time" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_2nd_dialogue_content }}" name="br_2nd_dialogue_content" />
					</dd>
					<dd>
						<select name="br_2nd_status">
							<option value="{{ $customerInformation->br_2nd_status }}">{{ $customerInformation->br_2nd_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_2nd_ng_reason }}" name="br_2nd_ng_reason" />
					</dd>
				</dl>

				<dl>
					<dt>3回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_3rd_call_date }}" name="br_3rd_call_date" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_3rd_hanging_time }}" name="br_3rd_hanging_time" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_3rd_dialogue_content }}" name="br_3rd_dialogue_content" />
					</dd>
					<dd>
						<select name="br_3rd_status">
							<option value="{{ $customerInformation->br_3rd_status }}">{{ $customerInformation->br_3rd_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_3rd_ng_reason }}" name="br_3rd_ng_reason" />
					</dd>
				</dl>

				<dl>
					<dt>4回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_4th_call_date }}" name="br_4th_call_date" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_4th_hanging_time }}" name="br_4th_hanging_time" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_4th_dialogue_content }}" name="br_4th_dialogue_content" />
					</dd>
					<dd>
						<select name="br_4th_status" >
							<option value="{{ $customerInformation->br_4th_status }}">{{ $customerInformation->br_4th_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_4th_ng_reason }}" name="br_4th_ng_reason"  />
					</dd>
				</dl>

				<dl>
					<dt>5回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->br_5th_call_date }}" name="br_5th_call_date" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_5th_hanging_time }}" name="br_5th_hanging_time" />
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_5th_dialogue_content }}" name="br_5th_dialogue_content"  />
					</dd>
					<dd>
						<select name="br_5th_status" >
							<option value="{{ $customerInformation->br_5th_status }}">{{ $customerInformation->br_5th_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->br_5th_ng_reason }}" name="br_5th_ng_reason" />
					</dd>
				</dl>
			</div>

			<div class="group">
				<h2>【wantedly】</h2>
				<dl class="first">
					<dt>先方担当署</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_department_charge }}" name="wa_department_charge" />
					</dd>

					<dt>担当者名</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_contact_name }}" name="wa_contact_name" />
					</dd>
				</dl>

				<dl>
					<dt>回数</dt>
					<dt class="head">架電日</dt>
					<dt class="head">架電時間</dt>
					<dt class="head">対話内容</dt>
					<dt class="head">ステータス</dt>
					<dt class="head">NG理由</dt>
				</dl>

				<dl>
					<dt>初回</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_1st_call_date }}" name="wa_1st_call_date"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_1st_hanging_time }}" name="wa_1st_hanging_time"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_1st_dialogue_content }}" name="wa_1st_dialogue_content"/>
					</dd>
					<dd>
						<select name="wa_1st_status">
							<option value="{{ $customerInformation->wa_1st_status }}">{{ $customerInformation->wa_1st_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_1st_ng_reason }}" name="wa_1st_ng_reason"/>
					</dd>
				</dl>

				<dl>
					<dt>2回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_2nd_call_date }}" name="wa_2nd_call_date"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_2nd_hanging_time }}" name="wa_2nd_hanging_time"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_2nd_dialogue_content }}" name="wa_2nd_dialogue_content"/>
					</dd>
					<dd>
						<select name="wa_2nd_status">
							<option value="{{ $customerInformation->wa_2nd_status }}">{{ $customerInformation->wa_2nd_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_2nd_ng_reason }}" name="wa_2nd_ng_reason"/>
					</dd>
				</dl>

				<dl>
					<dt>3回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_3rd_call_date }}" name="wa_3rd_call_date"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_3rd_hanging_time }}" name="wa_3rd_hanging_time"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_3rd_dialogue_content }}" name="wa_3rd_dialogue_content"/>
					</dd>
					<dd>
						<select name="wa_3rd_status">
							<option value="{{ $customerInformation->wa_3rd_status }}">{{ $customerInformation->wa_3rd_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_3rd_ng_reason }}" name="wa_3rd_ng_reason"/>
					</dd>
				</dl>

				<dl>
					<dt>4回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_4th_call_date }}" name="wa_4th_call_date"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_4th_hanging_time }}" name="wa_4th_hanging_time"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_4th_dialogue_content }}" name="wa_4th_dialogue_content"/>
					</dd>
					<dd>
						<select name="wa_4th_status">
							<option value="{{ $customerInformation->wa_4th_status }}">{{ $customerInformation->wa_4th_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_4th_ng_reason }}" name="wa_4th_ng_reason"/>
					</dd>
				</dl>

				<dl>
					<dt>5回目</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_5th_call_date }}" name="wa_5th_call_date"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_5th_hanging_time }}" name="wa_5th_hanging_time"/>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_5th_dialogue_content }}" name="wa_5th_dialogue_content"/>
					</dd>
					<dd>
						<select name="wa_5th_status">
							<option value="{{ $customerInformation->wa_5th_status }}">{{ $customerInformation->wa_5th_status }}</option>
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</dd>
					<dd>
						<input type="text" value="{{ $customerInformation->wa_5th_ng_reason }}" name="wa_5th_ng_reason"/>
					</dd>
				</dl>
			</div>

			<div class="group">
				<h2>【フラグ情報】</h2>
				<dl class="first">
					<dt>Wantedly掲載有無</dt>
					<dd>
					@if($customerInformation->wa_presence_absence != 0)
						<span><input type="radio" value="{{ $customerInformation->wa_presence_absence }}" name="wa_presence_absence" checked="checked"/> 有</span>
						<span><input type="radio" value="0" name="wa_presence_absence"/> 無</span>
					@else
						<span><input type="radio" value="1" name="wa_presence_absence" /> 有</span>
						<span><input type="radio" value="{{ $customerInformation->wa_presence_absence }}" name="wa_presence_absence" checked="checked"/> 無</span>
					@endif
					</dd>
					<dt>DM送付回数</dt>
					<dd>
						<input type="text" value="{{$customerInformation->dm_sending_times}}" name="dm_sending_times"/>
					</dd>
				</dl>
				<dl>
					<dt>資料送付有無</dt>
					<dd>
					@if($customerInformation->sm_presence_absence != 0)
						<span><input type="radio" value="{{ $customerInformation->sm_presence_absence }}" name="sm_presence_absence" checked="checked"/> 有</span>
						<span><input type="radio" value="0" name="sm_presence_absence"/> 無</span>
					@else
						<span><input type="radio" value="1" name="sm_presence_absence" /> 有</span>
						<span><input type="radio" value="{{ $customerInformation->sm_presence_absence }}" name="sm_presence_absence" checked="checked"/> 無</span>
					@endif

					</dd>
					<dt>資料送付タイプ</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->sm_type }}" name="sm_type"/>
					</dd>
				</dl>
				<dl>
					<dt>飛込実施有無</dt>
					<dd>
					@if($customerInformation->ji_presence_absence != 0)
						<span><input type="radio" value="{{ $customerInformation->ji_presence_absence }}" name="ji_presence_absence" checked="checked"/> 有</span>
						<span><input type="radio" value="0" name="ji_presence_absence"/> 無</span>
					@else
						<span><input type="radio" value="1" name="ji_presence_absence" /> 有</span>
						<span><input type="radio" value="{{ $customerInformation->ji_presence_absence }}" name="ji_presence_absence" checked="checked"/> 無</span>
					@endif
					</dd>
					<dt>トーク分類</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->talk_classification }}" name="talk_classification"/>
					</dd>
				</dl>
			</div>

			<div class="group">
				<h2>【アプローチNG情報】</h2>
				<dl class="first">
					<dt>アプローチ状態</dt>
					<dd>
					@if($customerInformation->ng_flag != 1)
						<span><input type="radio" value="{{ $customerInformation->ng_flag }}" name="ng_flag" checked="checked"/> OK</span>
						<span><input type="radio" value="1" name="ng_flag"/> NG</span>
					@else
						<span><input type="radio" value="0" name="ng_flag" /> OK</span>
						<span><input type="radio" value="{{ $customerInformation->ng_flag }}" name="ng_flag" checked="checked"/> NG</span>
					@endif
					</dd>
					<dt>企業名(名寄せ)</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->company_name_id }}" name="company_name_id"/>
					</dd>
				</dl>
				<dl>
					<dt>アプローチNG理由</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->ng_reason }}" name="ng_reason"/>
					</dd>
				</dl>
				<dl>
					<dt>取引内容</dt>
					<dd>
						<input type="text" value="{{ $customerInformation->transaction_contents }}" name="transaction_contents"/>
					</dd>
				</dl>
			</div>
		</div>
	</form>
	</div> <!-- .site-main -->
	


<div id="colophon" class="site-footer" role="contentinfo">

</div> <!-- .site-footer -->

@endsection


@section('scripts')
<script>
    function update(){
        alert('Update Btn');
    }

    // function back(){
    //     // data = {
    //     //     a : Math.floor((Math.random() * 3) + 1),
    //     //     b : Math.floor((Math.random() * 3) + 1),
    //     //     c : Math.floor((Math.random() * 3) + 1)
    //     // }
    //     // if(data.a === data.b && data.b === data.c){
    //     //     console.log('Matched!...'+data.a+" , "+data.b+" , "+data.c);
    //     // }else{
    //     //     console.log(data);
    //     // }
	// 	window.location.href="{{route('customer_search')}}";
        
    // }
    //setInterval(back, 1000);
</script>
@endsection