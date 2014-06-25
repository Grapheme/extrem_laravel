<?php

class GroupsController extends BaseController {

	protected $group;

	public function __construct(Group $group){
		
		$this->group = $group;
		$this->beforeFilter('users');
	}

	public function getIndex(){
		
		$groups = $this->group->all();
		$roles = Role::all();
		return View::make('system.groups.index', compact('groups', 'roles'));
	}

	public function getEdit($id){
		
		$group = $this->group->find($id);
		$roles = Role::all();
		foreach(Group::find($id)->roles()->get() as $key => $role):
			$group->roles[$role->name] = $role->id;
		endforeach;
        $mod_actions = Config::get('mod_actions');
        $mod_info = Config::get('mod_info');
		return View::make('system.groups.edit', compact('group', 'roles', 'mod_actions', 'mod_info'));
	}

	public function postAttach(){
		
		$group_id = Input::get('group_id');
		$role_id = Input::get('role_id');

		$group = Group::find($group_id);
		$group->roles()->attach($role_id);
	}

	public function postDetach(){
		
		$group_id = Input::get('group_id');
		$role_id = Input::get('role_id');
		
		$group = Group::find($group_id);
		$group->roles()->detach($role_id);
	}

	public function postCreate(){
		
		$input = Input::all();

		$v = Validator::make($input, Group::$rules);
		if($v->passes())
		{
			$this->group->create($input);
			return link::auth('groups');
		} else {
			return Response::json($v->messages()->toJson(), 400);
		}
	}
	
	public function postUpdate($group_id){
		
		//$this->moduleActionPermission('users','update');
		$json_request = array('status'=>FALSE, 'responseText'=>'', 'responseErrorText'=>'', 'redirect'=>FALSE);
		if(!Request::ajax())
            return App::abort(404);        

		if(!$group = Group::find($group_id)) {
			$json_request['responseText'] = 'Запрашиваемая группа не найдена!';
			return Response::json($json_request,400);
		}
        
		$rules = array('name' => 'required', 'desc' => 'required', 'dashboard' => 'required');
		$validation = Validator::make(Input::all(), $rules);
		if($validation->passes()):

			$group->name = Input::get('name');
			$group->desc = Input::get('desc');
            $group->dashboard = Input::get('dashboard');
			$group->save();
			$group->touch();
			
            #$group->roles()->sync(Input::get('roles'));
            #$group->actions()->sync(Input::get('actions'));
            Action::where('group_id', $group_id)->delete();
            if (is_array(Input::get('actions')) && count(Input::get('actions'))) {
                foreach (Input::get('actions') as $module_name => $actions) {
                    foreach ($actions as $a => $act) {
                        $action = new Action;
                        $action->group_id = $group_id;
                        $action->module = $module_name;
                        $action->action = $act;
                        $action->status = 1;
                        $action->save();
                    }
                }
            }
            
			$json_request['responseText'] = 'Группа обновлена';
			#$json_request['responseText'] = print_r($group_id, 1);
			#$json_request['responseText'] = print_r($group, 1);
			$json_request['responseText'] = print_r(Input::get('actions'), 1);
			#$json_request['responseText'] = print_r($group->actions(), 1);
			#$json_request['redirect'] = link::auth('groups');
			$json_request['status'] = TRUE;
		else:
			$json_request['responseText'] = 'Неверно заполнены поля';
			$json_request['responseErrorText'] = implode($validation->messages()->all(),'<br />');
		endif;
        
		return Response::json($json_request,200);
		
	}

}
