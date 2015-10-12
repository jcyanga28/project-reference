<?php

class ProjectStatusController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /projectstatus
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Project Status';

		$status = DB::table('statuses')->orderBy('id', 'desc')->paginate(5);
		return View::make('project.status.index', compact('pagetitle', 'status'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projectstatus/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Project Status';

		return View::make('project.status.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /projectstatus
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Status::$rules);

		if($validation->passes())
		{
			$status = new Status();
			$status->status = strtoupper(Input::get('project_status'));
			$status->description = strtoupper(Input::get('description'));
			$status->save();

			return Redirect::route('project.status.index')
									->with('class', 'success')
									->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('project.status.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Display the specified resource.
	 * GET /projectstatus/{id}
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
	 * GET /projectstatus/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Project Status';

		$status = Status::find($id);
		return View::make('project.status.edit', compact('pagetitle', 'status'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /projectstatus/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Status::$update_rules);

		if($validation->passes())
		{
			
			$status = Status::find($id);

			if(is_null($status)){
				return Redirect::route('project.status.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Project Status information does not exist.');
			}

			$status->status = strtoupper(Input::get('project_status'));
			$status->description = strtoupper(Input::get('description'));
			$status->save();

			return Redirect::route('project.status.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{
			return Redirect::route('project.status.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /projectstatus/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$status = Status::find($id)->delete();

		if(is_null($status)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('project.status.index')
								->with('class', $class)
								->with('message', $message);
	}

}