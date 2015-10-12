@extends('layout.backend')

@section('content')

<div class="row">
	<div class="col-lg-12">

			<a href="javascript:history.back()" ><button type="button" id="button_design" class="btn btn-default btn_form_design"><i class="fa fa-arrow-left"></i> Back to previous page </button></a>
		  	<a href="{{ URL::route('user.create') }}" class="btn btn-primary btn_form_design"><i class="fa fa-plus"></i> New User</a>
	</div>
</div>
<br/>

<div id="count_result" class="row">
	<div class="col-lg-12">
		
		@if(count($user)>0)
		<span>{{ count($user) }}</span> record/s found &nbsp;
		@endif
	</div> 	
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="tbl_form_design" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>USER IMAGE</th>
						<th>FULLNAME</th>
						<th>DEPARTMENT</th>
						<th>USER-ROLE</th>
						<th colspan="2" style="text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
				
				@if(count($user) == 0)	
					<tr>
						<td colspan="4">No record found!</td>
					</tr>
				
				@else	
					@foreach($user as $row)				
					<tr
					@if($row->active == 0)
						style=" opacity: 0.4;filter: alpha(opacity=40);"
					@endif
					>
						<td><img src="{{ URL::asset('asset/img/user-img') . '/' . $row->image }}" alt="default-image" class="default_image" /></td>
						<td>{{ $row->fullname }}</td>
						<td><span style="color:green;">{{ $row->department }}</span></td>
						<td><span style="color:blue;">{{ $row->role }}</span></td>
						
						@if($row->active > 0)
						<td class="action">
							{{ HTML::linkRoute('role.manageprivilleges','Update Role', $row->id, array('class' => 'btn btn-info btn-xs')) }}
						</td>
						@endif
						
						@if($row->active == 0)

						<td class="action">
							{{ Form::open(array('method' => 'PUT', 'route' => array('user.update', $row->id))) }}                       
							{{ Form::submit('Activate', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to activate this user?')){return false;};")) }}
							{{ Form::close() }}
						</td>

						@else

						<td class="action">
							{{ Form::open(array('method' => 'DELETE', 'route' => array('user.destroy', $row->id))) }}                       
							{{ Form::submit('Inactivate', array('class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to inactivate this user?')){return false;};")) }}
							{{ Form::close() }}
						</td>
					
						@endif
					</tr>
					@endforeach
				@endif

				</tbody>
			</table> 
		
		<div id="pgntn_form_design" class="pagination"> {{ $user->links() }} </div>	
		</div>
	</div>
</div>

@stop