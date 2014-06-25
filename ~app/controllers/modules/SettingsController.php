<?php

class SettingsController extends BaseController {

    /*
	public function __construct(Page $page){
		
		$this->model = $page;
		$this->beforeFilter('settings');
	}
    */

	public function __construct(){
		
		$this->beforeFilter('settings');
	}
	
	public function getIndex(){
		
		$settings = Settings::retArray();
		$languages = Language::retArray();
		return View::make('modules.settings.index', compact('settings','languages'));
	}

	public function postAdminlanguagechange(){
		
		$id = Input::get('id');
		$model = settings::where('name', 'admin_language')->first();
		$model->value = language::find($id)->code;
		$model->save();
	}

	public function postModule(){
		
		$json_request = array('status'=>TRUE, 'responseText'=>'Сохранено');

		if($module = Module::where('name', Input::get('name'))->first()) {
			$module->update(array('on'=>Input::get('value')));
			$module->touch();
		} else {
			Module::create(array('name'=>Input::get('name'), 'on'=>Input::get('value')));
		}

		if(Input::get('value') == 1) {
			$json_request['responseText'] = "Модуль &laquo;".SystemModules::getModules(Input::get('name'), 'title')."&raquo; включен";
		} else {
			$json_request['responseText'] = "Модуль &laquo;".SystemModules::getModules(Input::get('name'), 'title')."&raquo; выключен";
		}

        #$json_request['responseText'] = print_r(SystemModules::getModules(Input::get('name')), 1);

		return Response::json($json_request, 200);
	}
}
