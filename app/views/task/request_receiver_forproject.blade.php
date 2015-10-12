@extends('layout.backend')

@section('content')

<!-- Nav tabs -->
<ul style="font-family:Geo Sans Light; font-size: 13px;" class="nav nav-tabs">
<li><a href="{{URL::route('task.request.receiver.forcontact')}}">CONTACT </a></li>
<li><a href="{{URL::route('task.request.receiver.forcompany')}}">COMPANY</a></li>
<li class="active"><a href="{{URL::route('task.request.receiver.forproject')}}">PROJECT</a></li>
<li><a href="{{URL::route('task.request.receiver.forothers')}}">OTHERS</a></li>
</ul>

<br/>
<div class="row">
	<div class="col-lg-12">
		{{ Form::open(array('method' => 'get','class' => 'form-inline')) }}
		 	<div class="filter">
		  		<label>Filter by:</label>
		 		<br/>
		 		  <label class="radio-inline">	
		 		  <input type="radio" name="status" value="1" {{ Helper::oldRadio('status', '1',Input::get('status') == '1') }}> For Approval &nbsp;&nbsp;&nbsp;
				  </label>
				  <label class="radio-inline">	
		 		  <input type="radio" name="status" value="2" {{ Helper::oldRadio('status', '2',Input::get('status') == '2') }}> Approved &nbsp;&nbsp;&nbsp;
		  		  </label>
		  		  <label class="radio-inline">	
		 		  <input type="radio" name="status" value="3" {{ Helper::oldRadio('status', '3',Input::get('status') == '3') }}> Denied &nbsp;&nbsp;&nbsp;
		  		  </label>				  		
		  	</div>
		 	<br/>

		 	<div class="form-group">
		 		{{ Form::text('s',Input::old('s'),array('class' => 'form-control', 'id' => 'search_input_form_design', 'placeholder' => 'Enter keyword')) }}
		  	</div>
		  	<button type="submit" class="btn btn-success btn_form_design"><i class="fa fa-search"></i> Process</button>	
		  
		{{ Form::close() }}
	</div>
</div>
<br/>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($task_request)>0)
		<span>{{ count($task_request) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th><b>PROJECT</b></th>
						<th><b>REQUEST TYPE</b></th>
						<th><b>REMARKS</b></th>
						<th><b>PREPARED BY</b></th>
						<th colspan="2" style="text-align:center;"><b>ACTION</b></th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($task_request) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($task_request as $row)				
					<tr>
						<td style="width: 20%;"><b>{{ strtoupper($row->project_name) }}</b></td>
						<td style="width: 20%;"><b>{{ strtoupper($row->task) }}</b></td>
						<td style="width: 40%;"><b>{{ strtoupper($row->remarks) }}</b></td>
						<td style="width: 20%;"><b>{{ strtoupper($row->first_name) . ' ' . strtoupper($row->last_name) }}</b></td>
						<td class="action">
							{{ HTML::linkRoute('task.request.forproject.details','Details', $row->id, array('class' => 'btn btn-warning btn-xs')) }}
						</td>
					</tr>
					@endforeach
				@endif

				</tbody>
			</table> 

		</div>
	</div>
</div>

@stop