@extends('layout.backend')

@section('content')

<!-- Nav tabs -->
<ul style="font-family:Geo Sans Light; font-size: 13px;" class="nav nav-tabs">
<li class="active"><a href="#main" data-toggle="tab">MAIN</a></li>
<li><a href="#logs" data-toggle="tab">LOGS</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="main">
<br/>

<div class="row">
	<div class="col-lg-12">
		{{ Form::open(array('method' => 'get','class' => 'form-inline')) }}
		 	<div class="filter">
		  		<label>Filter by:</label>
		 		<br/>
		 		  <label class="radio-inline">	
		 		  <input type="radio" name="status" value="1" {{ Helper::oldRadio('status', '1', true) }}> For Approval &nbsp;&nbsp;&nbsp;
				  </label>
				  <label class="radio-inline">	
		 		  <input type="radio" name="status" value="2" {{ Helper::oldRadio('status', '2') }}> Approved &nbsp;&nbsp;&nbsp;
		  		  </label>
		  		  <label class="radio-inline">	
		 		  <input type="radio" name="status" value="3" {{ Helper::oldRadio('status', '3') }}> Denied &nbsp;&nbsp;&nbsp;
		  		  </label>				  		
		  	</div>
		 	<br/>

		 	<div class="form-group">
		 		{{ Form::text('s',Input::old('s'),array('class' => 'form-control', 'id' => 'search_input_form_design', 'placeholder' => 'Enter keyword')) }}
		  	</div>
		  	<button type="submit" class="btn btn-success btn_form_design"><i class="fa fa-search"></i> Process</button>	
		  	@if(Input::get('status') < 2)
		  		<a href="{{ URL::route('project.create') }}" class="btn btn-primary btn_form_design"><i class="fa fa-plus"></i> New Project</a>
			@endif
		{{ Form::close() }}
	</div>
</div>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($projects)>0)
		<span>{{ count($projects) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>PROJECT NAME</th>
						<th>PROJECT OWNER</th>
						<th>PAINTING DATE</th>
						<th>ASSIGNED BDO</th>
					@if(Input::get('status') < 3)
						<th colspan="2" style="text-align:center;">Action</th>
					@endif
					</tr>
				</thead>
				<tbody>
				
				@if(count($projects) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($projects as $row)				
					<tr>
						<td style="width: 25%;">{{ strtoupper($row->project_name) }}</td>
						<td style="width: 25%;">{{ strtoupper($row->project_owner) }}</td>
						@if($row->painting_dtstart == "0000-00-00")
							<?php $dtstart =  "--/--/----"; ?>
						@else
							<?php $dtstart = date("m/d/Y", strtotime($row->painting_dtstart)); ?>
						@endif
						@if($row->painting_dtend == "0000-00-00")
							<?php $dtend = "--/--/----"; ?>
						@else
							<?php $dtend = date("m/d/Y", strtotime($row->painting_dtend)); ?>
						@endif		
						<td style="width: 25%;">{{ $dtstart . ' ' . 'TO' . ' ' . $dtend }}</td>
						<td style="width: 25%;">{{ strtoupper($row->first_name) . ' ' . strtoupper($row->last_name) }}</td>
						<td class="action">
							{{ HTML::linkRoute('project.dt','Details', $row->id, array('class' => 'btn btn-warning btn-xs')) }}
						</td>
					@if($row->status < 3)	
						<td class="action">
							{{ HTML::linkRoute('project.edit','Update', $row->id, array('class' => 'btn btn-info btn-xs')) }}
						</td>
					@endif
					@if($row->status < 2)
						<td class="action">
							{{ Form::open(array('method' => 'DELETE', 'route' => array('project.destroy', $row->id))) }}                       
							{{ Form::submit('Delete', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to delete this record?')){return false;};")) }}
							{{ Form::close() }}
						</td>
					@endif		
					</tr>
					@if($row->status == 3)	
					<tr>
						<td><b style="font-size: 11px; color: #666;">REASON :</b> &nbsp;<span style="font-size: 11px; color: #666;">{{ $row->remarks }}</span></td>
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

		<div id="pgntn_form_design" class="pagination"> {{ $projects->links() }} </div>	
		</div>
	</div>
</div>

</div>

<div class="tab-pane" id="logs">
<br/>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>HISTORY</th>
						<th>DATE & TIME</th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($project_stats) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($project_stats as $row)				
					<tr>
						<td style="width: 85%;color:#000;font-weight:bold;">{{ strtoupper($row->update) }}</td>
						<td style="width:25%;">&nbsp;{{ date('m/d/Y H:i:s', strtotime($row->created_at)) }}</td>
					</tr>
					@endforeach
				@endif

				</tbody>
			</table> 

		</div>
	</div>
</div>

</div>
</div>
<br/>

@stop