@extends('layout.backend')

@section('content')
	
	<div id="dashboard_container">

		<!-- /.row -->

		<div id="notif_content">
		<div id="notif_count">Total {{ count($project_result_ofrequest) }} record/s. </div>

		@if(count($project_result_ofrequest) > 0)
			@foreach($project_result_ofrequest as $row)
				
				@if($row->status == 2)
					<?php $res = 'Approved'; ?>
					<?php $url = 'project?status=2&s=' . $row->project_name; ?>
				
				@elseif($row->status == 3)
					<?php $res = 'Denied'; ?>
					<?php $url = 'project?status=3&s=' . $row->project_name; ?>

				@else
					<?php $res = 'Closed'; ?>
					<?php $url = '#'; ?>

				@endif
				
				<?php 

				$req_project = $row->project_name;
				$process_by = $row->first_name . ' ' . $row->last_name;
				
				$process_dt = explode(" ", $row->notif_dt);
				$date = strtotime($process_dt[0]);
				$date = date('m/d/Y', $date);
				$time = $process_dt[1];

				$message = "- $process_by $res your request to add $req_project in project record."; 

				?>
			
			<div class="info">
				<h4><a href="../{{ $url }}" style="color: #0e7fad;">{{ strtoupper($res) }} PROJECT REQUEST.</a></h4>
				<p id="notif_phar"><b>{{ strtoupper($message) }}</b></p>
				<p id="notifbox_font">{{ date('m/d/Y H:i:s', strtotime($date . ' ' . $time)) }}</p>
			
			</div>

			@endforeach
		@else

			<div>
				<b style="font-size: 14px;"> - No record found.</b>
			</div>

		@endif

		<div id="pgntn_form_design" class="pagination"> {{ $project_result_ofrequest->links() }} </div>
		<br/><br/>

		</div>

	<br/><br/>	
	</div>

@stop