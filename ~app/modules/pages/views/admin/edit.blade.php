@extends('templates.'.AuthAccount::getStartPage())


@section('style')
<link rel="stylesheet" href="{{ link::path('css/redactor.css') }}" />
@stop


@section('content')
{{--
    @include($module_tpl.'forms.edit')
--}}

{{ Form::model($page, array('url'=>link::auth('pages/update/'.$page->id),'class'=>'smart-form','id'=>'page-form','role'=>'form','method'=>'post')) }}

    <div class="well">
        <header>Для изменения страницы воспользуйтесь формой:</header>
        <fieldset>

            <section>
                @if(!$page->start_page)
                <label class="label">
                    Идентификатор страницы
                    <div class="note">Может содержать <strong>только</strong> английские буквы в нижнем регистре, цифры, знаки подчеркивания и тире</div>
                </label>
                <label class="input col-5"> <i class="icon-append fa fa-list-alt"></i>
                    {{ Form::text('slug', $page->slug) }}
                @else
                <div class="alert alert-info padding-5">
                    <i class="fa-fw fa fa-info"></i>
                    Это главная страница.
                </div>
                @endif
                </label>
            </section>

            @if(Allow::action('pages', 'change_template'))
            <section>
                <label class="label">Шаблон страницы:</label>
                <label class="select col-5">
                    @foreach($templates as $template)
                        <?php #$temps[$template->name] = $template->name;?>
                        <?php $temps[$template] = $template;?>
                    @endforeach
                    {{ Form::select('template', $temps, ($page->template ? $page->template : 'default'), array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                </label>
            </section>
            @endif

        </fieldset>
    </div>

    @if (count($locales) > 1)
    <!-- Tabs -->
    <ul class="nav nav-tabs margin-top-10">
    @foreach ($locales as $l => $locale)
        <li class="{{ $l === 0 ? 'active' : '' }}">
            <a href="#lang_{{ $locale }}" data-toggle="tab">{{ $locale }}</a>
        </li>
    @endforeach
    </ul>
    @endif

    <!-- Fields -->
    <div class="row margin-top-10">
        <div class="tab-content">
        @foreach ($locales as $l => $locale)
            <div class="tab-pane{{ $l === 0 ? ' active' : '' }}" id="lang_{{ $locale }}">

                <section class="col col-6">
                    <div class="well">
                        <header>{{ $locale }}-версия:</header>
                        <fieldset>
                            <section>
                                <label class="label">Название</label>
                                <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                                    {{ Form::text('name['.$locale.']', @$page_meta[$locale]->name) }}
                                </label>
                            </section>
                            <section>
                                <label class="label">Содержание</label>
                                <label class="textarea">
                                    {{ Form::textarea('content['.$locale.']', @$page_meta[$locale]->content, array('class'=>'redactor-no-filter redactor_450')) }}
                                </label>
                            </section>
                        </fieldset>
                    </div>
                </section>

                @if(Allow::enabled_module('seo'))
                <section class="col col-6">
                    <div class="well">
                        @include('modules.seo.i18n_pages')
                    </div>
                </section>
                @endif

            </div>
        @endforeach
        </div>
    </div>

    <div class="row margin-top-10">
        <section class="col col-6">
            <div class="well">
                <footer style="border-top:0; padding-top:15px;">
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

@stop


@section('scripts')
	{{ HTML::script('js/modules/pages.js') }}
	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}",runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js'); }}");
		}
	</script>
	<script src="{{ link::path('js/vendor/redactor.min.js') }}"></script>
	<script src="{{ link::path('js/system/redactor-config.js') }}"></script>
@stop