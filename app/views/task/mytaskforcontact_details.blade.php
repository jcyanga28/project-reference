@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-10">

		<table style="width: 80%;font-size:12px;" id="detail_tbl_design" class="table table-hover">
		<tr>
			<td id="tbl_details_td">REQUEST NUMBER</td><td>{{ str_pad($details->id,10,'0',STR_PAD_LEFT) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">CONTACT PERSON</td><td>{{ strtoupper($details->fullname) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">REQUEST TYPE</td><td>{{ strtoupper($details->task) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">AMOUNT</td><td>{{ number_format($details->amount) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">START DATE</td><td>{{ date("m/d/Y", strtotime($details->date_start)) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">END DATE</td><td>{{ date("m/d/Y", strtotime($details->date_end)) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">REMARKS</td><td>{{ strtoupper($details->remarks) }}</td>
		</tr>
	</table> 

	<div>
			
		<span class="project_attachment_title">Files & Image attachment</span>
		<br/>

		@if(count($getattached)>0)	
			<table style="font-size: 12px; width: 60%;" class="table table-striped hover">
				<tr>
					<td><b>FILE/IMAGE NAME</b></td>
					<td><b>ACTION</b></td>
				</tr>
				@foreach($getattached as $filesrow)
					<tr>
						<td>{{ $filesrow->file_img}}</td>
						<td style="font-size: 12px;"><a href="/contact/download/{{ $filesrow->file_img }}">DOWNLOAD</a></td>
					</tr>
				@endforeach
			</table>
		@else
			<b style="font-size: 14px; margin-left: 10px;"> - No record found.</b>	
		
		@endif

	</div>
	<hr/>
	
	<div>
		{{ HTML::linkRoute('create.mytask', 'Back', array(), array('class' => 'btn btn-default')) }}
	</div>

 </div>

</div>

@stop	