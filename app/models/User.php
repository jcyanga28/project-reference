<?php 
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface
{
    use ConfideUser;
    use HasRole;

    public static $login_rules = array(
    		'username' => 'required',
    		'password' => 'required',
    );

    public static $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|alpha_dash|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6|same:password',
    );

    public static function appUsers(){
		return  DB::table('users')->select(DB::raw('concat(ucase(users.first_name)," ", ucase(users.middle_initial) ,".", " ", ucase(users.last_name)) as fullname, users.id, users.image, users.active, roles.name as role, departments.department'))
			->join('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
			->join('roles', 'assigned_roles.role_id', '=', 'roles.id')
			->join('departments', 'departments.id', '=', 'users.dept_id')
            ->where('users.super_admin', '<>', 1)
			->orderBy('role', 'asc')
			->paginate(10);
	}

    public static function storeUserInfo($id)
    {
        return DB::table('users')
                    ->select(DB::raw('concat(first_name , " " , last_name) as fullname, image'))
                    ->where('id', $id)
                    ->first();
    }

    public static function storeUser_info_role($id)
    {
        return DB::table('assigned_roles')
                    ->select(DB::raw('concat(roles.name,","," ",users.first_name , " " , users.last_name) as name'))
                    ->join('roles', 'roles.id', '=', 'assigned_roles.role_id')
                    ->join('users', 'users.id', '=', 'assigned_roles.user_id')
                    ->where('assigned_roles.user_id', $id)
                    ->first();
    }
    
}

