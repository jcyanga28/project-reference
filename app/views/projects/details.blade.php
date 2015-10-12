@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-8">

	<table style="width: 100%;" id="detail_tbl_design" class="table table-hover">
		<tr>
			<td id="tbl_details_td">PROJECT NUMBER</td><td>{{ str_pad($project_detail->id,10,'0',STR_PAD_LEFT) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">DATE CREATED</td><td>{{ date("m/d/Y", strtotime($project_detail->date_reported)) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">BDO ASSIGNED</td><td>{{ strtoupper($project_detail->first_name) . ' ' . strtoupper($project_detail->last_name) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">BDO ASSIGNED-AREA</td><td>{{ strtoupper($project_detail->area_place) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT NAME</td><td>{{ strtoupper($project_detail->project_name) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT OWNER</td><td>{{ strtoupper($project_detail->project_owner) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT ADDRESS</td><td>{{ strtoupper($project_detail->street) . ' ' . strtoupper($cities->city) . ' ' . strtoupper($project_detail->country) }}</td>
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
			<td id="tbl_details_td">PROJECT CLASSIFICATION</td><td>{{ strtoupper($project_detail->classification) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT CATEGORY</td><td>{{ strtoupper($project_detail->category) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT STAGE</td><td>{{ strtoupper($project_detail->stage) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">PROJECT STATUS</td><td>{{ strtoupper($projectstatus) }}</td>
		</tr>
		@if($project_detail->project_details == "")
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td><b>N/A</b></td>
		</tr>
		@elseif($project_detail->project_details == "WRITE DETAILS HERE.")
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td><b>N/A</b></td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DETAILS</td><td>{{ strtoupper($project_detail->project_details) }}</td>
		</tr>
		@endif
		@if($project_detail->painting_dtstart != "0000-00-00")
		<tr>
			<td id="tbl_details_td">PROJECT DATE-START</td><td>{{ date("m/d/Y", strtotime($project_detail->painting_dtstart)) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DATE-START</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_dtend != "0000-00-00")
		<tr>
			<td id="tbl_details_td">PROJECT DATE-END</td><td>{{ date("m/d/Y", strtotime($project_detail->painting_dtend)) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT DATE-END</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_specification)
		<tr>
			<td id="tbl_details_td">PROJECT SPECIFICATION</td><td>{{ strtoupper($project_detail->painting_specification) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PROJECT SPECIFICATION</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->paints)
		<tr>
			<td id="tbl_details_td">PAINTS</td><td>{{ strtoupper($project_detail->paints) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PAINTS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->area)
		<tr>
			<td id="tbl_details_td">AREA(Sqm.)</td><td>{{ strtoupper($project_detail->area) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">AREA(Sqm.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_requirement)
		<tr>
			<td id="tbl_details_td">PAINTING REQUIREMENT(Ltrs.)</td><td>{{ strtoupper($project_detail->painting_requirement) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PAINTING REQuIREMENT(Ltrs.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_cost)
		<tr>
			<td id="tbl_details_td">PAINTING COST</td><td>{{ number_format($project_detail->painting_cost) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">PAINTING COST</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_specification_2)
		<tr>
			<td id="tbl_details_td">2nd PROJECT SPECIFICATION</td><td>{{ strtoupper($project_detail->painting_specification_2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PROJECT SPECIFICATION</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->paints2)
		<tr>
			<td id="tbl_details_td">2nd PAINTS</td><td>{{ strtoupper($project_detail->paints2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PAINTS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->area2)
		<tr>
			<td id="tbl_details_td">2nd AREA(Sqm.)</td><td>{{ strtoupper($project_detail->area2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd AREA(Sqm.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_requirement2)
		<tr>
			<td id="tbl_details_td">2nd PAINTING REQUIREMENT(Ltrs.)</td><td>{{ strtoupper($project_detail->painting_requirement2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PAINTING REQuIREMENT(Ltrs.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_cost2)
		<tr>
			<td id="tbl_details_td">2nd PAINTING COST</td><td>{{ number_format($project_detail->painting_cost2) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">2nd PAINTING COST</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_specification_3)
		<tr>
			<td id="tbl_details_td">3rd PROJECT SPECIFICATION</td><td>{{ strtoupper($project_detail->painting_specification_3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PROJECT SPECIFICATION</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->paints3)
		<tr>
			<td id="tbl_details_td">3rd PAINTS</td><td>{{ strtoupper($project_detail->paints3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PAINTS</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->area3)
		<tr>
			<td id="tbl_details_td">3rd AREA(Sqm.)</td><td>{{ strtoupper($project_detail->area3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd AREA(Sqm.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_requirement3)
		<tr>
			<td id="tbl_details_td">3rd PAINTING REQUIREMENT(Ltrs.)</td><td>{{ strtoupper($project_detail->painting_requirement3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PAINTING REQuIREMENT(Ltrs.)</td><td><b>N/A</b></td>
		</tr>
		@endif
		@if($project_detail->painting_cost3)
		<tr>
			<td id="tbl_details_td">3rd PAINTING COST</td><td>{{ number_format($project_detail->painting_cost3) }}</td>
		</tr>
		@else
		<tr>
			<td id="tbl_details_td">3rd PAINTING COST</td><td><b>N/A</b></td>
		</tr>
		@endif
	</table> 

	<table>
	<tr>
		<td>
			<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
		</td>
			<td>&nbsp;</td>
		<!-- @if($project_detail->status < 3)	
			<td class="action">
				<a href="../<?php echo $project_detail->id; ?>/edit"><button id="btn_design" class="btn btn-info btn-xs">Update</button></a>
			</td>
		@endif
			<td>&nbsp;</td> -->
		<!-- @if($project_detail->current_stats < 2)
			<td class="action">
				{{ Form::open(array('method' => 'DELETE', 'route' => array('project.destroy', $project_detail->id))) }}                       
				{{ Form::submit('Delete', array('id' => 'btn_design', 'class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to delete this record?')){return false;};")) }}
				{{ Form::close() }}
			</td>
		@endif -->	
	</tr>
	</table>

</div>

<div class="col-xs-6 col-md-4">

	<div style="width: 90%;">
		<span style="color: #666; font-size: 16px;">Project file<b>({{ count($project_files) }})</b></span>
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
			<b style="font-size: 16px; margin-left: 10px;">No record found.</b>	
			<br/>
		@endif

	</div>

	<div>
		<span style="color: #666; font-size: 16px;">Project image<b>({{ count($project_img) }})</b></span>
	</div>
	<hr/>

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
		<div style="margin-left: 10px;">
			<b style"font-size: 16px;">No record found.</b>
		</div>

	@endif	

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