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
        return array();
    }

    ## Info about module (now only for admin dashboard & menu)
    public static function returnInfo() {
        return array(
        	'name' => self::$name,
        	'group' => self::$group,
        	'title' => 'Extrem', #trans('modules.pages.menu_title'), 
        	'link' => '#',
            'class' => 'fa-star-o', 
            'show_in_menu' => 1,
            'menu_child' => array(
                array(
                	'title' => 'Советы от бренда',
                    'link' => self::$group . "/brand_advices",
                    'class' => 'fa-comment', 
                ),
                array(
                	'title' => 'Советы от блоггеров',
                    'link' => self::$group . "/blogger_advices",
                    'class' => 'fa-comments', 
                ),
                array(
                	'title' => 'Фотографии юзеров',
                    'link' => self::$group . "/user_photos",
                    'class' => 'fa-camera', 
                ),
            ),
        );
    }
        
    /****************************************************************************/
    
	public function __construct(){
        ##
	}
}


