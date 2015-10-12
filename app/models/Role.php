<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name'];
	public static $rules = array(
        'name' => 'required|between:4,128|unique:roles,name',
    );	

    public static function storeUserRole($id)
    {
        return DB::table('assigned_roles')
                    ->select('role_id')
                    ->where('user_id', $id)
                    ->first();

    }

}