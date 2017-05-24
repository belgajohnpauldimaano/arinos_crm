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
                    @foreach($CustomerInformation as $value)
                        <tr>
                            <td> {{ $value->customer_id }} </td>
                            <td> {{ $value->company_name }} </td>
                            <td> {{ $value->ad_prefectures }} </td>
                            <td> {{ $value->ad_municipality }} </td>
                            <td> {{ $value->industry }} </td>
                            <td> {{ $value->establishment_year }} </td>
                            <td> {{ $value->employees_number }}</td>
                            <td class="buttons"><a href="{{ route('file_update', $value->customer_id) }}" class="btn-blue">更新</a></td>
                        </tr>
                    @endforeach
				</tbody>
			</table>

			{{ $CustomerInformation->links('customer.customer_search_pagination') }}
			
                    <script>
                        $('#paginate_count').val("{{ $paginate_count }}");
                @if($CustomerInformation->count() > 0)
                        $('#export_csv').removeAttr('disabled');
				@else 
                        $('#export_csv').prop('disabled', true);
                @endif
                    </script>

