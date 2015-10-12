@extends('layout.backend')

@section('content')

<div class="row">
	<div class="col-lg-12">
		{{ Form::open(array('method' => 'get','class' => 'form-inline')) }}
		 	<div class="proj_form">

				 <div class="proj_form_container" >
				 	<div style="margin-left: 50px;" class="filter">
				  		  <label class="radio-inline proj_form_label">	
				 		  	<input class="proj_form_radio" type="radio" name="status" value="2" {{ Helper::oldRadio('status', '2', Input::get('status') == '2')}} > PENDING &nbsp;&nbsp;&nbsp;
				  		  </label>
				  		  <label class="radio-inline proj_form_label">	
				 		  	<input class="proj_form_radio" type="radio" name="status" value="0" {{ Helper::oldRadio('status', '0', Input::get('status') == '0' )}} > CLOSED &nbsp;&nbsp;&nbsp;
				  		  </label>
				  		  <label class="radio-inline proj_form_label">	
				 		  	<input class="proj_form_radio" type="radio" name="status" value="4" {{ Helper::oldRadio('status', '4', Input::get('status') == '4' )}} > ALL &nbsp;&nbsp;&nbsp;
				  		  </label>				  		
				  	</div>

				 	<div class="form-group">
				 	Search&nbsp;	{{ Form::text('s',Input::old('s'),array('class' => 'form-control', 'id' => 'search_input_form_designs', 'placeholder' => 'Enter keyword')) }}

				  	</div>
				  		<button type="submit" class="btn btn-success btn_form_design"><i class="fa fa-search"></i> Search</button>	
			 	
			 	</div>
			 	<br/>

		 	</div>
		{{ Form::close() }}				 
	</div>
</div>
<br/>

<div class="row">
	<div class="col-lg-12">
		 	
		 	<div class="proj_form_legend">
		 	
		 	<div style="margin-left: 40px; margin-top:10px; ">LEGEND</div>
		 		<ul id="legend">
					<li><span class="l_1">.</span> Update Status/ Create thread.&nbsp;</li>
					<li>&nbsp;&nbsp;<span class="l_2" >.</span> Normal Painting-Date.</li>
					<li>&nbsp;&nbsp;<span class="l_3" >.</span> Already Over-Date.</li>
					<li>&nbsp;&nbsp;<span class="l_4" >.</span> Returned/ Closed the project.</li>
				</ul>
		 	</div>
	</div>
</div>
<br/>

<div class="proj_list">

	<div id="count_result" class="row">
		<div style="font-size: 16px;" class="col-lg-12">
			<span>{{ count($myprojectlist_count) }}</span> record/s found &nbsp;
		</div> 	
	</div>
	<br/>

	<table class="table table-hover" id="proj_list_table">
	
		<tr id="proj_list_tblhead">
			<td></td>
			<td>PROJECT NAME</td>
			<td>PROJECT OWNER</td>
			<td>PAINTING DATE</td>
			@if(Session::get('role') == 1 || Session::get('role') == 2)
			<td>ACTION</td>
			@endif
		</tr>
		
	@if(count($myprojectlist_count) == 0)	
		<tr>
			<td colspan="4">No record found!</td>
		</tr>
		
		@else
		@foreach($myprojectlist as $row)
		<tr @if($row->status == 0) style="background-color: gray;"@endif>
			<td>
				@if($row->status_forthread == 1 && $row->status > 0)
				<b>

					<a href="../myprojects/<?php echo $row->id; ?>/status" 
					<?php if($row->status == 2){ ?>
                    	class="proj_id"
                    <?php }elseif($row->status == 0){ ?>
                    	style="color:#000;font-weight:bold;"
                    <?php } ?>
					>{{ str_pad($row->id,10,'0',STR_PAD_LEFT) }}</a>

				</b>
				@else
				<b>
					<!-- ../closed-project/<?php echo $row->id; ?>/information -->
					<a href="#" 
					<?php if($row->status == 2){ ?>
                    	class="proj_id"
                    <?php }elseif($row->status == 0){ ?>
                    	style="color:#000;font-weight:bold;"
                    <?php } ?>
					>{{ str_pad($row->id,10,'0',STR_PAD_LEFT) }}</a>

				</b>
				@endif

			</td>
			
			<td><b>{{ strtoupper($row->project_name) }}</b></td>
			<td><b>{{ strtoupper($row->project_owner) }}</b></td>
			<td> 
				<?php
					$now = date('Y-m-d');
                    $dueDate = date("Y-m-d", strtotime($row->painting_dtend));
                    if($now > $dueDate && $row->status_forthread == 1)
                    {
                    	$class = "pending_project";
                    }elseif($row->status_forthread == 1){
                    	$class = "normal_project";
                    }elseif($row->status == 0){
                    	$class = "closed_project";
                    }

				?>
				<span class="{{ $class }}">
					@if($row->painting_dtstart == '0000-00-00')
						<b>--/--/----</b>
					@else	
						{{ date("m/d/Y", strtotime($row->painting_dtstart)) }}
					@endif
				</span>
				<b>TO</b>
				<span class="{{ $class }}">
					@if($row->painting_dtstart == '0000-00-00')
						<b>--/--/----</b>
					@else	
						{{ date("m/d/Y", strtotime($row->painting_dtend)) }}
					@endif
				</span>
			</td>
			@if(Session::get('role') == 1 || Session::get('role') == 2)
				<td class="action">
					@if($row->status > 0)
						{{ HTML::linkRoute('project.editbdo','Change BDO', $row->id, array('class' => 'btn btn-success btn-xs', 'id' => 'change_bdo_btn')) }}&nbsp;
					@elseif($row->status == 0)
						{{ Form::open(array('method' => 'PUT', 'route' => array('activate.project', $row->id))) }}                       
							{{ Form::submit('Activate Project', array('class' => 'btn btn-info btn-xs', 'id' => 'change_bdo_btn', 'onclick' => "if(!confirm('Are you sure to activate this project?')){return false;};")) }}
						{{ Form::close() }}
					@endif
				</td>
			@endif
		
		</tr>
		@endforeach
	
	@endif

	</table>

<div id="pgntn_form_design" class="pagination"> {{ $myprojectlist->links() }} </div>
</div>



@stop