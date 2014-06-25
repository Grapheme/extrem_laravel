{{ Form::model($group, array('url'=>link::auth('groups/update/'.$group->id),'class'=>'smart-form','id'=>'group-form','role'=>'form','method'=>'post')) }}
	<div class="row margin-top-10">
		<section class="col col-6">
			<div class="well">
				<header>Для изменения группы пользователей заполните форму:</header>
				<fieldset>
					<section>
						<label class="label">Название</label>
						<label class="input">
							{{ Form::text('name',NULL) }}
						</label>
						<div class="note">Заполняется латинскими символами. Не должно содержать пробелов</div>
					</section>
					<section>
						<label class="label">Описание</label>
						<label class="input">
							{{ Form::text('desc',NULL) }}
						</label>
					</section>
					<section>
						<label class="label">Стартовая страница</label>
						<label class="input">
							{{ Form::text('dashboard',NULL) }}
						</label>
						<div class="note">Заполняется латинскими символами. Не должно содержать пробелов</div>
					</section>
				</fieldset>
                
                {{--
				<fieldset>
				@if($roles->count())
					<section>
						<label class="label">Доступные роли</label>
						<div class="row">
    					@foreach($roles as $role)
    						<div class="col col-4">
    							<label class="checkbox">
    								<input type="checkbox" value="{{ $role->id }}" name="roles[]" {{ isset($group->roles[$role->name]) ? 'checked="checked"' : '' }}><i></i>{{ $role->desc; }}
    							</label>
    						</div>
    					@endforeach
                        </div>
					</section>
				@endif
				</fieldset>
                --}}

				<fieldset>
				@if(@count($mod_actions))
					<section>
						<label class="label">Доступ группы к модулям:</label>
						<div class="">
    					@foreach($mod_actions as $module_name => $actions)
                        <? #Helper::dd($actions); ?>
                            <? if (!count($actions)) continue; ?>
                            <? $title = isset($mod_info[$module_name]['title']) ? $mod_info[$module_name]['title'] : $module_name; ?>
    						<div class="row margin-bottom-10">
                                <div class="col col-8 margin-bottom-10">
                                    <h3>{{ $title }}</h3>
                                </div>

                                <div class="col col-4">
{{--
                                    <!-- Задумка на будущее: возможность отключать модуль для конкретной группы -->
                                    <input type="checkbox"{{ $checked }} class="module-checkbox" data-action="{{ $action }}">
    								<i data-swchon-text="вкл" data-swchoff-text="выкл"></i> 
--}}
                                </div>
                                
            					@foreach($actions as $a => $action)
        							<?php $checked = ''; ?>
        							<? if(
                                            Action::where('module', $module_name)->where('action', $a)->exists()
                                            && Action::where('module', $module_name)->where('action', $a)->first()->status == 1
                                        ): ?>
        								<?php $checked = ' checked="checked"'; ?>
        							<? endif; ?> 

                                    <div class="col col-8">{{ @$action }}</div>
                                    <div class="col col-4">
            							<input type="checkbox"{{ $checked }} value="{{ $a }}" name="actions[{{ $module_name }}][]" class="module-checkbox">
        								<i data-swchon-text="вкл" data-swchoff-text="выкл"></i> 
                                    </div>
            					@endforeach

    						</div>
    					@endforeach
                        </div>
					</section>
				@endif
				</fieldset>

				<footer>
					<a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner" href="{{URL::previous()}}">
						<i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
					</a>
					<button type="submit" autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
						<i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Сохранить</span>
					</button>
				</footer>

			</div>
		</section>
	</div>
{{ Form::close() }}