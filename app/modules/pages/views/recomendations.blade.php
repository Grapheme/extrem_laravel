@extends(Helper::layout())


@section('style')
@stop


@section('content')
<?
if (!Input::get('line'))
    Redirect("/");
?>
        <main class="recomendations">
            <h2>
                Персональные рекомендации для вас<br>
                на выходные 22-23 июня 2014 года
            </h2>
            <ul class="rec-filter">
                <li class="rec-filter-li">
                    <a href="#">Места</a>
                <li class="rec-filter-li">
                    <a href="#">Мероприятия</a>
                <li class="rec-filter-li">
                    <a href="#">Советы</a>
                <li class="rec-filter-li">
                    <a href="#">Где купить</a>
            </ul>

            <section class="places">
                <div class="section-cont">

<?

## Лимиты на количество выводимых объектов каждого типа
$limit = array(
    'places' => 5,
    'actions' => 5,
    'advices' => 5,
    'wheretobuy' => 5,
);

#Helper::d(Input::all());

$line = json_decode(Input::get('line'), 1);

#Helper::d($line);

/*
$user_data = array(
    'city'   => Input::get('city'),
    'tags'   => Input::get('tags'),
    'family' => Input::get('family'),
    'taste'  => Input::get('taste'),
    'date'   => Input::get('date'),
);
*/

$user_data = array(
    'city'   => @$line['city'],
    'tags'   => @$line['interests'],
    'family' => @$line['family'],
    'taste'  => @$line['taste'],
    'date'   => isset($line['date']) && $line['date'] != 'undefined' && $line['date'] != '' ? $line['date'] : false,
);
$user_data['tags'] = implode(",", $user_data['tags']);

#$ages = array('0-3', '4-7', '7-10', '10-14', '14+');
$ages = array();
foreach($user_data['family']['children'] as $age) {
    if ($age > 0) {
        if ($age <=3)
            $ages[] = '0-3';
        elseif ($age <=7)
            $ages[] = '4-7';
        elseif ($age <=10)
            $ages[] = '7-10';
        elseif ($age <=14)
            $ages[] = '10-14';
        else
            $ages[] = '14+';
    }
}
$user_data['family'] = implode(",", $ages);


#Helper::d($user_data);

#$alltags = trim(Input::get('tags'));
$alltags = trim(
    implode(",",
        array(
            $user_data['tags'],
            $user_data['family'],
            $user_data['taste'],
        )
    )
);
#Helper::dd($alltags);

$temp = array();
$alltags = strpos($alltags, ",") ? explode(",", $alltags) : array($alltags);
foreach ($alltags as $t => $tag) {
    $tag = trim($tag);
    if ($tag != '')
        $temp[] = $tag;
}
$alltags = $temp;
$alltags_count = count($alltags);

#Helper::dd($alltags);

############################################

$usi = @$_COOKIE["user_social_info"];
$usi = @json_decode($usi, 1);

#Helper::dd($usi);
#Helper::dd($user_data);


$profile_id = false;
if (is_array($usi) && isset($usi['profile']) && $usi['profile'] != '') {

    ## SAVE TO DB: < id | profile | city | json:user_data | json:user_social_info >

    $array = array(
        'profile'     => $usi['profile'],
        'city'        => Input::get('city'),
        'preferences' => json_encode($user_data),
        'social_info' => json_encode($usi),
    );

    $info = UserSocialInfo::where('profile', $usi['profile'])->first();

    #Helper::d($info); echo "<hr/>";
    #Helper::d($array);

    if (@is_object($info)) {
        $profile_id = $info->id;
        #$info->city = $user_data['city'];
        $info->update($array);
        #$info->save();
        #Helper::d($info);
    } else {
        $info = UserSocialInfo::create($array);
    }
}
#Helper::d($info);
#Helper::d($user_data);
#Helper::d($usi);
#die;

$js = array();

####################################################################################
### МЕСТА
####################################################################################

$objects = array(); ## Объекты
$overlap = array(); ## Совпадения тегов и интересов
## Ищем все уникальные объекты с тегом переданного города
$tags = _48hoursTag::where('module', '48hoursPlaces')
                   ->where('tag', $user_data['city'])
                   ->select('unit_id')->distinct()
                   ->get();
#Helper::dd($tags);
## Перебираем
foreach ($tags as $tag) {
    ## Получаем место по тегу
    $place = $tag->place->first();
    ## Если место не найдено (такое может быть) - пропускаем
    if(is_null($place))
        continue;
    ## Получаем ВСЕ теги объекта
    $place_tags = Tag::where('module', '48hoursPlaces')
                     ->where('unit_id', $place->id)
                     ->get();
    $place->tags = $place_tags;
    ## Пересечение тегов и интересов
    $overlap[$place->id] = 0;
    ## Ищем и подсчитываем пересечения
    foreach ($place_tags as $place_tag) {
        if ($place_tag->tag == $user_data['city'])
            continue;
        foreach ($alltags as $alltag) {
            if ($alltag == $user_data['city'])
                continue;
            if (mb_strtolower($place_tag->tag) == mb_strtolower($alltag))
                ++$overlap[$place->id];
        }
    }
    $objects[$place->id] = $place;
}
## Сортируем по убыванию
arsort($overlap);
#Helper::d($overlap);
#Helper::d($objects);

## Если что-то нашлось - выводим
?>
    @if (@count($objects))

            <h3 id="places_anch">
                Места
            </h3>
            <ul class="places-ul">

<?
$i = 0;
$js['places'] = array();
?>
        @foreach ($overlap as $place_id => $count)
<?
            if (++$i > $limit['places'])
                break;
            $place = $objects[$place_id];
            $photo = $place->photo();
            if (is_object($photo))
                $photo = $photo->full();

            $js['places'][$place->id] = array(
                'id' => $place->id,
                'name' => $place->name,
                'desc' => $place->desc,
                'photo' => $photo,
            ); 
?>

                <li class="places-li">
                    <div class="places-head" style="background-image: url({{ $photo }});"></div>
                    <div class="places-body">
                        <a href="#" class="places-link" data-place="{{ $place->id }}">{{ $place->name }}</a>
                        @if ($place->type)
                        <div class="places-name">{{ $place->type }}</div>
                        @endif
                        @if ($place->metro)
                        <div class="places-street"><span class="icon icon-location"></span>{{ $place->metro }}</div>
                        @endif
                    </div>

        @endforeach

    @endif

            </ul>
<?
#echo "<div style='float:none; clear:both'></div>";

####################################################################################
### МЕРОПРИЯТИЯ
####################################################################################

$objects = array(); ## Объекты
$overlap = array(); ## Совпадения тегов и интересов
## Ищем все уникальные объекты с тегом переданного города
$tags = _48hoursTag::where('module', '48hoursActions')
                   ->where('tag', $user_data['city'])
                   ->select('unit_id')->distinct()
                   ->get();
## Перебираем
foreach ($tags as $tag) {
    ## Получаем объект по тегу
    $action = $tag->action->first();
    ## Если объект не найден (такое может быть) - пропускаем
    if(is_null($action))
        continue;
    ## Получаем ВСЕ теги объекта
    $action_tags = Tag::where('module', '48hoursActions')
                     ->where('unit_id', $action->id)
                     ->get();
    $action->tags = $action_tags;
    ## Пересечение тегов и интересов
    $overlap[$action->id] = 0;
    ## Ищем и подсчитываем пересечения
    foreach ($action_tags as $action_tag) {
        if ($action_tag->tag == $user_data['city'])
            continue;
        foreach ($alltags as $alltag) {
            if ($alltag == $user_data['city'])
                continue;
            if (mb_strtolower($action_tag->tag) == mb_strtolower($alltag))
                ++$overlap[$action->id];
        }
    }
    $objects[$action->id] = $action;
}
## Сортируем по убыванию
arsort($overlap);
#Helper::d($overlap);
#Helper::d($objects);

    ## Если что-то нашлось - выводим
?>
    @if (@count($objects))

        <h3 id="events_anch" class="clear-header">
            Мероприятия
        </h3>
        <ul class="events-ul">
<?    
        $i = 0;
        $js['events'] = array();
?>
        @foreach ($overlap as $action_id => $count)
<?
            if (++$i > $limit['actions'])
                break;
            $action = $objects[$action_id];
            $photo = $action->photo();
            if (is_object($photo))
                $photo = $photo->full();

            $js['events'][$action->id] = array(
                'id' => $action->id,
                'name' => $action->name,
                'desc' => $action->desc,
                'photo' => $photo,
                'date' => Helper::rdate("d M", $action->date_time, true),
                'time' => $action->time,
                'where' => $action->where,
                'price' => $action->price,
                'web' => $action->web,
            ); 

?>
            <li class="events-li">
                <div class="events-head" style="background-image: url({{ $photo }});"></div>
                <div class="events-body">
                    <a href="#" class="events-link" data-place="{{ $action->id }}">{{ $action->name }}</a>
                    <div class="events-desc">
                        {{ Helper::preview($action->desc, 20) }}
                    </div>
                    @if ($action->date_time && $action->time)
                    <div class="events-date"><span class="icon icon-calendar-1"></span>{{ Helper::rdate("d M", $action->date_time, true) }}, {{ $action->time }}</div>
                    @endif
                </div>

            {{--
            echo "<div style='width:24%; height:200px; border:1px solid #aaa; float:left; overflow:hidden;'>";
            echo "<button class='i-will-go' data-type='action' data-id='{$action->id}'>Я пойду</button>";
            echo "<strong>{$action->name}</strong> (совпадений: {$count}/{$alltags_count})<i>{$action->desc}</i>";
            echo "</div>";
            --}}
        @endforeach
        </ul>
    @endif

<?
#echo "<div style='float:none; clear:both'></div>";

####################################################################################
### СОВЕТЫ
####################################################################################

$objects = array();
$overlap = array();
## Ищем только по интересам
$tags = _48hoursTag::where('module', '48hoursAdvices')
                   ->whereIn('tag', $alltags)
                   ->select('unit_id')->distinct()
                   ->get();
foreach ($tags as $tag) {
    $advice = $tag->advice->first();
    if(is_null($advice))
        continue;
    ## Получаем ВСЕ теги объекта
    $advice_tags = Tag::where('module', '48hoursAdvices')
                     ->where('unit_id', $advice->id)
                     ->get();
    $advice->tags = $advice_tags;
    ## Пересечение тегов и интересов
    $overlap[$advice->id] = 0;
    ## Ищем и подсчитываем пересечения
    foreach ($advice_tags as $advice_tag) {
        if ($advice_tag->tag == $user_data['city'])
            continue;
        foreach ($alltags as $alltag) {
            if ($alltag == $user_data['city'])
                continue;
            if (mb_strtolower($advice_tag->tag) == mb_strtolower($alltag))
                ++$overlap[$advice->id];
        }
    }
    $objects[$advice->id] = $advice;
}
#Helper::dd(DB::getQueryLog());
## Сортируем по убыванию
arsort($overlap);

    ## Если что-то нашлось - выводим
?>
    @if (@count($objects))
        <h3 id="advices_anch" class="clear-header big">
            Советы
        </h3>
        <ul class="advices-ul">
<?
        $i = 0;
        $js['advices'] = array();
?>
        @foreach ($overlap as $advice_id => $count)
<?
            if (++$i > $limit['advices'])
                break;
            $advice = $objects[$advice_id];

            $js['advices'][$advice->id] = array(
                'id' => $advice->id,
                'name' => $advice->name,
                'desc' => $advice->desc,
            ); 
?>
            <li class="advices-li">
                <div class="advices-head">
                    <a href="#" data-place="{{ $advice->id }}">{{ $advice->name }}</a>
                </div>
                <div class="advices-body">
                    {{ Helper::preview($advice->desc, 20) }}
                </div>
            </li>

        @endforeach
        </ul>
    @endif

<?
####################################################################################
### ГДЕ КУПИТЬ
####################################################################################

$objects = array();
## Ищем только по городам
$tags = _48hoursTag::where('module', '48hoursWheretobuy')
                   ->where('tag', $user_data['city'])
                   ->select('unit_id')->distinct()
                   ->get();
foreach ($tags as $tag) {
    $wheretobuy = $tag->wheretobuy->first();
    if(is_null($wheretobuy))
        continue;
    $objects[] = $wheretobuy;
}

    ## Если что-то нашлось - выводим
?>
    @if (@count($objects))
        <h3 id="where2b_anch" class="clear-header big">
            Где купить
        </h3>
        <ul class="wtb-ul">

<?
        $i = 0;
?>
        @foreach ($objects as $wheretobuy)
<?
            if (++$i > $limit['wheretobuy'])
                break;
?>
            <li class="wtb-li">
                <div class="wtb-head">{{ $wheretobuy->name }}</div>
                <div class="wtb-body">{{ $wheretobuy->desc }}</div>
            </li>
        @endforeach
        </ul>
    @endif

<?
####################################################################################

#Helper::dd(DB::getQueryLog());

?>

                </div>
            </section>
            <div class="scroll-top">
                <div class="scroll-circle">
                    <span class="icon icon-up-open"></span>
                </div>
                <span class="scroll-text">Наверх</span>
            </div>
        </main>

@stop


@section('scripts')

    {{ HTML::script('js/vendor/handlebars-v1.3.0.js') }}

    <script>
    var popup__data = <?=json_encode($js)?>;
    </script>

    <script>var profile_id = '{{ $profile_id }}';</script>
@stop
