@extends('layout.backend')

@section('content')

<div class="row">
	<div class="col-lg-12">

			<a href="javascript:history.back()" ><button type="button" id="button_design" class="btn btn-default btn_form_design"><i class="fa fa-arrow-left"></i> Back to previous page </button></a>
		  	<a href="{{ URL::route('assign.area.create') }}" class="btn btn-primary btn_form_design"><i class="fa fa-plus"></i> New BDO-Area </a>

	</div>
</div>
<br/><br/>

<div class="row">
	<div class="col-lg-12">
		{{ Form::open(array('method' => 'get','class' => 'form-inline')) }}
		 	<div class="form-group">
		 		{{ Form::text('s',Input::old('s'),array('class' => 'form-control', 'id' => 'search_input_form_design','placeholder' => 'Enter keyword')) }}
		  	</div>
		  	<button type="submit" class="btn btn-success btn_form_design"><i class="fa fa-search"></i> Process</button>	
		{{ Form::close() }}
	</div>
</div>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($assigned_area)>0)
		<span>{{ count($assigned_area) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>BDO</th>
						<th>BDO ASSIGNED AREA</th>
						<th colspan="2" style="text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($assigned_area) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($assigned_area as $row)				
					<tr>
						<td>{{ strtoupper($row->last_name) . ',' . ' ' . strtoupper($row->first_name) }}</td>
						<td>{{ strtoupper($row->area_place) }}</td>	
						<td class="action">
							{{ Form::open(array('method' => 'DELETE', 'route' => array('assign.area.destroy', $row->id))) }}                       
							{{ Form::submit('Delete', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to delete this record?')){return false;};")) }}
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				@endif

				</tbody>
			</table>

			<div id="pgntn_form_design" class="pagination"> {{ $assigned_area->links() }} </div> 
		</div>
	</div>
</div>

@stop