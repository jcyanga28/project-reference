@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-8">
		 	
		 	<div class="proj_form_status_details">
		 	<br/>

					<table class="tbl_details_status">
					<tr style="border-bottom:solid 2px #666;">
						<td>&nbsp;&nbsp;<b> PROJECT DETAILS </b></td>
						<td></td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Number </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ str_pad($project->id,10,'0',STR_PAD_LEFT) }}</td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Date Reported </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ date("m/d/Y", strtotime($project->date_reported)) }}</td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Name </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->project_name) }}</td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Owner </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->project_owner) }}</td>
					</tr>
					@if(count($dev)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;DEVELOPER </td>
						<td id="proj_status_tbl_info_td">
							@foreach($dev as $devrow)
								<span style="margin-left: 5px;">{{ strtoupper($devrow->developer_record) . '<br/>' }}</span>
							@endforeach
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;DEVELOPER </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($sub_dev)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-DEVELOPER </td>
						<td id="proj_status_tbl_info_td">
							@foreach($sub_dev as $sub_devrow)
								<span style="margin-left: 5px;">{{ strtoupper($sub_devrow->developer_record) . '<br/>' }}</span>
							@endforeach
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-DEVELOPER </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($gencon)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;GENERAL CONTRACTOR </td>
						<td id="proj_status_tbl_info_td">
							@foreach($gencon as $genconrow)
								<span style="margin-left: 5px;">{{ strtoupper($genconrow->generalcontractor_record . '<br/>') }}</span>
							@endforeach
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;GENERAL CONTRACTOR </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($sub_gencon)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-GENERAL CONTRACTOR </td>
						<td id="proj_status_tbl_info_td">
							@foreach($sub_gencon as $sub_genconrow)
								<span style="margin-left: 5px;">{{ strtoupper($sub_genconrow->generalcontractor_record . '<br/>') }}</span>
							@endforeach
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-GENERAL CONTRACTOR </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($projmgrdes)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;PROJECT MANAGER/ DESIGNER </td>
						<td id="proj_status_tbl_info_td">
							@foreach($projmgrdes as $projmgrdesrow)
								<span style="margin-left: 5px;">{{ strtoupper($projmgrdesrow->projectmgrdesigner_record . '<br/>') }}</span>
							@endforeach	
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;PROJECT MANAGER/ DESIGNER </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($sub_projmgrdes)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-PROJECT MANAGER/ DESIGNER </td>
						<td id="proj_status_tbl_info_td">
							@foreach($sub_projmgrdes as $sub_projmgrdesrow)
								<span style="margin-left: 5px;">{{ strtoupper($sub_projmgrdesrow->projectmgrdesigner_record . '<br/>') }}</span>
							@endforeach	
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-PROJECT MANAGER/ DESIGNER </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($arch)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;ARCHITECT </td>
						<td id="proj_status_tbl_info_td">
							@foreach($arch as $archrow)
								<span style="margin-left: 5px;">{{ strtoupper($archrow->architect_record . '<br/>') }}</span>
							@endforeach
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;ARCHITECT </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($sub_arch)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-ARCHITECT </td>
						<td id="proj_status_tbl_info_td">
							@foreach($sub_arch as $sub_archrow)
								<span style="margin-left: 5px;">{{ strtoupper($sub_archrow->architect_record . '<br/>') }}</span>
							@endforeach
						</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-ARCHITECT </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($app)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;APPLICATOR </td>
						<td id="proj_status_tbl_info_td">
							@foreach($app as $approw)
								<span style="margin-left: 5px;">{{ strtoupper($approw->applicator_record . '<br/>') }}</span>
							@endforeach
						</td>
					</tr>	
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;APPLICATOR </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($sub_app)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-APPLICATOR </td>
						<td id="proj_status_tbl_info_td">
							@foreach($sub_app as $sub_approw)
								<span style="margin-left: 5px;">{{ strtoupper($sub_approw->applicator_record . '<br/>') }}</span>
							@endforeach
						</td>
					</tr>	
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-APPLICATOR </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($dealsupp)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;DEALER/ SUPPLIER </td>
						<td id="proj_status_tbl_info_td">
							@foreach($dealsupp as $dealsupprow)
								<span style="margin-left: 5px;">{{ strtoupper($dealsupprow->dealersupplier_record . '<br/>') }}</span>
							@endforeach	
							</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;DEALER/ SUPPLIER </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if(count($sub_dealsupp)>0)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-DEALER/ SUPPLIER </td>
						<td id="proj_status_tbl_info_td">
							@foreach($sub_dealsupp as $sub_dealsupprow)
								<span style="margin-left: 5px;">{{ strtoupper($sub_dealsupprow->dealersupplier_record . '<br/>') }}</span>
							@endforeach	
							</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;SUB-DEALER/ SUPPLIER </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Classification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->classification) }}</td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Category </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->category) }}</td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Stage </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->stage) }}</td>
					</tr>
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Status </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($projectstatus) }}</td>
					</tr>
					@if($project->project_details == "")
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Details </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@elseif($project->project_details == "WRITE DETAILS HERE.")
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Details </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Details </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->project_details) }}</td>
					</tr>
					@endif
					@if($project->painting_dtstart == "0000-00-00")
						<?php $dtstart =  "--/--/----"; ?>
					@else
						<?php $dtstart = date("m/d/Y", strtotime($project->painting_dtstart)); ?>
					@endif
					@if($project->painting_dtend == "0000-00-00")
						<?php $dtend = "--/--/----"; ?>
					@else
						<?php $dtend = date("m/d/Y", strtotime($project->painting_dtend)); ?>
					@endif		
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Painting Date </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ $dtstart }} <b>-</b> {{ $dtend }}</td>
					</tr>
					@if($project->painting_specification)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Specification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->painting_specification) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Project Specification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->paints)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Paints </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->paints) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Paints </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->area)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Area(Sqm.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->area) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Area(Sqm.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_requirement)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Painting Requirement(Ltrs.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->painting_requirement) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Painting Requirement(Ltrs.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_cost)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Painting Cost </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ number_format($project->painting_cost) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;Painting Cost </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_specification_2)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Project Specification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->painting_specification_2) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Project Specification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->paints2)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Paints </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->paints2) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Paints </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->area2)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Area(Sqm.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->area2) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Area(Sqm.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_requirement2)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Painting Requirement(Ltrs.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->painting_requirement2) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Painting Requirement(Ltrs.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_cost2)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Painting Cost </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ number_format($project->painting_cost2) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;2nd Painting Cost </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_specification_3)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Project Specification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->painting_specification_3) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Project Specification </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->paints3)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Paints </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->paints3) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Paints </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->area3)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Area(Sqm.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->area3) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Area(Sqm.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_requirement3)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Painting Requirement(Ltrs.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ strtoupper($project->painting_requirement3) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Painting Requirement(Ltrs.) </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
					@if($project->painting_cost3)
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Painting Cost </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;{{ number_format($project->painting_cost3) }}</td>
					</tr>
					@else
					<tr>
						<td id="proj_status_tbl_details_td">&nbsp;&nbsp;&nbsp;&nbsp;3rd Painting Cost </td><td id="proj_status_tbl_info_td">&nbsp;&nbsp;<b>N/A</b></td>
					</tr>
					@endif
				</table>

			<br/>	
		 	</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-4">
		
		<div>
			
			<span class="project_attachment_title">PROJECT FILES<b> ({{ count($project_files) }})</b></span>
			<br/>

			@if(count($project_files)>0)	
				<table style="font-size: 11px;" class="table table-hover">
					<tr>
						<td><b>FILENAME</b></td>
						<td><b>ACTION</b></td>
					</tr>
					@foreach($project_files as $filesrow)
						<tr>
							<td>{{ $filesrow->file}}</td>
							<td style="font-size: 11px;"><a href="/download/{{ $filesrow->file }}">DOWNLOAD</a></td>
						</tr>
					@endforeach
				</table>
			@else
				<b style="font-size: 11px; margin-left: 10px;"> - NO RECORD FOUND.</b>	
			
			@endif

		</div>
		<br/>

		<span class="project_attachment_title">PROJECT IMAGE<b> ({{ count($project_img) }})</b></span>
		<br/>

		@if(count($project_img) > 0)
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

		@endif

	</div>

</div>
<br/>

<div style="width: 98%">
	<div id="count_result" class="row">
		<div style="font-size: 16px;" class="col-lg-12">
			<span>{{ count($project_thread) }}</span> thread/s found &nbsp;
		</div> 	
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		 	
		 	<div class="proj_form_status_chatbox">
	
		 	@if(count($project_thread) > 0)
		 	<br/>
		 		@foreach($project_thread as $row)
		 				
		 				@if($row->user_id == Auth::id())
				 			<?php $bgcolor = "background-color: #f8ff1e;"; ?>
				 		@else
				 			<?php $bgcolor = "background-color: #efefef;"; ?>
				 		@endif	
				 <div style="{{ $bgcolor }}" class="row" id="msg_container">
			 		<div class="col-xs-12 col-sm-6 col-md-2">
			 			<img src="{{ URL::asset('asset/img/user-img' . '/' . $row->image) }}" alt="default" class="img-circle" style="height: 100px; width: 100px; border: solid 3px #666;margin-left:-13px;">
			 		</div>	
		 			<div style="margin-left: -20px;" class="col-xs-12 col-sm-6 col-md-10">
			 			<br/>
			 			<p id="msg_createdby"> <b>FROM :</b>
			 				@if($row->first_name == Auth::user()->first_name && $row->last_name == Auth::user()->last_name)
			 			 		<b>ME</b>
						 	@else	
			 			 		{{ strtoupper($row->first_name) . ' ' . strtoupper($row->last_name) }}
			 			 	@endif
			 			 	</p>
			 			<p id="msg_remarks"> <b>-</b> {{ $row->remarks }}</p>
			 		</div>	
			 	 </div>
			 	 <div id="msg_datetime_container">
			 	 	<p id="msg_datetime">{{ date("m-d-Y", strtotime($row->date_created)) . ' ' . date("H:i:s", strtotime($row->time_created)) }}&nbsp;</p>
			 	 </div>
			 	 <div  >	
			 	 	@if(isset($row->files) || isset($row->file))
			 	 	<table id="thread_attachments" class="table table-hover">
			 	 		<tr>
			 	 			<td><b>IMAGE & FILE NAME</b></td>
			 	 			<td><b>ACTION</b></td>
			 	 		<!-- @if(Session::get('role') == 1 || Session::get('role') == 2)
			 	 			<td><b>DATE & TIME IMAGE CREATED</b></td>
			 	 		@endif	 -->
			 	 		</tr>
			 	 		@if(isset($row->files))
					 	 	@foreach($row->files as $row_img)
					 	 		<tr>		
					 	 			<td><b>{{ $row_img->filename }}</b></td>
					 	 			<td style="font-size: 12px;">
					 	 				<a rel="lightboxes" href="{{ URL::asset('asset/img/project-thread') . '/' . $row_img->filename }}" class="img-threads"> VIEW </a>
					 	 			</td>
					 	 		</tr>	
					 	 	@endforeach
				 	 	@endif
				 	 	@if(isset($row->file))
					 	 	@foreach($row->file as $row_files)
					 	 		<tr>		
					 	 			<td><b>{{ $row_files->filename }}</b></td>
					 	 			<td style="font-size: 12px;"><a href="/download-thread/{{ $row_files->filename }}">DOWNLOAD</a></td>
					 	 			<!-- <td><b>{{ date("m-d-Y H:i:s", strtotime($row_files->datetime_created)) }}</b></td> -->
					 	 		</tr>	
					 	 	@endforeach
				 	 	@endif
				 	</table>
			 	 	@endif
			 	 </div>
		 		<hr/>
		 		@endforeach

		 	@else
		 		<b>No Thread Found.</b>
		 		
		 	@endif

		 	</div>
		 	
	</div>
</div>
<br/>

@if($project_status->status == 2)
<div class="row">
	<div class="col-lg-12">
		 	
		 	{{ Form::open(array('route' => array('project.remarks', $project->id), 'class' => 'bs-component', 'files' => true)) }}
		 	<div class="proj_form_status_addthread">

		 		<diV id="closed_chkbox">{{ Form::checkbox('closed') }} &nbsp;CLOSED PROJECT.<em style="color:#F00;font-size: 13px;"> (Leave this box if just commenting on the project)</em></div>
		 		<br/>
		 		
		 		<div id="msgbox">
		 			{{ Form::label('remarks_desc', '*Remarks', array('class' => 'control-label')) }}<br/>
		 			{{ Form::textarea('remarks', 'Write here.', ['size' => '105x6', 'id' => 'textarea_status']) }}
		 		</div>	
		 		<br/>

		 		<div id="msg_img">
		 			<span>Attach files or images <em style="color:#F00;font-size: 11px;">(Allowed file types pdf|gif|jpg|png|txt|xls|xlsx|doc|docx|jpeg|bmp|csv)</em></span>
		 			<span>{{ Form::file('image[]', array('id' => 'photo_files', 'class' => 'photo_files', 'accept' => 'pdf|gif|jpg|png|xls|xlsx|doc|docx|jpeg|bmp', 'multiple'=>true)) }}</span>
		 			@if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
		 		</div>
		 		<hr/>

				<table style="margin-left: 20px;">
					<tr>
						<td>
							<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
						</td>
						<td>&nbsp;&nbsp;</td>
						<td>
							{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
						</td>
					</tr>
				</table>
				<br/>	
			
			</div>

			{{ Form::close() }}

	</div>
</div>
@endif

@if($project_status->status == 0)
<div class="row">
	<div class="col-lg-12">
		 	
	 	<div class="proj_form_status_details">
	 	<br/>

			<table style="margin-left: 20px;">
				<tr>
					<td>
						<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
					</td>
				</tr>
			</table>
			<br/>	
		
		</div>
			
	</div>
</div>
@endif
<br/><br/>

<style type="text/css">

#textarea_status
{
	font-size: 12px; 
	color: #333;
	font-family: tahoma;
}

</style>

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
    $(document).ready(function(){
        $("[rel^='lightboxes']").prettyPhoto();
    });
</script>

<script type="text/javascript">
	
	$(document).ready(function() {
	var domain ="http://"+document.domain;

	$('#photo_files').MultiFile({ 
	  STRING: {
	   remove: '<img src="<?php echo URL::asset('asset/img/delete.png') ?>" height="16" width="15" alt="x"/>'
	  }
	 });

	});	  

</script>


@stop