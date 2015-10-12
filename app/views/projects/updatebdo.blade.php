@extends('layout.backendnoloading')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('project.updatebdo', $bdo->id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		
		<div class="form-group">
			{{ Form::label('assigned_bdo_proj', 'CURRENT ASSIGNED BDO :', array('class' => 'control-label')) }} &nbsp; <b>{{ $bdo->bdo_name }}</b><br/>
			{{ Form::label('bdo_desc', 'BDO Name', array('class' => 'control-label')) }}<br/>
			<span>{{ Form::select('bdo', array($bdo->bdo_id => $bdo->bdo_name) + $bdo_list, null, array('class' => 'form-control bdo_inputs', 'id' => 'bdo_name')) }}</span>
			{{ Form::hidden('former_bdo', $bdo->id, array('id' => 'former_bdo')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('project.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	var domain ="http://"+document.domain;
			
	$("#bdo_name").chosen({allow_single_deselect: true});

	});
</script>

@stop