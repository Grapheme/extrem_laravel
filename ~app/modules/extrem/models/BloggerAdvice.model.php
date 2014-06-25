<?php

class ExtremBloggerAdvice extends BaseModel {

	protected $guarded = array();

	protected $table = 'extrem_blogger_advices';

	public static $order_by = "extrem_blogger_advices.id DESC";

	public static $rules = array(
		'name' => 'required',
		#'desc' => 'required',
		'author' => 'required',
	);


	public function tags($modname = false){
        if (!$modname)
            return false;

        return Tag::where('module', $modname)->where('unit_id', $this->id)->get();
	}
}