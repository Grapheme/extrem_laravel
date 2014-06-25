<?php

class ExtremController extends BaseController {

    public static $name = 'extrem';
    public static $group = 'extrem';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        
        $class = __CLASS__;
        
        Route::group(array(), function() use ($class){
            Route::post('/submitphoto', array('as' => 'submitphoto', 'uses' => $class.'@submitPhoto'));
        });
    }
    
    ## Shortcodes of module
    public static function returnShortCodes() {
        #
    }

    ## Actions of module (for distribution rights of users)
    ## return false;   # for loading default actions from config
    ## return array(); # no rules will be loaded
    /*
    public static function returnActions() {
        return array();
    }
    */

    ## Info about module (now only for admin dashboard & menu)
    /*
    public static function returnInfo() {
    }
    */
    
    /****************************************************************************/

	public function __construct(I18nNews $news, I18nNewsMeta $news_meta){

        View::share('module_name', self::$name);

        $this->tpl = $this->gtpl = static::returnTpl();
        View::share('module_tpl', $this->tpl);
        View::share('module_gtpl', $this->gtpl);
	}
    
    ## Сохраняем картинку
    public function submitPhoto(){

        #Helper::dd($_POST);

        $input = array(
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'profile' => Input::get('profile'),
            'city' => Input::get('city'),
            'sex' => Input::get('sex'),
            'photo_big' => Input::get('photo_big'),
            'bdate' => Input::get('bdate'),
        );
        
        ################################################
        ## Process image
        ################################################
        if (Allow::action('admin_galleries', 'edit')) {
            $image = ExtForm::process('image', array(
                'image' => Input::get('image'),
            ));
        }
        ################################################
        
        $input['image'] = $image->name;
        $input['photo_id'] = $image->id;
        $photo = UserPhoto::create($input);

        Redirect('thankyou');

        #Helper::dd($input);
        #Helper::dd(DB::getQueryLog());
        
	}

}