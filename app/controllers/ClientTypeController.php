<?php

class ClientTypeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /clienttype
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Client Type';

		$clienttype = DB::table('types')->orderBy('id', 'desc')->paginate(5);
		return View::make('client_type.index', compact('pagetitle', 'clienttype'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /clienttype/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Client Type';
		return View::make('client_type.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /clienttype
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Type::$rules);
		
		if($validation->passes())
		{
			$client = new Type();
			$client->client_type = strtoupper(Input::get('client'));
			$client->desc = strtoupper(Input::get('description'));			
			$client->save();			
			return Redirect::route('client.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('client.create')
							->withInput()
							->withErrors($validation)
							->with('class', 'error')
							->with('message', 'There were validation error.');

		}

	}

	/**
	 * Display the specified resource.
	 * GET /clienttype/{id}
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
	 * GET /clienttype/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Client Type';

		$clienttype = Type::find($id);
		return View::make('client_type.edit', compact('pagetitle', 'clienttype'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /clienttype/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Type::$update_rules);

		if($validation->passes()){

			$client = Type::find($id);

			if(is_null($client)){
				return Redirect::route('client.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Client Type information does not exist.');
			}

			$client->client_type = strtoupper(Input::get('client'));
			$client->desc = strtoupper(Input::get('description'));

			if(Type::checkif_exist($client)){
				return Redirect::route('client.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Client Type information already exist.');
			}

			$client->save();

			return Redirect::route('client.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('client.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /clienttype/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$client = Type::find($id)->delete();

		if(is_null($client)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('client.index')
								->with('class', $class)
								->with('message', $message);
	}

}