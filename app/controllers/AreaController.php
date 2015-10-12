<?php

class AreaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /area
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Area List';

		$area = DB::table('areas')->orderBy('id', 'desc')->paginate(10);
		return View::make('area.index', compact('pagetitle', 'area'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /area/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Area List';
		return View::make('area.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /area
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Area::$rules);

		if($validation->passes())
		{	
			$area = new Area();
			$area->area_no = Input::get('area_number');
			$area->area_place = strtoupper(Input::get('area_place'));
			$area->save();
			return Redirect::route('area.index')
							->with('class', 'success')
							->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('area.create')
							->withInput()
							->withErrors($validation)
							->with('class', 'error')
							->with('message', 'There were validation errors.');

		}

	}

	/**
	 * Display the specified resource.
	 * GET /area/{id}
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
	 * GET /area/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Area List';

		$area = Area::find($id);
		return View::make('area.edit', compact('pagetitle', 'area'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /area/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Area::$update_rules);

		if($validation->passes()){

			$area = Area::find($id);

			if(is_null($area)){
				return Redirect::route('area.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Area information does not exist.');
			}

			$area->area_no = Input::get('area_number');
			$area->area_place = strtoupper(Input::get('area_place'));
			
			if(Area::checkif_recordexist($area)){
				return Redirect::route('area.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Area information already exist.');
			}

			$area->save();

			return Redirect::route('area.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('area.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation errors.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /area/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$area = Area::find($id)->delete();

		if(is_null($area)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('area.index')
								->with('class', $class)
								->with('message', $message);
	}

}