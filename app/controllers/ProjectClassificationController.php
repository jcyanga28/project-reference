<?php

class ProjectClassificationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /projectclassification
	 *
	 * @return Response
	 */
	public function index()
	{

		$pagetitle = 'Project Classification';

		$classifications = DB::table('classifications')->orderBy('id', 'desc')->paginate(5);
		return View::make('project.classification.index', compact('pagetitle', 'classifications'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projectclassification/create
	 *
	 * @return Response
	 */
	public function create()
	{

		$pagetitle = 'Create Project Classification';

		return View::make('project.classification.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /projectclassification
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Classification::$rules);

		if($validation->passes())
		{
			$classification = new Classification();
			$classification->classification = strtoupper(Input::get('project_classification'));
			$classification->description = strtoupper(Input::get('description'));
			$classification->save();

			return Redirect::route('project.classification.index')
									->with('class', 'success')
									->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('project.classification.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}	

	}

	/**
	 * Display the specified resource.
	 * GET /projectclassification/{id}
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
	 * GET /projectclassification/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$pagetitle = 'Update Project Classification';

		$classification = Classification::find($id);
		return View::make('project.classification.edit', compact('pagetitle', 'classification'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /projectclassification/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Classification::$update_rules);

		if($validation->passes())
		{
			
			$classification = Classification::find($id);

			if(is_null($classification)){
				return Redirect::route('project.classification.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Project Classification information does not exist.');
			}

			$classification->classification = strtoupper(Input::get('project_classification'));
			$classification->description = strtoupper(Input::get('description'));
			$classification->save();

			return Redirect::route('project.classification.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{
			return Redirect::route('project.classification.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /projectclassification/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$classification = Classification::find($id)->delete();

		if(is_null($classification)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('project.classification.index')
								->with('class', $class)
								->with('message', $message);
	}

}