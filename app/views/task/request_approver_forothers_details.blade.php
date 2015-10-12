@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-12">

		<table style="width: 65%;font-size:12px;" id="detail_tbl_design" class="table table-hover">
		<tr>
			<td id="tbl_details_td">REQUEST NUMBER</td><td>{{ str_pad($details->id,10,'0',STR_PAD_LEFT) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">REQUEST TYPE</td><td>{{ strtoupper($details->task) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">AMOUNT</td><td>{{ number_format($details->amount) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">START DATE</td><td>{{ date("m/d/Y", strtotime($details->date_start)) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">END DATE</td><td>{{ date("m/d/Y", strtotime($details->date_end)) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">REMARKS</td><td>{{ strtoupper($details->remarks) }}</td>
		</tr>
	</table> 

	<div>
			
		<span class="project_attachment_title">Files & Image attachment</span>
		<br/>

		@if(count($getattached)>0)	
			<table style="font-size: 12px; width: 50%;" class="table table-hover">
				<tr>
					<td><b>ATTACHED NAME</b></td>
					<td><b>ACTION</b></td>
				</tr>
				@foreach($getattached as $filesrow)
					<tr>
						<td>{{ $filesrow->file_img}}</td>
						<td style="font-size: 12px;"><a href="/others/download/{{ $filesrow->file_img }}">DOWNLOAD</a></td>
					</tr>
				@endforeach
			</table>
		@else
			<b style="font-size: 14px; margin-left: 10px;"> - No record found.</b>	
		
		@endif

	</div>
	<br/><hr/>
			 
	@if($details->approved_request == 1)
		<div style="border: solid 1px #000; border-radius: 3px; width: 99%; box-shadow:0px 0px 10px rgb(136,136,136); ">
		<br/>
			
			@foreach($getthread as $row)
		 				
		 				@if($row->user_id == Auth::id())
				 			<?php $bgcolor = "background-color: #fff;"; ?>
				 		@else
				 			<?php $bgcolor = "background-color: #fff;"; ?>
				 		@endif	
				 <div style="{{ $bgcolor }}" class="row" id="msg_container">
			 		<div class="col-xs-12 col-sm-6 col-md-2">
			 			<img src="{{ URL::asset('asset/img/user-img' . '/' . $row->image) }}" alt="default" class="img-circle" style="height: 100px; width: 100px; border: solid 3px #666;margin-left:-13px;">
			 		</div>	
		 			<div class="col-xs-12 col-sm-6 col-md-10">
			 			<br/>
			 			<p id="msg_createdby"> <b>FROM :</b>
			 				@if($row->first_name == Auth::user()->first_name && $row->last_name == Auth::user()->last_name)
			 			 		<b>ME</b>
						 	@else	
			 			 		{{ strtoupper($row->first_name) . ' ' . strtoupper($row->last_name) }}
			 			 	@endif
			 			 	</p>
			 			<p id="msg_remarks"> <b>-</b> {{ $row->thread }}</p>
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
				 	 	@if(isset($row->files))
					 	 	@foreach($row->files as $row_file)
					 	 		<tr>		
					 	 			<td><b>{{ $row_file->filename }}</b></td>
					 	 			<td style="font-size: 12px;"><a href="/download-request/others-thread/{{ $row_file->filename }}">DOWNLOAD</a></td>
					 	 		</tr>	
					 	 	@endforeach
				 	 	@endif
				 	 	@if(isset($row->file))
					 	 	@foreach($row->file as $row_files)
					 	 		<tr>		
					 	 			<td><b>{{ $row_files->filename }}</b></td>
					 	 			<td style="font-size: 12px;"><a href="/download-request/others-thread/{{ $row_files->filename }}">DOWNLOAD</a></td>
					 	 		</tr>	
					 	 	@endforeach
				 	 	@endif
				 	</table>
			 	 	@endif
			 	 </div>
		 		<hr/>
		 		@endforeach
		
		<br/></div><br/>
	@endif

	@if($details->approved_request == 1)
		{{ Form::open(array('route' => 'task.forothers.approver.tagremarks','class' => 'bs-component', 'files' => true)) }} 				
			<diV id="closes_chkbox">{{ Form::checkbox('closed') }} &nbsp;CLOSED REQUEST.<em style="color:#F00;font-size: 13px;"> (Leave this box if just commenting on the request)</em></div>
			
			{{ Form::label('finalamount_desc', 'Amount', array('class' => 'control-label')) }}<br/>
			{{ Form::text('amount', '', array('class' => 'amount', 'id' => 'amount')) }}  
			<br/>

			{{ Form::label('remarks_desc', '*Remarks', array('class' => 'control-label')) }}<br/>
			{{ Form::hidden('task_hid', $details->id, array('class' => 'task_hid', 'id' => 'task_hid')) }}  
			{{ Form::textarea('remarks_thread', 'Write remarks here.', array('size' => '93x6', 'class' => 'remarks_input', 'id' => 'txtarea_input')) }}

			<br/>
			{{ Form::label('filesimg_desc', 'File/Image Attachment', array('class' => 'control-label')) }}
			<span>{{ Form::file('file_images[]', array('id' => 'photo_files', 'class' => 'photo_files', 'accept' => 'pdf|gif|jpg|png|xls|xlsx|doc|docx|jpeg|bmp', 'multiple'=>true)) }}</span>
			
			<br/><hr/>

			<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
		 	{{ Form::submit('Submit Remarks', array('name' => 'submit_approve', 'id' => 'btn_design', 'class'=> 'btn btn-success btn-xs')) }}
		{{ Form::close() }}	
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

$('#photo_files').MultiFile({ 
  STRING: {
   remove: '<img src="<?php echo URL::asset('asset/img/delete.png') ?>" height="16" width="15" alt="x"/>'
  }
 }); 

});

</script>

@stop