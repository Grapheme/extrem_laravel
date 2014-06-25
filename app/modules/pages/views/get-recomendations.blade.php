@extends(Helper::layout())


@section('style')
@stop


@section('content')

<?
$preferences = array();

$usi = @$_COOKIE["user_social_info"];
$usi = @json_decode($usi, 1);
if (is_array($usi) && isset($usi['profile']) && $usi['profile'] != '') {
    $info = UserSocialInfo::where('profile', $usi['profile'])->first();
    if (is_object($info)) {
        #Helper::dd($info);
        $preferences = json_decode($info->preferences, 1); 
    }
}
?>

    <hr/>
    <center>

    {{ $content }}

    <script src="//ulogin.ru/js/ulogin.js"></script><div id="uLogin1" data-uloginid="93adc6a7"></div>

	{{ Form::open(array('url'=>'recomendations', 'role'=>'form', 'class'=>'get-recomendations-form', 'id'=>'get-recomendations-form')) }}

    <section class="col col-12">
        <div class="well">
            <header>
                <h3>Получить рекомендации:</h3>
                <div class="welcome_msg"></div>
            </header>
            <fieldset>

                <section>
                    <label class="label">Город:</label><br/>
                    <label class="input">
                        {{ Form::select('city', array('Ростов-на-Дону'=>'Ростов-на-Дону', 'Москва'=>'Москва'), @$info->city, array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                    </label>
                </section>

                <section>
                    <label class="label">Интересы (теги, через запятую):</label><br/>
                    <label class="input">
                        {{ Form::textarea('tags', @$preferences['tags'], array('class'=>'redactor redactor_150')) }}
                    </label>
                </section>

                <hr/>

                <section>
                    <label class="label">Состав семьи (теги, через запятую):</label><br/>
                    <label class="input">
                        {{ Form::textarea('family', @$preferences['family'], array('class'=>'redactor redactor_150')) }}
                    </label>
                </section>

                <section>
                    <label class="label">Вкус мороженного:</label><br/>
                    <label class="input">
                        {{ Form::select('taste', array('Клубничное'=>'Клубничное', 'Шоколадное'=>'Шоколадное'), @$preferences['taste'], array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                    </label>
                </section>

                <section>
                    <label class="label">Дата:</label><br/>
                    <label class="input">
                        {{ Form::select('date', array('2014.06.21-2014.06.22'=>'21-22 июня', '2014.07.05-2014.07.06'=>'5-6 июля'), @$preferences['date'], array('class'=>'template-change', 'autocomplete'=>'off')) }} <i></i>
                    </label>
                </section>

            </fieldset>
            <footer>
        	    <button type="submit">Получить!</button>
            </footer>
        </div>
    </section>
    
	{{ Form::close() }}
    
    <div style="float:none;clear:both"></div>
    </center>
    <hr/>

@stop


@section('scripts')
    <script src="{{ link::path('js/system/48hours.js') }}"></script>
@stop
