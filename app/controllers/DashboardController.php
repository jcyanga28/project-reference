<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /maincontroller
	 *
	 * @return Response
	 */
	public function index()
	{

		$pagetitle = 'Dashboard';

		$request_contact = DB::table('contacts')->where('status', '=', '1')->get();
		$request_company = DB::table('companies')->where('status', '=', '1')->get();
		$request_project = DB::table('projects')->where('status', '=', '1')->get();

		if(Session::get('role') == 1 || Session::get('role') == 2)
		{
			$contact_result_ofrequest = DB::table('contacts')->where('notif', '=', '1')->get();
		
		}else{
			$contact_result_ofrequest = DB::table('contacts')->where('created_by', '=', Auth::id())->where('notif', '=', '1')->get();
			
		}

		if(Session::get('role') == 1 || Session::get('role') == 2)
		{
			$company_result_ofrequest = DB::table('companies')->where('notif', '=', '1')->get();
		
		}else{
			$company_result_ofrequest = DB::table('companies')->where('created_by', '=', Auth::id())->where('notif', '=', '1')->get();
			
		}

		if(Session::get('role') == 1 || Session::get('role') == 2)
		{
			$project_result_ofrequest = DB::table('projects')->where('notif', '=', '1')->get();
		
		}else{
			$project_result_ofrequest = DB::table('projects')->where('bdo_id', '=', Auth::id())->where('notif', '=', '1')->get();
			
		}

		if(Session::get('role') == 1 || Session::get('role') == 2)
		{
			$assignedproject_result_ofrequest = DB::table('projects')->where('status', '=', '2')->get();
			$assignedproject_forcc_result_ofrequest = DB::table('project_users')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
					->join('projects', 'projects.id', '=', 'project_users.project_id')
					->join('users', 'users.id', '=', 'project_users.created_by')
					->where('project_users.status', 2)
					->distinct()
					->orderBy('id', 'desc')
					->get();

		}elseif(Session::get('role') == 3){
			$assignedproject_result_ofrequest = DB::table('project_users')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
					->join('projects', 'projects.id', '=', 'project_users.project_id')
					->join('users', 'users.id', '=', 'project_users.created_by')
					->where('project_users.user_id', Auth::id())
					->where('project_users.status', 2)
					->distinct()
					->orderBy('id', 'desc')
					->get();
			
		}else{
			$assignedproject_forcc_result_ofrequest = DB::table('project_users')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
					->join('projects', 'projects.id', '=', 'project_users.project_id')
					->join('users', 'users.id', '=', 'project_users.created_by')
					->where('projects.approved_by', Auth::id())
					->where('project_users.status', 2)
					->distinct()
					->orderBy('id', 'desc')
					->get();
		}

		return View::make('dashboard.index', compact('pagetitle', 'request_contact', 'request_company', 'request_project', 'contact_result_ofrequest', 'company_result_ofrequest', 'project_result_ofrequest', 'assignedproject_result_ofrequest', 'assignedproject_forcc_result_ofrequest'));
	}

	public function edit_profile($id)
	{
		$pagetitle = 'Update Profile';

		$userinfo = User::find($id);
		return View::make('dashboard.edit-profile', compact('pagetitle','userinfo'));
	
	}

	public function updateprofile($id)
	{	
		$first_name = Input::get('first_name');
		$middle_initial = Input::get('middle_initial');
		$last_name = Input::get('last_name');
		$email = Input::get('email');

		$rules = array(
        'first_name' => 'required',
        'middle_initial' => 'required',                       
        'last_name' => 'required',  
        'email' => 'required',
	    );

	    $messages = array(
	        'required' => 'The :attribute is really important.',
	    );

	    $validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->passes())
		{
			$user = User::find($id);
            $user->first_name = strtoupper(Input::get('first_name'));
            $user->middle_initial = strtoupper(Input::get('middle_initial'));
            $user->last_name = strtoupper(Input::get('last_name'));
            $user->email = Input::get('email');

            if(count(Input::file('image'))> 0)
            {	
         		$img = Input::file('image');
            	$destinationPath = base_path() . '/public/asset/img/user-img'; // upload path

		    	// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	        	$imgname = $img->getClientOriginalName();

	        	$user->image = $imgname;
	        	$upload_success = $img->move($destinationPath, $imgname);

	        	$user->save();

	        	Session::put('myimage', $imgname);

	        	return Redirect::route('edit.profile', $id)
						->withInput()
						->with('class', 'success')
						->with('message', 'Account information was successfully updated.');

            }

            	$user->save();
	        	return Redirect::route('edit.profile', $id)
						->withInput()
						->with('class', 'success')
						->with('message', 'Account information was successfully updated.');

		}else{
			return Redirect::route('edit.profile', $id)
						->withInput()
						->withErrors($validator)
						->with('class', 'error')
						->with('message', 'There were validation errors.');
		}
	
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /maincontroller/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /maincontroller
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /maincontroller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /maincontroller/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /maincontroller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /maincontroller/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}