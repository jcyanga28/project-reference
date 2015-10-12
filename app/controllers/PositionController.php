<?php

class PositionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /position
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Designate Position List';

		$position = DB::table('positions')->orderBy('id', 'desc')->paginate(5);

		return View::make('position.index', compact('pagetitle','position'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /position/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = "Create Position";
		return View::make('position.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /position
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Position::$rules);

		if($validation->passes()){
			
			$position = new Position();

			$position->position = strtoupper(Input::get('position'));
			$position->save();
			return Redirect::route('designated-position.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('designated-position.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /position/{id}
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
	 * GET /position/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = "Update Position";

		$position = Position::find($id);
		return View::make('position.edit', compact('pagetitle','position'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /position/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Position::$rules);

		if($validation->passes()){

			$position = Position::find($id);

			if(is_null($position)){
				return Redirect::route('designated-position.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Position information does not exist.');
			}

			$position->position = strtoupper(Input::get('position'));
			$position->save();

			return Redirect::route('designated-position.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('designated-position.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /position/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$position = Position::find($id)->delete();

		if(is_null($position)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('designated-position.index')
								->with('class', $class)
								->with('message', $message);
	}

}