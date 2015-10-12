<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'User List';

        $user = User::appusers();
        return View::make('user.index', compact('pagetitle', 'user'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create User';

        $departments = Department::orderBy('department')->lists('department', 'id');
        $roles = Role::orderBy('name')->lists('name', 'id');
        return View::make('user.create', compact('pagetitle', 'departments', 'roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
        $input = Input::all();

        $validation = Validator::make($input, User::$rules);

        if($validation->passes())
        {
            DB::transaction(function(){

                $user = new User;
                $user->first_name = strtoupper(Input::get('first_name'));
                $user->middle_initial = strtoupper(Input::get('middle_initial'));
                $user->last_name = strtoupper(Input::get('last_name'));
                $user->dept_id = Input::get('department');
                $user->confirmed = 1;
                $user->active = 1;
                $user->email = Input::get('email');
                $user->username = Input::get('username');
                $user->password = Input::get('password');
                $user->password_confirmation = Input::get('password_confirmation');
                $user->confirmation_code = md5(uniqid(mt_rand(), true));
                $user->image = "default.png";
                $user->save();

                $role = Role::find(Input::get('name'));
                $user->roles()->attach($role->id);

            });
                return Redirect::route('user.index')
                            ->with('class', 'success')
                            ->with('message', 'Record successfully added.');

        }else{
            return Redirect::route('user.create')
                            ->withInput(Input::except(array('password', 'password_confirmation')))
                            ->withErrors($validation)
                            ->with('class', 'error')
                            ->with('message', 'There were validation errors.');
        }
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
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
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = user::find($id);

        if (is_null($user))
        {
            $class = 'error';
            $message = 'Record does not exist.';
        }else{

            $user = User::find($id);
            $user->active = 1;
            $user->save();

            $class = 'success';
            $message = 'Record successfully activate.';
        }
        return Redirect::route('user.index')
                ->with('class', $class)
                ->with('message', $message);
	}

    /**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = user::find($id);

        if (is_null($user))
        {
            $class = 'error';
            $message = 'Record does not exist.';
        }else{

            $user = User::find($id);
            $user->active = 0;
            $user->save();

            $class = 'success';
            $message = 'Record successfully inactivate.';
        }
        return Redirect::route('user.index')
                ->with('class', $class)
                ->with('message', $message);
	}

}