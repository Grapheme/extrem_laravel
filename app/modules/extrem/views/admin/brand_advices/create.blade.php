@extends(Helper::acclayout())


@section('style')
<link rel="stylesheet" href="{{ link::path('css/redactor.css') }}" />
@stop


@section('content')
{{ Form::open(array('url'=>link::auth($module['rest'].'/store'), 'role'=>'form', 'class'=>'smart-form', 'id'=>'advice-form', 'method'=>'post')) }}


	<div class="row margin-top-10">

        <!-- Form -->
        <section class="col col-6">
            <div class="well">
                <header>Новый совет:</header>
                <fieldset>
                    <section>
                        <label class="label">Название</label>
                        <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                            {{ Form::text('name', '') }}
                        </label>
                    </section>

                    <section>
                        <label class="label">Описание</label>
                        <label class="textarea">
                            {{ Form::textarea('desc', '', array('class'=>'redactor_ redactor_150')) }}
                        </label>
                    </section>

                    @if (Allow::module('tags'))
                    <section>
                        <label class="label">Теги</label>
                        <label class="input">
                            {{ ExtForm::tags('tags', '') }}
                        </label>
                    </section>
                    @endif

                    @if (Allow::module('galleries'))
                    <section>
                        <label class="label">Галерея</label>
                        <label class="input">
                            {{ ExtForm::gallery('gallery', '') }}
                        </label>
                    </section>
                    @endif

                </fieldset>
    		</div>
    	</section>
    	<!-- /Form -->
   	</div>

	<div style="float:none; clear:both;"></div>

    <section class="col-6">
        <footer>
        	<a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner" href="{{ URL::previous() }}">
        		<i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
        	</a>
        	<button type="submit" autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
        		<i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Создать</span>
        	</button>
        </footer>
    </section>

{{ Form::close() }}
@stop


@section('scripts')
    <script>
    var essence = 'advice';
    var essence_name = 'совет';
	var validation_rules = {
		//name: { required: true },
		desc: { required: true }
	};
	var validation_messages = {
		//name: { required: 'Укажите название' },
        desc: { required: 'Укажите текст совета' }
	};
    </script>

    {{ HTML::script('js/modules/standard.js') }}

    {{ HTML::script('js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js') }}
    {{ HTML::script('js/modules/gallery.js') }}
    {{ HTML::script('js/vendor/jquery.ui.datepicker-ru.js') }}

	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}",runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}");
		}
	</script>

    {{ HTML::script('js/vendor/redactor.min.js') }}
    {{ HTML::script('js/system/redactor-config.js') }}

@stop
