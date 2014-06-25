@extends(Helper::acclayout())


@section('content')
    <h1>Модерация фотографий</h1>
    @include($module['tpl'].'/menu')

	@if(@$photos->count())
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
                        {{--
						<th class="text-center" style="width:40px">id</th>
                        --}}
						<th class="text-center">Фото</th>
						{{--<th class="text-center">Автор</th>--}}
						<th colspan="2" class="width-250 text-center">Действия</th>
					</tr>
				</thead>
				<tbody>
				@foreach($photos as $photo)
					<tr>
                        {{--
						<td class="text-center">
						    {{ $photo->id }}
						</td>
                        --}}
						<td class="text-center">
						    <img src="{{ Config::get('site.tmp_public_dir') }}/{{ $photo->image }}" style="max-width:300px" /></a>
						</td>
                        <!--
						<td class="text-center">
                            <a href="{{ $photo->profile }}" target="_blank">
                            @if ($photo->photo_big)
                            	<div class="photo-preview" style="background-image:url({{ $photo->photo_big }});"></div><br/>
                            @endif
						    {{ $photo->first_name }} {{ $photo->last_name }}</a><br/>
                            @if ($photo->sex)
                                @if ($photo->sex == 1)
                            	<i class="fa fa-female"></i>
                                @elseif ($photo->sex == 2)
                            	<i class="fa fa-male"></i>
                                @endif
                            @endif
                            @if ($photo->bdate)
                                {{ $photo->bdate }}
                            @endif
                            @if ($photo->city)
                                ({{ $photo->city }})
                            @endif
                            <div class="margin-top-10">
                                Добавлено: <abbr title="{{ $photo->created_at->format("H:i:s") }}">{{ $photo->created_at->format("d.m.Y") }}</abbr>
                            </div>

						</td>
                        -->
						<td class="text-center">
                        
                            {{ Form::open(array('url'=>link::auth($module['rest'].'/approvephoto'),'role'=>'form','class'=>'smart-form','id'=>'photo-form','method'=>'post')) }}
                            <label class="toggle width-100 margin-center">

                                {{ Form::checkbox('approved', $photo->approved, (bool)$photo->approved, array('class' => 'userphoto-checkbox', 'data-photo_id' => $photo->id)) }}
                                <i data-swchon-text="да" data-swchoff-text="нет"></i>
                                Одобрено:
                            </label>
                            {{ Form::close() }}

                            <div class="margin-top-10">
                                Добавлено: <abbr title="{{ $photo->created_at->format("H:i:s") }}">{{ $photo->created_at->format("d.m.Y") }}</abbr>
                            </div>

							<form method="POST" action="{{ link::auth($module['rest'].'/destroy/'.$photo->id) }}">
								<button type="button" class="btn btn-default margin-top-10 remove-photo">
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
    var essence = 'photo';
    var essence_name = 'фото';
	var validation_rules = {
		name: { required: true }
	};
	var validation_messages = {
		name: { required: 'Укажите название' }
	};
    </script>

	<script src="{{ url('js/modules/standard.js') }}"></script>

	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}", runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}");
		}
	</script>

	<script src="{{ url('js/modules/extrem.js') }}"></script>

@stop

