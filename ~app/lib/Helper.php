<?php

class Helper {

	/*
	| Функция возвращает 2х-мерный массив который формируется из строки.
	| Строка сперва разбивается по запятой, потом по пробелам.
	| Используется пока для разбора строки сортировки model::orderBy() в библиотеке ShortCode
	*/
    ## from BaseController
	public static function stringToArray($string){

		$ordering = array();
		if(!empty($string)):
			if($order_by = explode(',',$string)):
				foreach($order_by as $index => $order):
					if($single_orders = explode(' ',$order)):
						foreach($single_orders as $single_order):
							$ordering[$index][] = strtolower($single_order);
						endforeach;
					endif;
				endforeach;
			endif;
		endif;
		return $ordering;
	}
    
    public static function d($array) {
        echo "<pre>" . print_r($array, 1) . "</pre>";
    }

    public static function dd($array) {
        self::d($array);
        die;
    }

    public static function from_timestamp($timestamp, $format = "H:i:s d.m.Y") {
        ## Carbon\Carbon Object
        #if (is_object($timestamp))
        #    $timestamp = $timestamp->date;
        #Helper::dd($timestamp);
        return date($format, $timestamp);
    }

}