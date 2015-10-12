<?php

class ItemController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /item
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Marketing Materials';

		$item = DB::table('items')->orderBy('id', 'desc')->paginate(5);
		return View::make('item.index', compact('pagetitle', 'item'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /item/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Marketing Materials';
		return View::make('item.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /item
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Item::$rules);

		if($validation->passes())
		{
			$item = new Item();
			$item->item = strtoupper(Input::get('item'));
			$item->save();

			return Redirect::route('item.index')
							->with('class', 'success')
							->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('item.create')
							->withInput()
							->withErrors($validation)
							->with('class', 'error')
							->with('message', 'There were validation error.');

		}

	}

	/**
	 * Display the specified resource.
	 * GET /item/{id}
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
	 * GET /item/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Marketing Materials';

		$item = Item::find($id);
		return View::make('item.edit', compact('pagetitle', 'item'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Item::$rules);

		if($validation->passes()){

			$item = Item::find($id);

			if(is_null($item)){
				return Redirect::route('item.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Item information does not exist.');
			}

			$item->item = strtoupper(Input::get('item'));
			$item->save();

			return Redirect::route('item.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('item.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Item::find($id)->delete();

		if(is_null($item)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('item.index')
								->with('class', $class)
								->with('message', $message);
	}

}