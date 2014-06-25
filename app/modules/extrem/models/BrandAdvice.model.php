<?php

class ExtremBrandAdvice extends BaseModel {

	protected $guarded = array();

	protected $table = 'extrem_brand_advices';

	public static $order_by = "extrem_brand_advices.id DESC";

	public static $rules = array(
		#'name' => 'required',
		'desc' => 'required',
	);


	public function tags($modname = false){
        if (!$modname)
            return false;

        return Tag::where('module', $modname)->where('unit_id', $this->id)->get();
	}

	public function photo() {

        return Photo::where('id', $this->photo)->first();
	}
}