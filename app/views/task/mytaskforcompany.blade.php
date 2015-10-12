@extends('layout.backend')

@section('content')

<!-- Nav tabs -->
<ul style="font-family:Geo Sans Light; font-size: 13px;" class="nav nav-tabs">
<li><a href="{{URL::route('create.mytask')}}">CONTACT</a></li>
<li class="active"><a href="{{URL::route('create.mytask.company')}}">COMPANY</a></li>
<li><a href="{{URL::route('create.mytask.project')}}">PROJECT</a></li>
<li><a href="{{URL::route('create.mytask.others')}}">OTHERS</a></li>
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
		  	@if(Input::get('status') < 2)
		  		<a href="{{ URL::route('newtask.forcompany') }}" class="btn btn-primary btn_form_design"><i class="fa fa-plus"></i> New Task</a>
			@endif
		{{ Form::close() }}
	</div>
</div>
<br/>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($mytask_forcompany)>0)
		<span>{{ count($mytask_forcompany) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>


<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th><b>COMPANY NAME</b></th>
						<th><b>REQUEST TYPE</b></th>
						<th><b>REMARKS</b></th>
						<th colspan="2" style="text-align:center;"><b>ACTION</b></th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($mytask_forcompany) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($mytask_forcompany as $row)				
					<tr>
						<td style="width: 25%;"><b>{{ strtoupper($row->company_name) }}</b></td>
						<td style="width: 25%;"><b>{{ strtoupper($row->task) }}</b></td>
						<td style="width: 50%;"><b>{{ strtoupper($row->remarks) }}</b></td>
						<td class="action">
							{{ HTML::linkRoute('task.forcompany.details','Details', $row->id, array('class' => 'btn btn-warning btn-xs')) }}
						</td>
					@if($row->status == 1)	
						<td class="action">
							{{ HTML::linkRoute('task.forcompany.edit','Update', $row->id, array('class' => 'btn btn-info btn-xs')) }}
						</td>
					@endif
					@if($row->status == 1)
						<td class="action">

							{{ Form::open(array('method' => 'DELETE', 'route' => array('task.forcompany.destroy', $row->id))) }}                       
							{{ Form::submit('Delete', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to delete this record?')){return false;};")) }}
							{{ Form::close() }}
						</td>
					@endif	
					</tr>
					@if($row->status == 2)	
					<tr>
						<td><b style="font-size: 11px; color: #666;">APPROVED AMOUNT :</b> &nbsp;<span style="font-size: 12px; color: green;"><b>{{ $row->final_amount }}</b></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@elseif($row->status == 3)
					<tr>
						<td><b style="font-size: 11px; color: #666;">REMARKS</b> &nbsp;<span style="font-size: 11px; color: #666;">{{ $row->comments }}</span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@endif
					@endforeach
				@endif

				</tbody>
			</table> 

		</div>
	</div>
</div>

@stop