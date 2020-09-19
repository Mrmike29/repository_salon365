
@if(empty($tipo))
	<table id="table_notes" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
		<tbody id="report-filter">
			@foreach($notesPeriod as $key => $value)
				<tr data-value="{{$key}}">
					<th colspan="2" style="text-align: center;">{{$key}}</th>
				</tr>
				<tr>
					<th>Asignatura</th>
					<th>Nota</th>
				</tr>
				@foreach($value as $k => $val)
					<tr data-subject="{{$k}}" data-value="{{$key}}">
						<td>{{$k}}</td>
						<td>{{$val}}</td>
					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
@else
	<table id="table_notes" class="table school-table" style="border-radius: 10px; box-shadow: 0 10px 15px rgba(181, 181, 181, 0.8);">
		<thead>
			<tr>
				<th>Asignatura</th>
				<th>Nota</th>
			</tr>
		</thead>
		<tbody id="report-filter">
			@foreach($notesAnual as $key => $value)
				<tr data-subject="{{$key}}" data-value="{{$value}}">
					<td>{{$key}}</td>
					<td>{{$value}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif