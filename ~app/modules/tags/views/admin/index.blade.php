@extends('templates.'.AuthAccount::getStartPage())


@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="margin-bottom-25 margin-top-10 ">
			@if(Allow::action('tags','create'))
				<a class="btn btn-primary" href="{{ link::auth($module['rest'].'/create') }}">Добавить тег</a>
			@endif
			</div>
		</div>
	</div>
	@if($tags->count())
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-striped table-bordered min-table">
				<thead>
					<tr>
						<th class="text-center" style="width:150px;">Модуль</th>
						<th class="text-center" style="width:70px;">ID</th>
						<th class="text-center" style="width:50%;">Тег</th>
						<th class="text-center" style="width:150px;" colspan="2">Действия</th>
					</tr>
				</thead>
				<tbody>
				@foreach($tags as $tag)
					<tr>
						<td>{{ $tag->module }}</td>
						<td class="text-center">{{ $tag->unit_id }}</td>
						<td class="text-center">{{ $tag->tag }}</td>
                        <td>
						@if(Allow::action('tags', 'edit'))
							<a class="btn btn-default" href="{{ link::auth($module['rest'].'/edit/'.$tag->id) }}">
								Изменить
							</a>
						@endif
                        </td>
                        <td>
						@if(Allow::action('tags', 'delete'))
							<form method="POST" action="{{ link::auth($module['rest'].'/destroy/'.$tag->id) }}">
								<button type="button" class="btn btn-default remove-tag">
									Удалить
								</button>
							</form>
						@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@else
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="ajax-notifications custom">
				<div class="alert alert-transparent">
					<h4>Список пуст</h4>
					<p><br><i class="regular-color-light fa fa-th-list fa-3x"></i></p>
				</div>
			</div>
		</div>
	</div>
	@endif
@stop


@section('scripts')
    <script>
    var essence = 'tag';
    var essence_name = 'тег';
	var validation_rules = {
		module: { required: true }
	};
	var validation_messages = {
		module: { required: 'Выберите модуль' }
	};
    </script>
	<script src="{{ link::to('js/modules/standard.js') }}"></script>

	<script type="text/javascript">
		if(typeof tagsetUp === 'function'){tagsetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{asset('js/vendor/jquery-form.min.js');}}",runFormValidation);
		}else{
			loadScript("{{asset('js/vendor/jquery-form.min.js');}}");
		}
	</script>
@stop
