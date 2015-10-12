<?php

class Category extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'project_category' => 'required',
		);

	public static $update_rules = array(
			'project_category' => 'required',
		);

}