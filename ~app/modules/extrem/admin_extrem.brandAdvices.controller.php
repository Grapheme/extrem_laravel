<?php

class AdminExtremBrandAdvicesController extends BaseController {

    public static $name = 'extremBrandAdvices';
    public static $group = 'extrem';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        #echo $prefix;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::controller($class::$group."/brand_advices", $class);
        });
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
        ##
    }
        
    /****************************************************************************/
    
	public function __construct(){

		$this->beforeFilter('48hours');

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'rest' => self::$group."/brand_advices",
            'tpl' => static::returnTpl('admin/brand_advices'),
            'gtpl' => static::returnTpl(),
        );

        View::share('module', $this->module);
	}

	public function getIndex(){
		
		$advices = ExtremBrandAdvice::orderBy('id', 'desc')->get();
		return View::make($this->module['tpl'].'index', compact('advices'));
	}

    /************************************************************************************/

	public function getCreate(){

		return View::make($this->module['tpl'].'create');
	}

	public function postStore(){

		if(!Request::ajax())
            return App::abort(404);
            
		#$input = Input::all();
        $input = array(
            'name' => Input::get('name'),
            'desc' => Input::get('desc'),
        );

		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, ExtremBrandAdvice::$rules);
		if($validator->passes()) {

		    #$json_request['responseText'] = "<pre>" . print_r($_POST, 1) . "</pre>";
		    #return Response::json($json_request,200);

			#self::saveNewsModel();
            $id = ExtremBrandAdvice::create($input)->id;

            ################################################
            ## Process tags
            ################################################
            if (Allow::action('admin_tags', 'edit')) {
                ExtForm::process('tags', array(
                    'module'  => self::$name,
                    'unit_id' => $id,
                    'tags'    => Input::get('tags'),
                ));
            }
            ################################################

            ################################################
            ## Process gallery
            ################################################
            if (Allow::action('admin_galleries', 'edit')) {
                ExtForm::process('gallery', array(
                    'module'          => self::$name,
                    'unit_id'         => $id,
                    'gallery_id'      => Input::get('gallery_id'),
                    'uploaded_images' => Input::get('uploaded_images'),
                ));
            }
            ################################################
            
			$json_request['responseText'] = 'Совет создан';
			$json_request['redirect'] = link::auth( $this->module['rest'] );
			$json_request['status'] = TRUE;
		} else {
			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = $validator->messages()->all();
		}
		return Response::json($json_request,200);
	}

    /************************************************************************************/
    
	public function getEdit($id){
		
		$advice = ExtremBrandAdvice::findOrFail($id);
        $gallery = Rel_mod_gallery::where('module', $this->module['name'])->where('unit_id', $id)->first();
		return View::make($this->module['tpl'].'edit', compact('advice', 'gallery'));
	}

	public function postUpdate($id){

		if(!Request::ajax())
            return App::abort(404);

		#$input = Input::all();
        $input = array(
            'name' => Input::get('name'),
            'desc' => Input::get('desc'),
        );

		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		$validator = Validator::make($input, ExtremBrandAdvice::$rules);
		if($validator->passes()) {

            if (ExtremBrandAdvice::find($id)->exists()) {

                ExtremBrandAdvice::find($id)->update($input);

                ################################################
                ## Process tags
                ################################################
                if (Allow::action('admin_tags', 'edit')) {
                    ExtForm::process('tags', array(
                        'module'  => self::$name,
                        'unit_id' => $id,
                        'tags'    => Input::get('tags'),
                    ));
                }
                ################################################

                ################################################
                ## Process gallery
                ################################################
                if (Allow::action('admin_galleries', 'edit')) {
                    ExtForm::process('gallery', array(
                        'module'          => self::$name,
                        'unit_id'         => $id,
                        'gallery_id'      => Input::get('gallery_id'),
                        'uploaded_images' => Input::get('uploaded_images'),
                    ));
                }
                ################################################
            }

			$json_request['responseText'] = 'Совет обновлен';
			#$json_request['redirect'] = link::auth( $this->module['rest'] );
			$json_request['status'] = TRUE;
		} else {
			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = $validator->messages()->all();
		}
		return Response::json($json_request, 200);
	}

    /************************************************************************************/

	public function deleteDestroy($id){

		if(!Request::ajax())
            return App::abort(404);

		$json_request = array('status'=>FALSE, 'responseText'=>'');
	    $deleted = ExtremBrandAdvice::find($id)->delete();
		$json_request['responseText'] = 'Совет удален';
		$json_request['status'] = TRUE;
		return Response::json($json_request,200);
	}

}


