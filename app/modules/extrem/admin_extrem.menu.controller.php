<?php

class AdminExtremMenuController extends BaseController {

    public static $name = 'extremMenu';
    public static $group = 'extrem';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        ##
    }

    ## Shortcodes of module
    public static function returnShortCodes() {
        ##
    }
    
    ## Actions of module (for distribution rights of users)
    public static function returnActions() {
        return array(
        	'view'   => 'Отображать в меню',
        );
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        return array(
        	'name' => self::$name,
        	'group' => self::$group,
            'title' => 'Extrem',
            'visible' => '1',
        );
    }


    public static function returnMenu() {
        ## Without child links
        return array(
            array(
            	'title' => 'Советы от бренда',
                'link' => self::$group . "/brand_advices",
                'class' => 'fa-comment', 
                'permit' => 'view',
            ),
            array(
            	'title' => 'Советы от блогеров',
                'link' => self::$group . "/blogger_advices",
                'class' => 'fa-comments', 
                'permit' => 'view',
            ),
            array(
            	'title' => 'Модерация фото',
                'link' => self::$group . "/user_photos",
                'class' => 'fa-camera', 
                'permit' => 'view',
            ),
        );
        #*/
    }
        
    /****************************************************************************/
    
	public function __construct(){
        ##
	}
}


