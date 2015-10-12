<?php

class ProjectStagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /projectstages
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Project Stage';

		$stages = DB::table('stages')->orderBy('id', 'desc')->paginate(5);
		return View::make('project.stage.index', compact('pagetitle', 'stages'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projectstages/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Project Stage';

		return View::make('project.stage.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /projectstages
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Stage::$rules);

		if($validation->passes())
		{
			$stage = new Stage();
			$stage->stage = strtoupper(Input::get('project_stage'));
			$stage->description = strtoupper(Input::get('description'));
			$stage->save();

			return Redirect::route('project.stage.index')
									->with('class', 'success')
									->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('project.stage.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Display the specified resource.
	 * GET /projectstages/{id}
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
	 * GET /projectstages/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Project Stage';

		$stages = Stage::find($id);
		return View::make('project.stage.edit', compact('pagetitle', 'stages'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /projectstages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Stage::$update_rules);

		if($validation->passes())
		{
			
			$stage = Stage::find($id);

			if(is_null($stage)){
				return Redirect::route('project.stage.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Project Stage information does not exist.');
			}

			$stage->stage = strtoupper(Input::get('project_stage'));
			$stage->description = strtoupper(Input::get('description'));
			$stage->save();

			return Redirect::route('project.stage.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{
			return Redirect::route('project.stage.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /projectstages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$stage = Stage::find($id)->delete();

		if(is_null($stage)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('project.stage.index')
								->with('class', $class)
								->with('message', $message);
	}

}