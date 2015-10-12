<?php

class Item extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'item' => 'required|unique:items,item',
		);
}