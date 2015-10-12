<?php

class DepartmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /department
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = "Department";

		$department = DB::table('departments')->orderBy('id', 'desc')->paginate(5);
		return View::make('department.index', compact('pagetitle', 'department'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /department/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = "Create Department";
		return View::make('department.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /department
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Department::$rules);

		if($validation->passes()){
			
			$department = new Department();

			$department->department = strtoupper(Input::get('department'));
			$department->save();
			return Redirect::route('department.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('department.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');
		}

	}

	/**
	 * Display the specified resource.
	 * GET /department/{id}
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
	 * GET /department/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = "Update Department";

		$department = Department::find($id);
		return View::make('department.edit', compact('pagetitle','department'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /department/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Department::$rules);

		if($validation->passes()){

			$department = Department::find($id);

			if(is_null($department)){
				return Redirect::route('department.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Department information does not exist.');
			}

			$department->department = strtoupper(Input::get('department'));
			$department->save();

			return Redirect::route('department.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('department.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /department/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$department = Department::find($id)->delete();

		if(is_null($department)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('department.index')
								->with('class', $class)
								->with('message', $message);
	}

}