<?php

class AssignedAreaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /assignedarea
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'BDO-Area List';

		$assigned_area = Area::selectrecord(Input::get('s'));
		return View::make('assigned_area.index', compact('pagetitle', 'assigned_area'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /assignedarea/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create BDO-Area List';

		$areas = DB::table('areas')->orderBy('area_place', 'asc')->lists('area_place', 'id');
		
		$users = DB::table('users')
						->select(DB::raw('concat(users.last_name,","," ",users.first_name) as fullname, users.id'))
						->join('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
						->where('assigned_roles.role_id', 3)
						->orderBy('fullname', 'asc')
						->lists('fullname', 'id');
		return View::make('assigned_area.create', compact('pagetitle', 'areas', 'users'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /assignedarea
	 *
	 * @return Response
	 */
	public function store()
	{
		$area_place = Input::get('area_place');
		$bdo_name = Input::get('bdo_name');

		$rules = array(
        'area_place' => 'required',                       
        'bdo_name' => 'required',  
	    );

	    $messages = array(
	        'required' => 'The :attribute is really important.',
	    );

	    $validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->passes())
		{	
			
			if(Area::checkif_alreadyexistinrecord($area_place,$bdo_name))
			{
				return Redirect::route('assign.area.create')
							->with('class', 'warning')
							->with('message', 'BDO already assigned in that area.');
								
			}

			DB::table('assigned_areas')->insert([
				'area_id' => DB::raw('INET_ATON(\''.$area_place.'\')'),
				'user_id' => DB::raw('INET_ATON(\''.$bdo_name.'\')'),
				]);
			
			return Redirect::route('assign.area.index')
							->with('class', 'success')
							->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('assign.area.create')
							->withInput()
							->withErrors($validator)
							->with('class', 'error')
							->with('message', 'There were validation errors.');

		}
	}

	/**
	 * Display the specified resource.
	 * GET /assignedarea/{id}
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
	 * GET /assignedarea/{id}/edit
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
	 * PUT /assignedarea/{id}
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
	 * DELETE /assignedarea/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$assigned_area = DB::table('assigned_areas')->where('id', $id);

		if(is_null($assigned_area)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$ar = DB::table('assigned_areas')->where('id', $id)->delete();
			
			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('assign.area.index')
								->with('class', $class)
								->with('message', $message);
	}

}