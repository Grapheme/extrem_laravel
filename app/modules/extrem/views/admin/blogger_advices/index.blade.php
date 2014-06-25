@extends(Helper::acclayout())


@section('content')
    <h1>Советы от блогеров</h1>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="margin-bottom-25 margin-top-10 ">
				<a class="btn btn-primary" href="{{ link::auth($module['rest'].'/create') }}">Добавить совет</a>
			</div>
		</div>
	</div>

	@if(@$advices->count())
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-striped table-bordered min-table">
				<thead>
					<tr>
                        {{--
						<th class="text-center" style="width:40px">id</th>
                        --}}
						<th style="width:100%;"class="text-center">Название</th>
						<th colspan="2" class="width-250 text-center">Действия</th>
					</tr>
				</thead>
				<tbody>
				@foreach($advices as $advice)
					<tr>
                        {{--
						<td class="text-center">
						    {{ $advice->id }}
						</td>
                        --}}
						<td>
                            @if ($advice->name != '')
						    {{ $advice->name }}
                            @else
                            <b>{{ $advice->author }}</b>:
                            <i>{{ Helper::preview($advice->desc, 8) }}</i>
                            @endif
						</td>
						<td class="text-center">
							<a class="btn btn-default" href="{{ link::auth($module['rest'].'/edit/'.$advice->id) }}">
								Изменить
							</a>
						<td class="text-center">
							<form method="POST" action="{{ link::auth($module['rest'].'/destroy/'.$advice->id) }}">
								<button type="button" class="btn btn-default remove-advice">
									Удалить
								</button>
							</form>
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
    var essence = 'advice';
    var essence_name = 'совет';
	var validation_rules = {
		name: { required: true }
	};
	var validation_messages = {
		name: { required: 'Укажите название' }
	};
    </script>

	<script src="{{ url('js/modules/48hours.js') }}"></script>
	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}", runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}");
		}
	</script>
@stop

