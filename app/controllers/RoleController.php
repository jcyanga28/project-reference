<?php

class RoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /role
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'User Role';

		$role = Role::orderBy('name')->paginate(5);
		return View::make('role.index', compact('pagetitle', 'role'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /role/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create User Role';
		return View::make('role.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /role
	 *
	 * @return Response
	 */
	public function store()
	{
		
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Role::$rules);

		if($validation->passes())
		{
			$role = new Role();
			$role->name = strtoupper(Input::get('name'));
			$role->save();
			return Redirect::route('role.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{

			return Redirect::route('role.create')
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation error.');
		
		}

	}

	/**
	 * Display the specified resource.
	 * GET /role/{id}
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
	 * GET /role/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$pagetitle = 'Update User Role';

		$role = Role::find($id);
		return View::make('role.edit', compact('pagetitle', 'role'));

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Role::$rules);

		if($validation->passes()){

			$role = Role::find($id);

			if(is_null($role)){

				return Redirect::route('role.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Role information not exist.');
			}

			$role->name = strtoupper(Input::get('name'));
			$role->save();

			return Redirect::route('role.index')
								->with('class', 'success')
								->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('role.edit', $id)
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation error.');
		
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /role/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$role = Role::find($id)->delete();

		if(is_null($role)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('role.index')
								->with('class', $class)
								->with('message', $message);

	}

	public static function manageprivilleges($id)
	{
		$pagetitle = 'Update User Role';

		$user_id = $id;

		$selectrole = DB::table('assigned_roles')->where('user_id', $id)->first();
		$myrole = DB::table('roles')->where('id', $selectrole->role_id)->first();

		$roles = Role::orderBy('name')->where('id', '!=', $myrole->id)->lists('name', 'id');
		return View::make('user.roleedit', compact('pagetitle', 'myrole', 'roles', 'user_id'));
	}

	public static function updateprivilleges($id)
	{
		$role = DB::table('assigned_roles')->where('user_id', $id);

		if(is_null($role)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$role_id = Input::get('name');
			DB::table('assigned_roles')->where('user_id', $id)->update(array('role_id' => $role_id));

			$class = 'success';
			$message = 'User role successfully update.';

		}

		return Redirect::route('user.index')
								->with('class', $class)
								->with('message', $message);
	}

}