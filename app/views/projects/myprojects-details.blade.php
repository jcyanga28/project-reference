@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-8">

		<table style="width: 100%;" id="detail_tbl_design" class="table table-hover">
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
		@if(isset($dev->developer_record))
		<tr>
			<td id="tbl_details_td">DEVELOPER</td><td>{{ strtoupper($dev->developer_record) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">DEVELOPER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(isset($gencon->generalcontractor_record))
		<tr>
			<td id="tbl_details_td">GENERAL CONTRACTOR</td><td>{{ strtoupper($gencon->generalcontractor_record) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">GENERAL CONTRACTOR</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(isset($projmgrdes->projectmgrdesigner_record))
		<tr>
			<td id="tbl_details_td">PROJECT MANAGER/ DESIGNER</td><td>{{ strtoupper($projmgrdes->projectmgrdesigner_record) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT MANAGER/ DESIGNER</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(isset($arch->architect_record))
		<tr>
			<td id="tbl_details_td">ARCHITECT</td><td>{{ strtoupper($arch->architect_record) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">ARCHITECT</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(isset($app->applicator_record))
		<tr>
			<td id="tbl_details_td">APPLICATOR</td><td>{{ strtoupper($app->applicator_record) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">APPLICATOR</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if(isset($dealsupp->dealersupplier_record))
		<tr>
			<td id="tbl_details_td">DEALER/ SUPPLIER</td><td>{{ strtoupper($dealsupp->dealersupplier_record) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">DEALER/ SUPPLIER</td><td><b>N/A</b></td>
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
			<td id="tbl_details_td">PROJECT STATUS</td><td>{{ strtoupper($project->status) }}</td>
		</tr>
		@endif
		@if($project->project_details)
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td>{{ strtoupper($project->project_details) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_dtstart)
		<tr>
			<td id="tbl_details_td">PROJECT DATE-START</td><td>{{ date("m/d/Y", strtotime($project->painting_dtstart)) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DATE-START</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project->painting_dtend)
		<tr>
			<td id="tbl_details_td">PROJECT DATE-END</td><td>{{ date("m/d/Y", strtotime($project->painting_dtend)) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DATE-END</td><td><b>N/A</b></td>
		</tr>
		@endif
		<tr>
			<td id="tbl_details_td">PROJECT SPECIFICATION</td><td>{{ strtoupper($project->painting_specification) }}</td>
		</tr>
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
	</table> 	

	<table>
		<tr>
			<td>
				<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
			</td>
		</tr>
	</table>

<br/>		
</div>

 <div class="col-xs-6 col-md-4">

	 	<div>
			<span style="color: blue; font-size: 16px;">Project images<b>({{ count($project_img) }})</b></span>
		</div>
		<hr/>

		<div style="margin-left: -35px;" class="container-gallery">
			<ul id="project_image_list" class="thumbnails">
	        	@foreach($project_img as $img_row)
		        	
		        	@if($img_row->status == 1)
		        		<?php $title = "Before Painting"; ?>
		        	@elseif($img_row->status == 2)
		        		<?php $title = "During Painting"; ?>
		        	@else
		        		<?php $title = "After Painting"; ?>
		        	@endif
		        				
		        	<li class="span3">
		                <a class="thumbnail" rel="lightbox[group]" href="{{ URL::asset('asset/img/project') . '/' . $img_row->image }}"><img class="group1" src="{{ URL::asset('asset/img/project') . '/' . $img_row->image }}" title="{{ $title }}" /></a>
		            </li> <!--end thumb -->
	            @endforeach
	    </ul>
		</div>

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

@stop