<?php

class AdminExtremUserPhotosController extends BaseController {

    public static $name = 'extremUserPhotos';
    public static $group = 'extrem';

    /****************************************************************************/

    ## Routing rules of module
    public static function returnRoutes($prefix = null) {
        $class = __CLASS__;
        #echo $prefix;
        Route::group(array('before' => 'auth', 'prefix' => $prefix), function() use ($class) {
        	Route::controller($class::$group."/user_photos", $class);
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
            'rest' => self::$group."/user_photos",
            'tpl' => static::returnTpl('admin/user_photos'),
            'gtpl' => static::returnTpl(),
        );

        View::share('module', $this->module);
	}

	public function getIndex(){
		
        $status = Input::get('view');
        if ($status == 'approved')
            $view = 1;
        elseif (!$status || $status == 'unapproved')
            $view = 0;
        else
            $view = 0;
		$photos = UserPhoto::where('approved', $view)->orderBy('id', 'desc')->get();
		return View::make($this->module['tpl'].'index', compact('photos', 'view'));
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
            if (Allow::action('tags', 'edit')) {
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
            if (Allow::action('galleries', 'edit')) {
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
                if (Allow::action('tags', 'edit')) {
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
                if (Allow::action('galleries', 'edit')) {
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
        $user_photo = UserPhoto::find($id);
	    $user_photo->delete();

        #$photo_id = $user_photo->photo_id;
        #$photo = Photo::find($photo_id);
        #$photo->delete();
		#@unlink(public_path().Config::get('app-default.galleries_photo_dir')."/".$photo->name);
		#@unlink(public_path().Config::get('app-default.galleries_thumb_dir')."/".$photo->name);

        @unlink(Config::get('site.tmp_dir')."/".$user_photo->image);

		$json_request['responseText'] = 'Фото удалено';
		$json_request['status'] = TRUE;
		return Response::json($json_request,200);
	}

	public function postApprovephoto(){
		$json_request = array('status'=>TRUE, 'responseText'=>'Фото одобрено');
        $photo_id = Input::get('photo_id');
		if($photo = UserPhoto::where('id', $photo_id)->first()) {
			$photo->update(array('approved' => Input::get('value')));
			$photo->touch();
		}
		if(Input::get('value') == 1):
			$json_request['responseText'] = "Фото #{$photo_id} одобрено";
		else:
			$json_request['responseText'] = "Фото #{$photo_id} снято с публикации";
		endif;
		return Response::json($json_request,200);
    }

}


