@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-7">

		<table style="width: 100%;font-size:11px;" id="detail_tbl_design" class="table table-hover">
		<tr>
			<td id="tbl_details_td">Project Number</td><td>{{ str_pad($project->id,10,'0',STR_PAD_LEFT) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">Date Reported</td><td>{{ date("m/d/Y", strtotime($project->date_reported)) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">BDO Assigned</td><td>{{ strtoupper($project->first_name) . ' ' . strtoupper($project->last_name) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">BDO Area</td><td>{{ strtoupper($project->area_place) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">Project Name</td><td>{{ strtoupper($project->project_name) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">Project Owner</td><td>{{ strtoupper($project->project_owner) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT ADDRESS</td><td>{{ strtoupper($project->street) . ' ' . strtoupper($cities->city) . ' ' . strtoupper($project->country) }}</td>
		</tr>
		@if(count($dev)>0)
		<tr>
			<td id="tbl_details_td">DEVELOPER</td>
			<td>
				@foreach($dev as $devrow)
					{{ strtoupper($devrow->developer_record) . '<br/>' }}
				@endforeach
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">DEVELOPER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($sub_dev)>0)
		<tr>
			<td id="tbl_details_td">SUB-DEVELOPER</td>
			<td>
				@foreach($sub_dev as $sub_devrow)
					{{ strtoupper($sub_devrow->developer_record) . '<br/>' }}
				@endforeach
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">SUB-DEVELOPER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($gencon)>0)
		<tr>
			<td id="tbl_details_td">GENERAL CONTRACTOR</td>
			<td>
				@foreach($gencon as $genconrow)
					{{ strtoupper($genconrow->generalcontractor_record . '<br/>') }}
				@endforeach
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">GENERAL CONTRACTOR</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($sub_gencon)>0)
		<tr>
			<td id="tbl_details_td">SUB-GENERAL CONTRACTOR</td>
			<td>
				@foreach($sub_gencon as $sub_genconrow)
					{{ strtoupper($sub_genconrow->generalcontractor_record . '<br/>') }}
				@endforeach
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">SUB-GENERAL CONTRACTOR</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($projmgrdes)>0)
		<tr>
			<td id="tbl_details_td">PROJECT MANAGER/ DESIGNER</td>
			<td>
				@foreach($projmgrdes as $projmgrdesrow)
					{{ strtoupper($projmgrdesrow->projectmgrdesigner_record . '<br/>') }}
				@endforeach	
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT MANAGER/ DESIGNER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($sub_projmgrdes)>0)
		<tr>
			<td id="tbl_details_td">SUB-PROJECT MANAGER/ DESIGNER</td>
			<td>
				@foreach($sub_projmgrdes as $sub_projmgrdesrow)
					{{ strtoupper($sub_projmgrdesrow->projectmgrdesigner_record . '<br/>') }}
				@endforeach	
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">SUB-PROJECT MANAGER/ DESIGNER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($arch)>0)
		<tr>
			<td id="tbl_details_td">ARCHITECT</td>
			<td>
				@foreach($arch as $archrow)
					{{ strtoupper($archrow->architect_record . '<br/>') }}
				@endforeach
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">ARCHITECT</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($sub_arch)>0)
		<tr>
			<td id="tbl_details_td">SUB-ARCHITECT</td>
			<td>
				@foreach($sub_arch as $sub_archrow)
					{{ strtoupper($sub_archrow->architect_record . '<br/>') }}
				@endforeach
			</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">SUB-ARCHITECT</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($app)>0)
		<tr>
			<td id="tbl_details_td">APPLICATOR</td>
			<td>
				@foreach($app as $approw)
					{{ strtoupper($approw->applicator_record . '<br/>') }}
				@endforeach
			</td>
		</tr>	
		@else
		<tr>
			<td id="tbl_details_td">APPLICATOR</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($sub_app)>0)
		<tr>
			<td id="tbl_details_td">SUB-APPLICATOR</td>
			<td>
				@foreach($sub_app as $sub_approw)
					{{ strtoupper($sub_approw->applicator_record . '<br/>') }}
				@endforeach
			</td>
		</tr>	
		@else
		<tr>
			<td id="tbl_details_td">SUB-APPLICATOR</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($dealsupp)>0)
		<tr>
			<td id="tbl_details_td">DEALER/ SUPPLIER</td>
			<td>
				@foreach($dealsupp as $dealsupprow)
					{{ strtoupper($dealsupprow->dealersupplier_record . '<br/>') }}
				@endforeach	
				</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">DEALER/ SUPPLIER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(count($sub_dealsupp)>0)
		<tr>
			<td id="tbl_details_td">SUB-DEALER/ SUPPLIER</td>
			<td>
				@foreach($sub_dealsupp as $sub_dealsupprow)
					{{ strtoupper($sub_dealsupprow->dealersupplier_record . '<br/>') }}
				@endforeach	
				</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">SUB-DEALER/ SUPPLIER</td><td><b>N/A</b></td>
		</tr>
		@endif
		<tr>
			<td id="tbl_details_td">PROJECT CLASSIFICATION</td><td>{{ strtoupper($project->classification) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT CATEGORY</td><td>{{ strtoupper($project->category) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT STAGE</td><td>{{ strtoupper($project->stage) }}</td>
		</tr>
		@if($project->status == 0)
		<tr>
			<td id="tbl_details_td">PROJECT STATUS</td><td><b>N/A</b></td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT STATUS</td><td>{{ strtoupper($projectstatus) }}</td>
		</tr>
		@endif
		@if($project->project_details == "")
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td><b>N/A</b></td>
		</tr>
		@elseif($project->project_details == "WRITE DETAILS HERE.")
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td><b>N/A</b></td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td>{{ strtoupper($project->project_details) }}</td>
		</tr>
		@endif
		@if($project->painting_dtstart != "0000-00-00")
		<tr>
			<td id="tbl_details_td">PROJECT DATE-START</td><td>{{ date("m/d/Y", strtotime($project->painting_dtstart)) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DATE-START</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_dtend != "0000-00-00")
		<tr>
			<td id="tbl_details_td">PROJECT DATE-END</td><td>{{ date("m/d/Y", strtotime($project->painting_dtend)) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DATE-END</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_specification)
		<tr>
			<td id="tbl_details_td">PROJECT SPECIFICATION</td><td>{{ strtoupper($project->painting_specification) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT SPECIFICATION</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->paints)
		<tr>
			<td id="tbl_details_td">PAINTS</td><td>{{ strtoupper($project->paints) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PAINTS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->area)
		<tr>
			<td id="tbl_details_td">AREA(Sqm.)</td><td>{{ strtoupper($project->area) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">AREA(Sqm.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_requirement)
		<tr>
			<td id="tbl_details_td">PAINTING REQUIREMENT(Ltrs.)</td><td>{{ strtoupper($project->painting_requirement) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PAINTING REQuIREMENT(Ltrs.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_cost)
		<tr>
			<td id="tbl_details_td">PAINTING COST</td><td>{{ number_format($project->painting_cost) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PAINTING COST</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_specification_2)
		<tr>
			<td id="tbl_details_td">2nd PROJECT SPECIFICATION</td><td>{{ strtoupper($project->painting_specification_2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PROJECT SPECIFICATION</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->paints2)
		<tr>
			<td id="tbl_details_td">2nd PAINTS</td><td>{{ strtoupper($project->paints2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PAINTS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->area2)
		<tr>
			<td id="tbl_details_td">2nd AREA(Sqm.)</td><td>{{ strtoupper($project->area2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd AREA(Sqm.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_requirement2)
		<tr>
			<td id="tbl_details_td">2nd PAINTING REQUIREMENT(Ltrs.)</td><td>{{ strtoupper($project->painting_requirement2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PAINTING REQuIREMENT(Ltrs.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_cost2)
		<tr>
			<td id="tbl_details_td">2nd PAINTING COST</td><td>{{ number_format($project->painting_cost2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PAINTING COST</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_specification_3)
		<tr>
			<td id="tbl_details_td">3rd PROJECT SPECIFICATION</td><td>{{ strtoupper($project->painting_specification_3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PROJECT SPECIFICATION</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->paints3)
		<tr>
			<td id="tbl_details_td">3rd PAINTS</td><td>{{ strtoupper($project->paints3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PAINTS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->area3)
		<tr>
			<td id="tbl_details_td">3rd AREA(Sqm.)</td><td>{{ strtoupper($project->area3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd AREA(Sqm.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_requirement3)
		<tr>
			<td id="tbl_details_td">3rd PAINTING REQUIREMENT(Ltrs.)</td><td>{{ strtoupper($project->painting_requirement3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PAINTING REQuIREMENT(Ltrs.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_cost3)
		<tr>
			<td id="tbl_details_td">3rd PAINTING COST</td><td>{{ number_format($project->painting_cost3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PAINTING COST</td><td><b>N/A</b></td>
		</tr>
		@endif
	</table> 

	<div>
			
		<span class="project_attachment_title">Project files<b>({{ count($project_files) }})</b></span>
		<br/>

		@if(count($project_files)>0)	
			<table style="font-size: 13px;" class="table table-hover">
				<tr>
					<td><b>FILENAME</b></td>
					<td><b>ACTION</b></td>
				</tr>
				@foreach($project_files as $filesrow)
					<tr>
						<td>{{ $filesrow->file}}</td>
						<td style="font-size: 12px;"><a href="/download/{{ $filesrow->file }}">DOWNLOAD</a></td>
					</tr>
				@endforeach
			</table>
		@else
			<b style="font-size: 11px; margin-left: 10px;"> - NO RECORD FOUND.</b>	
		
		@endif

	</div>
	<br/>

	<span class="project_attachment_title">Project images<b>({{ count($project_img) }})</b></span>
	<br/>

	@if(count($project_img)>0)
		<div style="margin-left: -35px;" class="container-gallery">
			<ul id="project_image_list" class="thumbnails">
	        	@foreach($project_img as $img_row)			
		        	<li class="span3">
		                <a class="thumbnail" rel="lightbox[group]" href="{{ URL::asset('asset/img/project') . '/' . $img_row->image }}"><img class="group1" src="{{ URL::asset('asset/img/project') . '/' . $img_row->image }}" title="{{ $img_row->image }}" /></a>
		            </li> <!--end thumb -->
	            @endforeach
	    </ul>
		</div>
	@else
		<b style"margin-left: 10px;"> &nbsp;&nbsp; <span style="font-size: 11px;">- NO RECORD FOUND.</span></b>
		<br/>
	@endif	
	
	@if($project->current_stats == 1)
	<br/>
	<table>
		<tr>
			<td>
				{{ Form::label('remarks_desc', 'Remarks', array('class' => 'control-label')) }} <em style="color:#F00;font-size: 11px;">(Note : Need to write remarks if denying the company request.)</em><br/>
				{{ Form::textarea('remarks', 'Write remarks here.', array('size' => '85x5', 'class' => 'remarks_input', 'id' => 'txtarea_input')) }}
			</td>
		</tr>
	</table>
	<br/>
	@endif
	
	<table>
		<tr>
			<td>
				<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
			</td>
		<td>&nbsp;</td>
		@if($project->current_stats == 1)	
			<td>
				{{ Form::open(array('method' => 'PUT', 'route' => array('project.a', $project->id))) }}                       
					{{ Form::submit('Approve', array('id' => 'btn_design', 'class'=> 'btn btn-info btn-xs','onclick' => "if(!confirm('Are you sure to approve this record?')){return false;};")) }}
				{{ Form::close() }}
			</td>
		<td>&nbsp;</td>
			<td>
				{{ Form::open(array('method' => 'PUT', 'route' => array('project.d', $project->id))) }} 
					{{ Form::hidden('remarks_hid', '', array('class' => 'remarks_hid', 'id' => 'remarks_hid')) }}                   
					{{ Form::submit('Denied', array('id' => 'btn_design', 'class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to deny this record?')){return false;};")) }}
				{{ Form::close() }}
			</td>
		@endif	
		</tr>
	</table>

	</div>

 	<div class="col-xs-6 col-md-5">

 	@if($project->current_stats == 1)	
 	
 			<div>
 				<span id="related_title">Related Result.</span>
 			</div>
 	
 			<hr/>
 	
 			@if(count($almost_sameproj)==0)
 				<b>No Record found.</b>
 			
 			@else
 			<table style="border: 1px solid #eee;font-size:11px;" class="table table-striped">
 				<thead>
 					<tr>
 						<td><b>PROJECT NAME</b></td>
 						<td><b>PROJECT OWNER</b></td>
 					</tr>
 				</thead>
 	
 				<tbody>
 					@foreach($almost_sameproj as $row)
 						<tr>
 							<td>{{ strtoupper($row->project_name) }}</td>
 							<td>{{ strtoupper($row->project_owner) }}</td>
 						</tr>
 	
 					@endforeach	
 				</tbody>
 			</table>
 			@endif
 			
 		@endif

	</div>	


</div>

<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));

    // Colorbox Call

    $(document).ready(function(){
        $("[rel^='lightbox']").prettyPhoto();
    });
</script>

<script type="text/javascript">
$(document).ready(function() {	
	var domain ="http://"+document.domain;

	$('.remarks_input').each(function(){
		$(this).change(function(){

			if($(this).val() == "" || $(this).val() == "Write remarks here.")
			{
				$('.remarks_hid').val('');
			}else{
				$('.remarks_hid').val($(this).val());
			}

		});	
	});

});

</script>

@stop