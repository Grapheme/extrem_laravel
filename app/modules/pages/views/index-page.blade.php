@extends(Helper::layout())


@section('style')
@stop

@section('content')
<?

session_start();
if (Input::get('manifest') == '1') {

    setcookie('manifest', '1', time()+60*60*24*30*12, "/");
    $set = Settings::where('name', 'manifest_count')->first();
    if (is_object($set)) {
        $set->value = $set->value+1;
        $set->save();
    } else {
        Settings::create(array('name' => 'manifest_count', 'value' => 1));
    }

} else {

    if (@$_COOKIE['manifest'] != '1')
        Redirect('/');

}

$user_photo = UserPhoto::where('approved', 1)->first()->toArray();

?>
            <main data-bg="1">
                <div class="wrapper" data-arrow="1">
                    <div class="top clearfix">
                        <section class="app app-left">
                            <div id="app" class="app-head fotorama" data-auto="false">
                                
                            </div>                    
                            <footer class="app-footer">
                                <?php
                                $link = 'http://www.mamba.ru/promo/extreme.phtml';
                                if (@$_GET['r'] === 'mail') {
                                    $link = 'http://love.mail.ru/promo/extreme.phtml';
                                } elseif (@$_GET['r'] === 'rambler') {
                                    $link = 'http://love.rambler.ru/promo/extreme.phtml';
                                }
                                ?>
                                <a id="photo__popup" target="_blank" href="<?= $link ?>">Приложение</a>
                            </footer>
                        </section>
                        <div class="ice-cream-slider">
                            <h2 class="ice-logo">Extreme</h2>
                            <div class="slide slide-1">
                                <div class="left-splash"></div>
                                <div class="ice-cream"></div>
                                <div class="right-splash"></div>
                            </div>
                            <div class="slide slide-2">
                                <div class="left-splash"></div>
                                <div class="ice-cream"></div>
                                <div class="right-splash"></div>
                            </div>
                            <div class="slide slide-3">
                                <div class="left-splash"></div>
                                <div class="ice-cream"></div>
                                <div class="right-splash"></div>
                            </div>
                            <div class="slide slide-4">
                                <div class="left-splash"></div>
                                <div class="ice-cream"></div>
                                <div class="right-splash"></div>
                            </div>
                            <div class="slide slide-5">
                                <div class="left-splash"></div>
                                <div class="ice-cream"></div>
                                <div class="right-splash"></div>
                            </div>
                            <div class="slide slide-6">
                                <div class="left-splash"></div>
                                <div class="ice-cream"></div>
                                <div class="right-splash"></div>
                            </div>
                            <div class="arrow arrow-left disabled">
                                <span class="icon icon-left-dir"></span>
                            </div>
                            <div class="arrow arrow-right">
                                <span class="icon icon-right-dir"></span>
                            </div>
                            <div class="ice-cream-desc">
                                <div class="desc-slide" data-slide="slide-1">
                                    <div class="ice-cream-head">Клубника</div>
                                    <div class="ice-cream-body">
                                        – клубничные страсти для ярких и темпераментных
                                    </div>
                                </div>
                                <div class="desc-slide" data-slide="slide-2">
                                    <div class="ice-cream-head">Фисташка</div>
                                    <div class="ice-cream-body">
                                        – дразнящая страсть для любителей запретных желаний
                                    </div>
                                </div>
                                <div class="desc-slide" data-slide="slide-3">
                                    <div class="ice-cream-head">Тропик</div>
                                    <div class="ice-cream-body">
                                        – тропические фантизии для тех, кто просыпается вместе
                                    </div>
                                </div>
                                <div class="desc-slide" data-slide="slide-4">
                                    <div class="ice-cream-head">Ямбери</div>
                                    <div class="ice-cream-body">
                                        – страстная экзотика для искателей новых ощущений
                                    </div>
                                </div>
                                <div class="desc-slide" data-slide="slide-5">
                                    <div class="ice-cream-head">Два Шоколада</div>
                                    <div class="ice-cream-body">
                                        – нежная страсть для ценителей традиций
                                    </div>
                                </div>
                                <div class="desc-slide" data-slide="slide-6">
                                    <div class="ice-cream-head">Пломбирно-Ягодный</div>
                                    <div class="ice-cream-body">
                                        – утончённые идеи для элегантных и страстных
                                    </div>
                                </div>
                            </div>                            
                        </div>

                        {{-- LAST MODERATED PHOTO --}}

                        <section class="app app-right">

                            <div id="app2" class="app-head">
                                <img class="app-bg" src="<?=(@$user_photo['image']?Config::get('site.tmp_public_dir')."/".$user_photo['image']:'img/apps/02.jpg')?>" alt="">
                                <header>{{-- Анна<br>Межиковская --}}</header>
                                <div class="app-tag">на нашем сайте</div>
                            </div>

                            <footer class="app-footer">
                                <a href="/application" target="_blank">Приложение</a>
                            </footer>
                        </section>

                        {{-- /LAST MODERATED PHOTO --}}

                    </div>
                    <ul class="bot-links">
                        <li id="advices" class="bot-link bot-link_b advices">
                            <section>
                                <header>{{ Helper::preview(ExtremBrandAdvice::first()->desc, 6) }}</header>
                                <a href="#"></a>
                                <footer>extreme советы</footer>
                            </section>
                        <li id="events" class="bot-link bot-link_m events">
                            <section>
                                <header>Презентации<br>нового вкуса<br>extreme</header>
                                <a href="#"></a>
                                <footer>события</footer>
                            </section>
                        <li id="bloggers" class="bot-link bot-link_b bloggers">
                            <section>
                                <header>{{ ExtremBloggerAdvice::first()->author }}</header>
                                <a href="#"></a>
                                <footer>extreme блоггеры</footer>
                            </section>
                    </ul>
                    <a class="dropzone select-image" href="javascript:void(0);"><span class="drop-text">Загрузите вашу фотографию</span></a>
                    <footer class="main-footer">
                        <div class="hot-line">
                            <span>горячая линия</span>
                            <a href="tel:+78003470200">8-800-347 02 00</a>
                        </div>

                        <?php if (@$_GET['r'] !== 'mail' && @$_GET['r'] !== 'rambler') : ?>
                        <div class="extreme-vk">
                            <a href="http://vk.com/extremenestle" target="_blank"><span class="icon icon-vkontakte-rect"></span> vk.com/extremenestle</a>
                        </div>
                        <?php endif; ?>

                        <div class="feedback">
                            <a href="mailto:hourofpassion@gmail.com">обратная связь</a>
                        </div>
                    </footer>
                </div>
            </main>
@stop


@section('scripts')
@stop