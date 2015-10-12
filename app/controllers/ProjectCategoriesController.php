<?php

class ProjectCategoriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /projectcategories
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Project Categories';

		$categories = DB::table('categories')->orderBy('id', 'desc')->paginate(10);
		return View::make('project.category.index', compact('pagetitle', 'categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projectcategories/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Project Category';

		return View::make('project.category.create', compact('pagetitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /projectcategories
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Category::$rules);

		if($validation->passes())
		{
			$category = new Category();
			$category->category = strtoupper(Input::get('project_category'));
			$category->description = strtoupper(Input::get('description'));
			$category->save();

			return Redirect::route('project.category.index')
									->with('class', 'success')
									->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('project.category.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Display the specified resource.
	 * GET /projectcategories/{id}
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
	 * GET /projectcategories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Project Category';

		$categories = Category::find($id);
		return View::make('project.category.edit', compact('pagetitle', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /projectcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input_all = Input::all();

		$validation = Validator::make($input_all, Category::$update_rules);

		if($validation->passes())
		{
			
			$category = Category::find($id);

			if(is_null($category)){
				return Redirect::route('project.category.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Project Category information does not exist.');
			}

			$category->category = strtoupper(Input::get('project_category'));
			$category->description = strtoupper(Input::get('description'));
			$category->save();

			return Redirect::route('project.category.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{
			return Redirect::route('project.category.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /projectcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id)->delete();

		if(is_null($category)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('project.category.index')
								->with('class', $class)
								->with('message', $message);
	}

}