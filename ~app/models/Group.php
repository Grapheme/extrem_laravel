<?php

class Group extends Eloquent {
	
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'desc' => 'required',
		'dashboard' => 'required'
	);

    /**
     * @todo нужно выпилить как пережиток прошлого
     */
	public function roles(){
		return $this->belongsToMany('Role');
	}

	public function actions(){
		return $this->belongsToMany('Action');
	}
	
}