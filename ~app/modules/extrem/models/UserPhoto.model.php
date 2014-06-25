<?php

class UserPhoto extends BaseModel {

	protected $guarded = array();

	protected $table = 'extrem_user_photos';

	public static $order_by = "extrem_user_photos.id DESC";

	public static $rules = array(
		'name' => 'required',
		#'desc' => 'required',
	);

}