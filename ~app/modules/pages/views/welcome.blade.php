@extends('templates.default')


@section('style')
    {{ HTML::style('css/dropzone-only.css') }}
@stop


@section('content')

    <hr/>
    <center>

    {{ $content }}

    <script src="//ulogin.ru/js/ulogin.js"></script><div id="uLogin1" data-uloginid="9d764e95"></div>

    <div class="welcome_msg"></div>
    <div class="upload_block" style="display:none;">
        Здесь будет поле для загрузки изображения

        {{ Form::open(array('url'=>link::to('submitphoto'),'role'=>'form','class'=>'photo-form','id'=>'photo-form','method'=>'post')) }}

        {{ Form::hidden('first_name', '') }}
        {{ Form::hidden('last_name', '') }}
        {{ Form::hidden('profile', '') }}
        {{ Form::hidden('city', '') }}
        {{ Form::hidden('sex', '') }}
        {{ Form::hidden('photo_big', '') }}
        {{ Form::hidden('bdate', '') }}

        @if (Allow::module('admin_galleries'))
        <section style="width:800px;">
            <label class="input">
                {{ ExtForm::image('image', '', array('tpl' => 'extform_image_extrem')) }}
            </label>
        </section>
        @endif

        {{ Form::close() }}
                    
    </div>
    <!--
	{{ Form::open(array('url'=>'recomendations', 'role'=>'form', 'class'=>'get-recomendations-form', 'id'=>'get-recomendations-form')) }}
    <section class="col col-12">
        <div class="well">
            <header>
                <h3>Получить рекомендации:</h3>
            </header>
            <fieldset>
                <section>
                    <label class="label">Город:</label><br/>
                    <label class="input">
                        {{ Form::select('city', array('Ростов-на-Дону'=>'Ростов-на-Дону', 'Москва'=>'Москва'), 'Ростов-на-Дону', array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                    </label>
                </section>

                <section>
                    <label class="label">Интересы (теги, через запятую):</label><br/>
                    <label class="input">
                        {{ Form::textarea('tags', 'ВДВ, театр', array('class'=>'redactor redactor_150')) }}
                    </label>
                </section>

            </fieldset>
            <footer>
        	    <button type="submit">Получить!</button>
            </footer>
        </div>
    </section>
	{{ Form::close() }}
    -->
    
    <div style="float:none;clear:both"></div>
    </center>
    <hr/>

@stop


@section('scripts')
    <script src="{{ link::path('js/system/extrem.js') }}"></script>

	{{HTML::script('js/vendor/dropzone.min.js');}}
    <script src="{{ link::path('js/modules/gallery.js') }}"></script>
@stop
