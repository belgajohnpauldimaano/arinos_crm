﻿@extends('layouts.main')

@section('content')

<div id="masthead" class="site-header">
    <h1>ファイル取込画面</h1>
</div> <!-- .site-header -->


<div class="site-main" role="main">
		<div class="customer-search">
			<form id="search_form" action="{{ route('generateCSV') }}">
				{{ csrf_field() }}
				<div class="field-row">
					<label>
						<span>顧客ID</span>
						<input type="text" value="" name="customer_id" />
					</label>
					<label>
						<span>企業名</span>
						<input type="text" value="" name="business_name" />
					</label>
					<label class="last">
						<span>都道府県</span>
						<select name="prefectures">
							@foreach($prefectures as $val)
								<option value="{{ $val }}">{{ $val }}</option>
							@endforeach
						</select>
					</label>
				</div>

				<div class="field-row">
					<label>
						<span>市区町村</span>
						<input type="text" value="" name="municipality" />
					</label>
					<label class="last">
						<span>業種</span>
						<select name="major_industry" id="major_industry">
							@foreach($industry_major as $val)
								<option value="{{ $val }}">{{ $val }}</option>
							@endforeach
						</select>
						<select name="sub_industry" id="sub_industry">
						</select>
					</label>
				</div>

				<div class="field-row">
					<label>
						<span>設立年</span>
						<select name="year_establish_from">
							<option value="-">-</option>
							@for($i=1900;$i<=2100;$i+=10)
								<option value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>&nbsp;&nbsp;～&nbsp;&nbsp;&nbsp;
						<select name="year_establish_to">
							<option value="-">-</option>
							@for($i=1900;$i<=2100;$i+=10)
								<option value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>
					</label>

					<label class="last">
						<span>架電状況</span>
						<select name="call_situation">
							<option value="-">-</option>
							<option value="業務精査">業務精査</option>
							<option value="wantedly">wantedly</option>
						</select>
						<select class="second" name="status">
							<option value="未架電">未架電</option>
							<option value="架電済_非接触">架電済_非接触</option>
							<option value="架電済_要架電">架電済_要架電</option>
							<option value="架電済_NG(先方判断)">架電済_NG(先方判断)</option>
							<option value="架電済_NG(自社判断)">架電済_NG(自社判断)</option>
							<option value="架電済_アポ取得">架電済_アポ取得</option>
						</select>
					</label>
				</div>
				<?php 
					$emp_nums = [
						1,5,10,50,100,150,200,250,300,400,500,1000,5000,10000
					];
				?>
				<div class="field-row">
					<label>
						<span>従業員数</span>
						<select name="number_employee_min">
							<option value="-">-</option>
							@foreach($emp_nums as $val)
								<option value="{{ $val }}">{{ $val }}</option>
							@endforeach
						</select>&nbsp;&nbsp;～&nbsp;&nbsp;&nbsp;
						<select name="number_employee_max">
							<option value="-">-</option>
							@foreach($emp_nums as $val)
								<option value="{{ $val }}">{{ $val }}</option>
							@endforeach
						</select>
					</label>
					<label class="last">
						<span>DM送付回数</span>
						<select name="dm_sending_list">
							<option value="-">-</option>
							@for($i=0;$i<=5;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>
					</label>
				</div>

				<div class="field-row">
					<label>
						<span>担当者名</span>
						<input type="text" value="" name="contact_name" />
					</label>
					
					<div class="buttons">
						<input type="button" class="btn-blue" value="検索" id="btn_search" />
						<button type="submit" class="btn-blue"  disabled  id="export_csv">CSV</button>
						<a href="{{ route('main') }}" class="btn-blue">戻る</a>
					</div>
				</div>
			</form>
				<div id="search_result">
					<table class="list-table">
						<thead>
							<tr>
								<th>顧客ID</th>
								<th>企業名</th>
								<th>都道府県</th>
								<th>市区町村</th>
								<th>業種</th>
								<th>設立年</th>
								<th>従業員数</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div class="pagination">
						<div class="paging">
							<a href="#" class="btn-blue page-first">&laquo;</a>
							<a href="#" class="btn-blue page-prev">&lsaquo;</a>
							<a href="#" class="btn-blue page-next">&rsaquo;</a>
							<a href="#" class="btn-blue page-last">&raquo;</a>
							<p class="page-of">
								<input type="text" value="9999">
								<span>&nbsp;/ <b>XX</b>ページ</span>
							</p>
							<a href="#" class="btn-blue to-change">変更</a>
						</div>
						<div class="pages">
							<select name="paginate_count" id="paginate_count">
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100" selected="selected">100</option>
								<option value="500">500</option>
								<option value="1000">1000</option>
							</select>
							<a href="#" class="btn-blue">変更</a>
						</div>
					</div>
			</div>
		</div>
</div>
@endsection


@section('scripts')
	<script>
		$(function () {
			search_data(1);
			$('#major_industry').change();
		});

		$('body').on('submit', '#search_form', function (e) {
			//e.preventDefault();
			//search_data();
		});

		$('body').on('click', '#btn_search', function () {
			search_data(1);
		});
		
		$('body').on('click', '#change_page', function () {
			var p = $('#input_page').val();
			search_data(p);
		})

		$('body').on('click', '#change_page_count', function () {
			search_data(1);
		});

		$('body').on('change', '#major_industry', function () {
			var val = $(this).val();
			$.ajax({
				url  : "{{ route('search_minor_industry') }}",
				type : 'GET',
				data : {industry : val},
				dataType : 'json',
				success : function (data) {
					var options = '';
					for(var i in data){
						options += '<option>'+ data[i] +'</option>';
					}
					$('#sub_industry').empty().append(options)
				}
			});
		});

		function search_data (page) 
		{
			var formData = new FormData($('#search_form')[0]);
			formData.append('paginate_count', $('#paginate_count').val());
			formData.append('page', page);
			$.ajax({
				url : "{{ route('search_customer') }}",
				type : 'POST',
				data : formData,
				processData : false,
				contentType : false,
				success : function (data) {
					$('#search_result').empty().append(data);
				}
			});
		}

	</script>
@endsection
