<?php



/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class SessionController extends Controller
{

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return View::make(Config::get('confide::signup_form'));
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::action('UsersController@login')
                ->with('notice', Lang::get('confide::confide.alerts.account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::action('UsersController@create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        if (Confide::user()) {
            return Redirect::to('/');
        } else {
            // return View::make(Config::get('confide::login_form'));
        	return View::make('login.login');
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        
        Input::merge(array_map('trim', Input::all()));
        $input = Input::all();

        $validation = Validator::make($input, User::$login_rules);

        if($validation->passes())
        {

            $username = Input::get('username');
            $password = Input::get('password');

            if (Auth::attempt(array('username' => $username, 'password' => $password, 'active' => 1)))
            {
                
                $id = Auth::user()->id;
                $result = Role::storeUserRole($id);
                $results = User::storeUserInfo($id);
                $userinfo = User::storeUser_info_role($id);
                $hasaccess_intask_receiver = Task::access_intask_receiver($id);
                $hasaccess_intask_approver = Task::access_intask_approver($id);

                if($result)
                {
                    Session::put('role', $result->role_id);
                    Session::put('fullname', $results->fullname);
                    Session::put('myimage', $results->image);
                    Session::put('name', $userinfo->name);
                    Session::put('task_receiver_access', $hasaccess_intask_receiver);
                    Session::put('task_approver_access', $hasaccess_intask_approver);
                    return Redirect::intended('dashboard');
                
                }else{
                    return View::make('login.login')
                    ->with('class', 'warning')
                    ->with('message', 'Invalid username or password.');

                }
                
            }else{

                return View::make('login.login')
                    ->with('class', 'warning')
                    ->with('message', 'Invalid username or password.');
        
            }

        }else{
            
            return View::make('login.login')
                    ->with('class', 'error')
                    ->with('message', 'Fill up required fields.');

        } 
            

            
        // $repo = App::make('UserRepository');
        // $input = Input::all();

        // if ($repo->login($input)) {
        //     return Redirect::intended('/');
        // } else {
        //     if ($repo->isThrottled($input)) {
        //         $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
        //     } elseif ($repo->existsButNotConfirmed($input)) {
        //         $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
        //     } else {
        //         $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
        //     }

        //     return Redirect::action('SessionController@login')
        //         ->withInput(Input::except('password'))
        //         ->with('error', $err_msg);
        // }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UsersController@doForgotPassword')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::action('UsersController@login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
     */
    public function logout()
    {
        Confide::logout();

        return Redirect::to('/');
    }
}
