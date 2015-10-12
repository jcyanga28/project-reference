
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Project Reference System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="shortcut icon" href="{{ URL::asset('asset/img/favicon.ico') }}" type="image/x-icon"/>
		<link rel="icon" href="{{ URL::asset('asset/img/favicon.ico') }}" type="image/x-icon"/>

		<!-- css -->
		{{ HTML::style('asset/css/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('asset/css/css/bootswatch.min.css') }}
		{{ HTML::style('asset/css/frontend-style.css') }}
		{{ HTML::style('asset/css/font-awesome-4.2.0/css/font-awesome.min.css') }}
		{{ HTML::style('asset/css/colorbox/css/colorbox.css') }}
		<link rel="stylesheet" href="http://openlayers.org/en/v3.0.0/css/ol.css" type="text/css">
		{{ HTML::style('asset/css/style.css') }}
		{{ HTML::style('asset/css/alert/alert.css') }}
		{{ HTML::style('asset/css/notification/notif.css') }}
		{{ HTML::style('asset/css/chosen.css') }}
		{{ HTML::style('asset/css/prettyphoto/main.css') }}

		{{ HTML::style('asset/css/datepicker/datepicker.css') }}

		<!-- script -->
		{{ HTML::script('asset/js/bootstrap/jquery-1.11.1.min.js') }}
		{{ HTML::script('asset/js/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('asset/js/colorbox/js/jquery.colorbox-min.js') }}
		<!-- {{ HTML::script('assets/plugins/twitter-bootstrap/js/bootswatch.js') }} -->
		<script src="http://openlayers.org/en/v3.0.0/build/ol.js" type="text/javascript"></script>
		{{ HTML::script('asset/js/highlight.js') }}
		{{ HTML::script('asset/js/map.js') }}
		{{ HTML::script('asset/js/app.js') }}
		{{ HTML::script('asset/js/typeahead.js') }}
		{{ HTML::script('asset/js/typeahead.min.js') }}
		{{ HTML::script('asset/js/notification/notif.js') }}
		{{ HTML::script('asset/js/chosen.jquery.js') }}
		<!-- {{ HTML::script('asset/js/prettyphoto/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }} -->
		<!-- {{ HTML::script('asset/js/prettyphoto/vendor/bootstrap.min.js') }} -->
		{{ HTML::script('asset/js/prettyphoto/plugins.js') }}
		{{ HTML::script('asset/js/prettyphoto/jquery.prettyPhoto.js') }}
		{{ HTML::script('asset/js/prettyphoto/main.js') }}

		{{ HTML::script('asset/js/multifile/jquery.form.js') }}
		{{ HTML::script('asset/js/multifile/jquery.MetaData.js') }}
		{{ HTML::script('asset/js/multifile/jquery.MultiFile.js') }}	

		{{ HTML::script('asset/js/datepicker/datepicker-ui.js') }}
		<script type="text/javascript">
		$(document).ready(function() {
		@section('page-script')

        @show
        });
        </script>

		<style type="text/css">
		body {
			  padding-top: 50px;
			}
		.page-header{
			border-bottom: 1px solid #eeeeee;
		    margin: 0 0 20px;
		    padding-bottom: 9px;
		}
		.main{
			padding-top: 30px;
		}
		#appsname-font
		{
			font-size: 16px;
		}
		#menu-font
		{
			font-size: 12px;
		}

		.submenu-font
		{
			font-size: 12px;
			font-family: Tahoma;
			color: #333;
			margin-left: -5px;
		}
		.submenu-font:hover
		{
			font-size: 12px;
			font-family: Tahoma;
			color: #333;
			margin-left: -5px;
		}
		#count_result
		{
			float: right;
			color: #666;
			font-weight: bold;
		}
		.btn_form_design
		{
			font-size: 12px; 
			font-weight: bold;
		}
		#profile_input
		{
			width: 60%;
			font-size: 13px;
			color: #666;
		}
		#tbl_form_design
		{
			font-size: 11px; 
			margin-top: 5px;
		}
		#pgntn_form_design
		{
			float: right;
			 margin-top: -15px;
		}
		#search_input_form_design
		{
			font-size: 12px;
			height: 40px;
			margin-top: 1px;
		}
		#search_input_form_designs
		{
			font-size: 12px;
			height: 40px;
			margin-top: 1px;
			width: 440px;
		}
		#tbl_details_design
		{
			width: 100%; 
			border: solid 1px #eee; 
			font-size: 13px;
		}
		#detail_tbl_design
		{
			width: 65%; 
			border: solid 1px #eee; 
			font-size: 11px;
		}
		#forms_style
		{
			width: 275px;
			height: 30px;
			font-size: 12px;
			border: 2px solid #eee;
			border-radius: 3px;
		}
		#forms_style_company
		{
			width: 275px;
			height: 45px;
			font-size: 12px;
			border: 2px solid #eee;
			border-radius: 3px;
		}
		#tbl_details_td
		{
			background-color: #eee; 
			width: 30%; 
			color: #666; 
			font-weight: bold;
			border:solid 1px #fff;
			text-align: center;
		}
		#btn_design
		{
			height: 45px;
		}
		#dashboard_container
		{
			/*border: solid 2px #eee; */
			margin: 0 auto;
		}
		#dashboard_request_content
		{
			/*border:1px #eee solid;
			border-radius: 5px;
			box-shadow:0px 0px 2px rgb(136,136,136); */
			width: 95%; 
			margin: 0 auto; 
		}
		#count_request
		{
			color:red; 
			font-weight: bold;
		}
		#notif_content
		{
			width: 75%;
			margin: 0 auto;
		}
		#notif_count
		{
			font-size: 20px; 
			font-weight: bold; 
			color: #666; 
			font-family: arial;
		}
		#bdo_border_notif
		{
			border: solid 1px #666;
			box-shadow:1px 2px 3px rgb(136,136,136);
		}
		#bdo_font_notif
		{
			font-size: 12px; 
			font-weight: bold; 
			font-style: italic;
		}
		#bdo_font_notif1
		{
			font-size: 11px; 
			font-weight: bold; 
			font-style: italic;
		}
		#notifbox_font
		{
			font-style: italic;
			text-align:right;
			font-size: 10px;
		}
		#notif_phar 
		{ 
			font-size:10px; 
			color:#000; 
			margin:5px 5px 5px 80px; 
		}
		#related_title
		{
			font-size: 18px; 
			font-weight: bold;
		}
		.default_image
		{
			width: 30px;
			height: 25px;
			border: solid 1px #000;
			margin-left: 15px;
		}
		.new_address_btn
		{
			font-size: 11px;
			height: 30px;
			border: solid 1px #666;
			border-radius: 3px;
			font-weight: bold;
			font-style: italic;
			font-family: ARIAL;
		}
		.cancel_address_btn
		{
			font-size: 11px;
			height: 30px;
			border: solid 1px #666;
			background-color: #ff0000;
			color: #fff;
			border-radius: 3px;
			font-weight: bold;
			font-style: italic;
			font-family: ARIAL;
		}
		.new_contact_btn
		{
			font-size: 11px;
			height: 30px;
			border: solid 1px #666;
			background-color: #333;
			color: #fff;
			border-radius: 3px;
			font-weight: bold;
			font-style: italic;
			font-family: ARIAL;
		}
		.cancel_contact_btn
		{
			font-size: 11px;
			height: 30px;
			border: solid 1px #666;
			background-color: #fff;
			color: #333;
			border-radius: 3px;
			font-weight: bold;
			font-style: italic;
			font-family: ARIAL;
		}
		.proj_form
		{
			border: solid 1px #cccccc; 
			width: 98%; 
			margin: 0 auto; 
			box-shadow:1px 1px 1px rgb(136,136,136); 
			background-color: #eeeeee;
		}
		.proj_form_container
		{
			margin-left: 100px; 
			margin-top: 10px;
		}
		.proj_form_label
		{
			font-size: 12px; 
			font-weight: bold;
		}
		.proj_form_radio
		{
			margin-top: 2px;
		}
		.proj_list
		{
			width: 98%; 
			margin: 0 auto;
		}
		#proj_list_table
		{
			border: solid 1px #cccccc; 
			width: 100%; 
			box-shadow:1px 1px 1px rgb(136,136,136); 
			border-radius: 3px; 
			font-size: 12px;
		}
		#proj_list_tblhead
		{
			font-weight: bold; 
			color: #333;
			background-color: #eee;
		}
		.warning_project
		{
			color: yellow;
		}
		.pending_project
		{
			color: #f90007;
			font-weight: bold;
		}
		.normal_project
		{
			color: blue;
			font-weight: bold;
		}
		.closed_project
		{
			color: #000;
			font-weight: bold;
		}
		.proj_form_legend
		{
			border: solid 1px #cccccc; 
			width: 98%; 
			margin: 0 auto; 
			box-shadow:1px 1px 1px rgb(136,136,136); 
			background-color: #eeeeee;
		}
		#legend ul
		{
			padding: 0px 0px 0px 0px;
		    list-style: none;
		    line-height: normal;
		}
		#legend li
		{
			font-size: 11px;
			text-transform: uppercase;
			font-weight: bold;
			position: relative;
    		display: inline-block;
		}
		.l_1
		{
			border: solid 1px #46cfff; 
			height: 5px; 
			background-color: #46cfff; 
			color: transparent; 
			line-height: 50px; 
			letter-spacing: 20px;
		}
		.l_2
		{
			border: solid 1px blue; 
			height: 5px; 
			background-color: blue; 
			color: transparent; 
			line-height: 50px; 
			letter-spacing: 20px;
		}
		.l_3
		{
			border: solid 1px red; 
			height: 5px; 
			background-color: red; 
			color: transparent; 
			line-height: 50px; 
			letter-spacing: 20px;
		}
		.l_4
		{
			border: solid 1px gray; 
			height: 5px; 
			background-color: gray; 
			color: transparent; 
			line-height: 50px; 
			letter-spacing: 20px;
		}
		.proj_id
		{
			color: #46cfff;
		}
		.closedproj_form_status_details
		{
			border: solid 1px #eee; 
			border-radius: 15px;
			width: 80%; 
			margin: 0 auto; 
			box-shadow:1px 2px 3px rgb(136,136,136); 
			background-color: gray;
		}
		.closedtbl_details_status
		{
			width: 100%;
			background-color: gray;
			font-size: 13px;
			color: #fff;
			/*margin-top: 5px; */
			/*margin-left: 60px;*/
		}
		#closedproj_status_tbl_details_td
		{
			font-size: 12px;
			text-transform: uppercase;
			color: #fff; 
			font-weight: bold;
			border-bottom: solid #666 1px;
			/*border-right: solid #666 1px;*/
			width: 225px;
		}
		.closedproj_form_status_chatbox
		{
			border: solid 1px #eee; 
			box-shadow: 2px 2px 2px rgb(136,136,136);
			background-color: gray;
			width: 98%; 
			margin: 0 auto; 
		}
		#closed_msg_datetime
		{
			text-align: right; 
			font-size: 10px; 
			font-style: italic;
			color: #fff;
			font-weight: bold;
			/*margin-top: 10px;*/
		}
		#closed_thread_attachments
		{
			width: 70%; 
			margin: 0 auto; 
			font-size: 11px; 
			color: #fff;
		}
		.proj_form_status_details
		{
			border: solid 1px #eee; 
			border-radius: 15px;
			width: 100%; 
			margin: 0 auto; 
			box-shadow:1px 2px 3px rgb(136,136,136); 
			background-color: #ffffd5;
		}
		#proj_details_title
		{
			margin-left: 50px; 
			color: blue;
		}
		.tbl_details_status
		{
			width: 100%;
			background-color: #ffffd5;
			font-size: 13px;
			/*margin-top: 5px; */
			/*margin-left: 60px;*/
		}
		#proj_status_tbl_details_td
		{
			font-size: 11px;
			color: #666; 
			font-weight: bold;
			border-bottom: solid #666 1px;
			border-right: solid #666 1px;
			width: 225px;
			text-transform: uppercase;
		}
		#project_contacts
		{
			list-style-type:none; margin-left: -35px;
		}
		#proj_status_tbl_info_td
		{
			font-size: 11px;
			border-bottom: solid #666 1px;
		}
		.project_attachment_title
		{
			color: #333; 
			font-weight: bold; 
			font-size: 12px; 
			font-family: arial;
		}
		.proj_form_status_image
		{
			border: solid 1px #fff; 
			width: 75%; 
			margin: 0 auto; 
		}
		#proj_img_title
		{
			color: blue; 
			font-size: 16px; 
			margin-left: 10px;
		}
		#proj_img_gallery
		{
			margin-left: 5px; 
			margin-top: 10px;
		}
		.proj_form_status_chatbox
		{
			border: solid 1px #eee; 
			box-shadow: 2px 2px 2px rgb(136,136,136);
			width: 98%; 
			margin: 0 auto; 
		}
		#closed_chkbox
		{
			margin-left: 20px; 
			margin-top: 20px; 
			font-size: 12px; 
			font-weight: bold; 
			color: #666;
		}
		#closes_chkbox
		{
			font-size: 12px; 
			font-weight: bold; 
			color: #666;
		}
		#msgbox
		{
			margin-left: 20px; 
			margin-top: -10px;
		}
		#msg_img
		{
			margin-left: 20px; 
			font-size: 12px; 
			color: #666; 
			font-weight: bold; 
			text-transform: uppercase;
		}
		#msg_container
		{
			margin-top: 30px;
			width: 75%; 
			margin: 0 auto;
			/*margin-left: 30px;*/
			border: solid 1px #eee;
			box-shadow: 1px 2px 3px rgb(136,136,136);
			border-top-left-radius: 50px;
			border-bottom-left-radius: 50px;
			/*margin-left: -15px; */
			/*margin-top: 5px;*/
		}
		#msg_datetime_container
		{
			margin-top: 30px;
			width: 75%; 
			margin: 0 auto;
			/*margin-left: 30px;*/
			border: solid 1px transparent;
		}
		#msg_attachments_container
		{
			margin-top: 30px;
			width: 75%; 
			margin: 0 auto;
			/*margin-left: 30px;*/
			border: solid 1px transparent;
		}
		#thread_comment_container
		{
			margin-top: 30px;
			width: 65%;
			height: 60px;	 
			margin: 0 auto;
			background: #eee;
			/*margin-left: 30px;*/
			border: solid 1px #eee;	
		}
		#thread_attachments
		{
			width: 60%; 
			margin: 0 auto; 
			font-size: 11px; 
			color: #666;
		}
		#msg_content
		{
			width: 90%; 
			/*background-color: #fff; */
			border: solid 1px #eee;
			box-shadow: 1px 1px 1px rgb(136,136,136);
			border-radius: 5px;
			margin-left: -10px; 
			margin-top: 5px;
		}
		#msg_createdby
		{
			font-size: 12px; 
			color: #333; 
			font-weight: bold; 
			margin-left: 5px;
			margin-top: -10px;
		}
		#msg_remarks
		{
			margin-left: 10px; 
			text-transform: uppercase; 
			color: #333; 
			font-size: 11px;
		}
		.btn_download
		{
			border: 0;
			background: transparent;
			color: #000;
		}
		.btn_download:hover
		{
			border: 0;
			background: transparent;
			color: blue;
			text-decoration: underline;
		}
		#msg_datetime
		{
			text-align: right; 
			font-size: 10px; 
			font-style: italic;
			color: #666;
			font-weight: bold;
			/*margin-top: 10px;*/
		}
		.proj_form_status_addthread
		{
			/*border-radius: 10px;*/
			width: 98%; 
			margin: 0 auto; 
			/*box-shadow:1px 2px 3px rgb(136,136,136); */
			/*background-color: #fff;*/
		}
		.help-block
		{
			color: red;
			font-size: 11px;
		}
		#area_input
		{
			width: 75%;
			font-size: 12px;
			color: #666;
		}
		#assignarea_select
		{
			width: 55%;
			font-size: 12px;
		}
		#update_userrole
		{
			width: 55%;
			font-size: 12px;
			color: #666;
		}
		#clienttype_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#dept_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#position_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#projects_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#role_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#users_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#item_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#txtarea_input
		{
			font-size: 12px;
			border: solid 2px #eee;
			border-radius: 5px;
		}
		#task_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#desc_input
		{
			width: 75%;
			font-size: 13px;
			color: #666;
		}
		#yourimg
		{
			font-size: 12px;
			color: #666;
		}
		#change_bdo_btn
		{
			font-size: 11px;
		}
		#menu-header
		{
			/*#2C3E50;*/
			background-color: #333;
			height: 25px;
			border: solid 0.5px #333;
			width: 195px;
			margin-left: -16px;
			color: #fff; 
			font-family: tahoma; 
			font-size: 13px; 
			text-align: center;
		}
		#menu-header1
		{
			/*#2C3E50;*/
			background-color: #fff;
			height: 25px;
			width: 175px;
			margin-left: -6px;
			color: #333; 
			font-family: tahoma; 
			font-size: 13px; 
			text-align: center;
		}
		#profile-img
		{
			height: 125px; 
			width: 135px; 
			margin-left: 15px; 
			/*border: solid 1px #666;*/
			/*border-radius: 3px;*/
		}
		#content-container
		{
			margin-top:10px; 
			border: solid 1px #333; 
			border-radius: 3px;
			box-shadow:1px 2px 3px rgb(136,136,136);
		}
		.right-side-divider
		{
			border-right: solid 1px #333;
			border-left: solid 1px #333;
		}
		.left-side-divider
		{
			border-left: solid 1px #333;
		}
		.img-threads
		{
			border: 0; background-color: #fff; font-weight: bold;
		}
		.img-threads:hover
		{
			border: 0; background-color: #F9F9F9;
		}
		.contact_input
		{
			width: 50%;
			height: 38px;
			font-size: 12px;
			color: #666;
			border: solid 1px #333;
			border-radius: 3px;
		}
		.company_input
		{
			width: 50%;
			height: 38px;
			font-size: 12px;
			color: #666;
			border: solid 1px #333;
			border-radius: 3px;
		}
		.project_input
		{
			width: 65%;
			height: 38px;
			font-size: 12px;
			color: #666;
			border: solid 1px #333;
			border-radius: 3px;
		}
		.contact_task_input
		{
			width: 50%;
			height: 38px;
			font-size: 12px;
			color: #666;
			border: solid 1px #333;
			border-radius: 3px;
		}
		#amount_input
		{
			width: 30%;
			background-color: #000;
			height: 38px;
			font-size: 12px;
			color: #fff;
			font-weight: bold;
			border-color: #fff;
			border-radius: 3px;
		}
		#remarks_input
		{
			font-size: 12px;
			color: #666;
			border: solid 1px #333;
			border-radius: 3px;
		}
		.date_input
		{
			width: 80%;
			height: 38px;
			text-align: center;
			font-size: 12px;
			color: #666;
			border: solid 1px #333;
			border-radius: 3px;
		}
		.photo_files
		{
			font-size: 12px;
			color: #333;
		}
		.btn-decline
		{
			margin-top: -70px;
			margin-left: 197px; 
		}
		</style>

		<script type="text/javascript">
			$(document).ready(function(){

			var domain ="http://"+document.domain;

			$('#body-content').hide();
			// $('#divLoadingBar').hide();

			$(window).load(function () {
			    $('#divLoading').fadeOut("slow");
			    $('#body-content').show();

			});

			});
		 </script>
		 
	</head>
	<body>
		<div id="menu-font" class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="{{ URL::route('dashboard.index') }}" id="appsname-font" class="navbar-brand">Project Reference System</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download"> <b>WELCOME | </b> {{ strtoupper(Session::get('name')) }} &nbsp; <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="download">
							<li><a href="{{ URL::to('/edit-profile' . '/' . Auth::id()) }}">Edit Profile</a></li>
							<li>{{ HTML::link('/logout', 'Logout') }}</li>
						</ul>
					</li>
				</ul>

			</div>
		</div>
		<br/>

		<div style="margin-top:40px;" id="divLoading">
			<div class="loading" align="center" id="divImageLoader">
			    <img src="{{ URL::asset('asset/img/spinner-blue.gif') }}" style="height: 5%; width: 5%;"></img><br/>
			    <b style="font-size:12px;color: #333;font-weight:bold;"> Please wait </b> 
			</div>
			<br/>
	    </div>

		<div id="content-container" class="container">
			<div class="row">

				<div class="col-xs-12 col-sm-6 col-md-2 right-side-divider">
					
					<br/>
					<div class="form-group">
						<img src="{{ URL::asset('asset/img/user-img' . '/' . Session::get('myimage')) }}" alt="No image." class="img-circle" id="profile-img">
					</div>
					
					<ul style="list-style-type:none;margin-left: -40px;">
					@if(Session::get('role') == 1)		
						<li id="menu-header"><b>SETTINGS</b></li>
						<li>{{ HTML::linkRoute('area.index', 'Area List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('assign.area.index', 'Assign BDO-Area', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('client.index', 'Client Type Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('department.index' , 'Department Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.classification.index', 'Project Classification', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.category.index', 'Project Categories', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.stage.index', 'Project Stages', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.status.index', 'Project Status', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('designated-position.index', 'Position Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('role.index', 'Role Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('user.index', 'User Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('user.index', 'Other Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('task.index', 'Task Maintenance', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>

					<ul style="list-style-type:none;margin-left: -40px;">
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)
						<li id="menu-header"><b>FILE MAINTENANCE</b></li>
						<li>{{ HTML::linkRoute('item.index', 'Marketing Materials', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>ACCOUNT DIRECTORY</b></li>
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)		
						<li>{{ HTML::linkRoute('company.index', 'My Company List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('contact.index', 'My Contact Person List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
						
					@if(Session::get('role') == 1)
						<li class="divider"></li>
					@endif

					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 4)		
						<li>{{ HTML::linkRoute('company.ra', 'Company Approval List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('contact.ra', 'Contact Person Approval List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.ra', 'Project Approval List', array(), array('class' => 'submenu-font')) }}</li>
						<!-- <li>Process Project</li> -->
					@endif
					</ul>	

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>PROJECT DIRECTORY</b></li>
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)
						<li>{{ HTML::linkRoute('project.index', 'My Project List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3 || Session::get('role') == 4)
						<li>{{ HTML::linkRoute('project.list', 'My Assigned-Project List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>

					<ul style="list-style-type:none;margin-left: -40px;">
						@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3 || Session::get('task_receiver_access') > 0 || Session::get('task_approver_access') > 0)
						<li id="menu-header"><b>TASK DIRECTORY</b></li>
						@endif
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)
						<li>{{ HTML::linkRoute('create.mytask', 'My Task', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					@if(Session::get('role') == 1 || Session::get('task_receiver_access') > 0)
						<li>{{ HTML::linkRoute('task.request.receiver.forcontact', 'Task Receiver List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					@if(Session::get('role') == 1 || Session::get('task_approver_access') > 0)
						<li>{{ HTML::linkRoute('task.request.approver.forcontact', 'Task Approver List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>	

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>REPORTS</b></li>
						<li></li>
						<li id="menu-header1"><b>PROJECT LIST</b></li>
						<li>{{ HTML::linkRoute('project.via.categories', 'Search by Categories', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.developer', 'Developer(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.developer', 'Developer(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.gencon', 'Gen-Con(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.gencon', 'Gen-Con(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.mngr.designer', 'Mngr/Designer(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.mngr.designer', 'Mngr/Designer(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.architect', 'Architect(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.architect', 'Architect(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.applicator', 'Applicator', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.applicator', 'Sub-Applicator', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.dealer.supplier', 'Dealer/Supplier', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.dealer.supplier', 'Sub-Dealer/Supplier', array(), array('class' => 'submenu-font')) }}</li>
					</ul>

					@if(Session::get('role') == 1)
						<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>UTILITIES</b></li>
						<li>{{ HTML::linkRoute('project.list', 'User Logs', array(), array('class' => 'submenu-font')) }}</li>
						</ul>
					@endif	
				
				<br/>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-10 left-side-divider">
					<!-- <div class="container">	 -->

						<div id="body-content">

							@if(isset($pagetitle))
					        <div style="margin-top: 10px;" class="page-header" id="banner">
								<div class="row">
									<div class="col-lg-12">
										<h3>{{ $pagetitle }}</h3>

									</div>

								</div>
							</div>
							@endif

							@if (Session::has('message'))
				    		<div class="alert-box {{ Session::get('class') }}" style="font-size:14px;font-family: Segoe UI Semibold;">
				    			<span style="margin-left: 20px;"><b>{{ strtoupper(Session::get('class')) . '!' }}</b> {{ Session::get('message') }}</span>
				    		</div>
							@endif

				            <!-- @if ($errors->any())
							    <ul>
							        {{ implode('', $errors->all('<li style="font-size: 13px; font-style: italic;">:message</li>')) }}
							    </ul>
							@endif -->

							<div style="margin-top: 30px;">
								@yield('content')
							</div>
							<br/>
						<!-- </div> -->

					</div>
				</div>

			</div>	
		</div>
		<br/>

	</body>
</html>
