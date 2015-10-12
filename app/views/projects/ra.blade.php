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
		 		  <input type="radio" name="status" value="1" {{ Helper::oldRadio('status', '1', true) }}> Request/s &nbsp;&nbsp;&nbsp;
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
		 		{{ Form::text('s',Input::old('s'),array('class' => 'form-control', 'placeholder' => 'Enter keyword')) }}
		  	</div>
		  	<button type="submit" class="btn btn-success btn_form_design"><i class="fa fa-search"></i> Process</button>	
		{{ Form::close() }}
	</div>
</div>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($project)>0)
		<span>{{ count($project) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>PREPARED BY</th>
						<th>PROJECT NAME</th>
						<th>PROJECT OWNER</th>
						<th>PAINTING DATE</th>
						<th>ASSIGNED BDO</th>
						<th colspan="2" style="text-align:center;">Action</th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($project) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($project as $row)				
					<tr>
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
						<td>{{ strtoupper($row->prep_fname) . ' ' . strtoupper($row->prep_lname) }}</td>
						<td>{{ strtoupper($row->project_name) }}</td>
						<td>{{ strtoupper($row->project_owner) }}</td>
						<td>{{ $dtstart . ' ' . 'TO' . ' ' . $dtend }}</td>
						<td>{{ strtoupper($row->bdo_fname) . ' ' . strtoupper($row->bdo_lname) }}</td>
						<td class="action">
							{{ HTML::linkRoute('ra.project.dt','Details', $row->id, array('class' => 'btn btn-warning btn-xs')) }}
						</td>
					<!--@if($row->status == 1)	
						<td class="action">
							{{ Form::open(array('method' => 'PUT', 'route' => array('company.a', $row->id))) }}                       
							{{ Form::submit('Approve', array('class'=> 'btn btn-info btn-xs','onclick' => "if(!confirm('Are you sure to approve this record?')){return false;};")) }}
							{{ Form::close() }}
						</td>
						<td class="action">
							{{ Form::open(array('method' => 'PUT', 'route' => array('company.d', $row->id))) }}                       
							{{ Form::submit('Denied', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to deny this record?')){return false;};")) }}
							{{ Form::close() }}
						</td>
					@endif-->	
					</tr>
					@if($row->status == 3)	
					<tr>
						<td><b style="font-size: 11px; color: #666;">REASON :</b> &nbsp;<span style="font-size: 11px; color: #666;">{{ $row->remarks }}</span></td>
						<td></td>
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

		<div id="pgntn_form_design" class="pagination"> {{ $project->links() }} </div>		 
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
				
				@if(count($project_status) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($project_status as $row)
						@if($row->access == '1')
							<?php $styles = 'width: 85%;color:blue;font-weight:bold;'; ?>	
						@else
							<?php $styles = 'width: 85%;color:#000;font-weight:bold;'; ?>
						@endif						
					<tr>
						<td style="{{ $styles }}">{{ strtoupper($row->history) }}</td>
						<td style="width: 25%;">&nbsp;{{ date('m/d/Y H:i:s', strtotime($row->created_at)) }}</td>
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