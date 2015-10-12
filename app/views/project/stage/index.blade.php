@extends('layout.backend')

@section('content')

<div class="row">
	<div class="col-lg-12">

			<a href="javascript:history.back()" ><button type="button" id="button_design" class="btn btn-default btn_form_design"><i class="fa fa-arrow-left"></i> Back to previous page </button></a>
		  	<a href="{{ URL::route('project.stage.create') }}" class="btn btn-primary btn_form_design"><i class="fa fa-plus"></i> New Project Stage</a>
	</div>
</div>
<br/>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($stages)>0)
		<span>{{ count($stages) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>PROJECT STAGE</th>
						<th>DESCRIPTION</th>
						<th colspan="2" style="text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($stages) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($stages as $row)				
					<tr>
						<td>{{ $row->stage }}</td>
						<td>{{ $row->description }}</td>
						<td class="action">
							{{ HTML::linkRoute('project.stage.edit','Update', $row->id, array('class' => 'btn btn-info btn-xs')) }}
						</td>
						<td class="action">
							{{ Form::open(array('method' => 'DELETE', 'route' => array('project.stage.destroy', $row->id))) }}                       
							{{ Form::submit('Delete', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to delete this record?')){return false;};")) }}
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				@endif

				</tbody>
			</table> 

		<div id="pgntn_form_design" class="pagination"> {{ $stages->links() }} </div>	
		</div>
	</div>
</div>

@stop