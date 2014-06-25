<?
$blogger_advices = ExtremBloggerAdvice::take(10)->get();

$user_photos = UserPhoto::where('approved', 1)->take(Config::get('site.limit_moderated_photos'))->get();
?>
<?
/*
$ch = curl_init();
 
//set the endpoint url
curl_setopt($ch,CURLOPT_URL, 'https://api.twitter.com/oauth2/token');
// has to be a post
curl_setopt($ch,CURLOPT_POST, true);
$data = array();
$data['grant_type'] = "client_credentials";
curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
 
// here's where you supply the Consumer Key / Secret from your app:
$consumerKey = 't0iX3noR4eXUBk5U5hPsHoM3O';
$consumerSecret = 'TPZb2IorgYnYs9foCLVge4fF9K6GyyLlOEMFpyu5RfAycFL5vk';           
curl_setopt($ch,CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
 
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
 
//execute post
$result = curl_exec($ch);
 
//close connection
curl_close($ch);
 
// show the result, including the bearer token (or you could parse it and stick it in a DB)       
print_r($result);
*/

function getTweets($amount = 5) {
	$username = 'grapheme_ru';
	$number_tweets = $amount;
	$feed = "https://api.twitter.com/1.1/search/tweets.json?q=%23часстрасти&result_type=recent";

	$cache_file = Config::get('site.tmp_dir').'/twitter-cache';
	$modified = @filemtime( $cache_file );
	$now = time();
	$interval = 600; // ten minutes

	// check the cache file
	if ( !$modified || ( ( $now - $modified ) > $interval ) ) {
	  $bearer = 'AAAAAAAAAAAAAAAAAAAAAHAEYQAAAAAAaPcpRqKG0KqFtpC7980ytxxx6cw%3DIux7SHjxOxcnjJfuXsGkEsPJ8sG8xCHcbDfdWPVorpcQuCEs8r';
	  $context = stream_context_create(array(
	    'http' => array(
	      'method'=>'GET',
	      'header'=>"Authorization: Bearer " . $bearer
	      )
	  ));
	  
	  $json = file_get_contents( $feed, false, $context );
	  
	  if ( $json ) {
	    $cache_static = fopen( $cache_file, 'w' );
	    fwrite( $cache_static, $json );
	    fclose( $cache_static );
	  }
	}

	$json = file_get_contents( $cache_file );

	return json_decode($json);
}
?>


        </div>
        <div id="load-overlay" class="overlay hidden">
            <div class="popup advice-popup hidden" data-popup="1">
                <div class="popup-head">
                    <div class="mini-logo"></div>
                    <div class="mini-slider">
                        <div class="slide slide-1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                            <div class="mini-desc">Клубника</div>
                        </div>
                        <div class="arr arr__left"><span class="icon icon-left-dir"></span></div>
                        <div class="arr arr__right"><span class="icon icon-right-dir"></span></div>
                    </div>
                    <div class="popup-close"></div>
                </div>
                <div class="popup-body" id="popupCont">
                    <header class="popup-header">
                        <h2>Extreme советы</h2>
                        <div class="popup-headdesc">
                            Наши советы о том, как можно провести «Час страсти»
                        </div>
                    </header>
                    <div class="popup-content">
                        <div class="popup-fotorama">
                            @foreach (ExtremBrandAdvice::take(10)->get() as $a => $advice)
                            <div class="slide slide-{{ ($a+1) }}" data-taste="{{ $advice->taste }}">
                                {{ $advice->desc }}
                            </div>
                            @endforeach
                        </div>                        
                    </div>
                    <footer class="popup-footer">
                        <script type="text/javascript" src="http://yandex.st/share/share.js" charset="utf-8"></script>
                        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,odnoklassniki" data-yashareTheme="counter"></div> 
                    </footer>
                </div>
            </div>
        <div class="popup advice-popup pad-popup hidden" data-popup="2">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <!--<div class="mini-slider">
                    <div class="slide slide-1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Клубника</div>
                    </div>
                    <div class="arr arr__left"><span class="icon icon-left-dir"></span></div>
                    <div class="arr arr__right"><span class="icon icon-right-dir"></span></div>
                </div>-->
                <div class="popup-close"></div>
            </div>
            <div class="popup-body clearfix">

                @foreach($blogger_advices as $a => $advice)
                <div class="column-content<?=($a>0?' hidden':'')?>">
                    <div class="content-image">
                        <? $photo = $advice->photo(); ?>
                        @if (is_object($photo))
                        <? $photo = $photo->full(); ?>
                        <img src="{{ $photo }}" alt="Час Страсти" />
                        @endif
                        <div class="content-title">
                            @if ($advice->title)
                            {{ $advice->title }}
                            @else
                            {{ $advice->author }}
                            @endif
                        </div>
                        <div class="content-info taste-{{ $advice->taste }}">
                            <span class="content-author">
                                {{ $advice->author }}
                            </span>
                            <span class="content-date">
                                {{ Helper::rdate("j M Y", $advice->created_at) }}
                            </span>
                        </div>
                    </div>
                    <div class="content-text">
                        {{ $advice->desc }}
                    </div>
                    <div class="content-social">
                        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
                        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,odnoklassniki" data-yashareTheme="counter"> </div>
                    </div>
                </div>
                @endforeach

                <div class="column-list">
                    <div class="list-title">Другие статьи</div>
                    <ul>
                        @foreach($blogger_advices as $a => $advice)
                        <li<?=($a==0?' style="display: none;"':'')?>>
                            <h3>
                                @if ($advice->title)
                                {{ $advice->title }}
                                @else
                                {{ $advice->author }}
                                @endif
                            </h3>
                            <div class="list-item-info clearfix taste-{{ $advice->taste }}">
                                <span class="list-author">
                                    {{ $advice->author }}
                                </span>
                                <span class="list-date">
                                    {{ Helper::rdate("j M Y", $advice->created_at) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="popup photo-popup hidden" data-popup="3">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="mini-slider">
                    <div class="slide slide-1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Клубника</div>
                    </div>
                    <div class="arr arr__left"><span class="icon icon-left-dir"></span></div>
                    <div class="arr arr__right"><span class="icon icon-right-dir"></span></div>
                </div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body">
                <header class="popup-header">
                    <h2>#Часстрасти</h2>
                    <div class="popup-headdesc">
                        Ваши фотографии из инстаграм<br>
                        с хэштегом #часстрасти
                    </div>
                </header>
                <div class="popup-content">
                    <div class="instaphoto-slider jcarousel">
                        <ul id="instaSlider">

                        </ul>
                    </div>
                    <a href="#" class="jcarousel-control jcarousel-control-prev"></a>
                    <a href="#" class="jcarousel-control jcarousel-control-next"></a>                        
                </div>
            </div>                
            <div class="instaphoto-slider-vertical jcarousel-vert">
                <ul id="instaNavSlider">
                </ul> 
            </div>                
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-prev">
                <span class="icon icon-up-dir"></span>
            </a>
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-next">
                <span class="icon icon-down-dir"></span>
            </a>
        </div>
        <div id="load-photo" class="popup app__popup advice-popup pad-popup hidden" data-popup="4">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body clearfix">
                <div class="msg-box">Спасибо за участие. Ваше фото было отправлено.</div>
                <div class="photo-border">
                	<div id="HolderPhoto"></div>
                    <div class="photo-frame"> </div>
                    <div class="photo-logo"> </div>
                </div>
                <form id="form-photo-save" method="POST" action="/upload">
					<input type="file" style="width: 1em;" name="file" class="input-photo invisible" id="selectPhoto">
					<button value="send" type="submit" class="photo-save">Отправить</button>
				</form>
                <a href="javascript:void(0);" class="photo-upload-link select-image">Загрузить другую фотографию</a>
            </div>
        </div>
        <div class="popup advice-popup hidden" data-popup="5">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body" id="popupCont">
                <header class="popup-header">
                    <h2>#ЧАССТРАСТИ</h2>
                    <div class="popup-headdesc">
                        Ваши твиты с хэштегом #часстрасти
                    </div>
                </header>
                <div class="popup-content">
                    <div class="popup-fotorama">
                    <?php
                        $tweets = getTweets(5);
                        #Helper::dd($tweets);
                        #for ($i=0; $i < count($tweets->statuses); $i++) {
                        foreach($tweets->statuses as $t => $tweet) {
                            #Helper::d($tweet);
                            #echo '<div class="slide slide-'.$i.'" data-taste="0">'.$tweets->statuses[$i]->text.'</div>';
                            echo '<div class="slide slide-'.$t.'" data-taste="0">'.$tweet->text.'</div>';
                            //echo $tweet->text."\n";
                            //echo "@".$tweet->user->screen_name."\n";
                        }
                    ?>
                    </div>                        
                </div>
                <footer class="popup-footer">
                    <script type="text/javascript" src="http://yandex.st/share/share.js" charset="utf-8"></script>
                    <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,odnoklassniki" data-yashareTheme="counter"></div> 
                </footer>
            </div>
        </div>


        <div class="popup photo-popup hidden" data-popup="6">
            <div class="popup-head">
                <div class="mini-logo"></div>
                <div class="mini-slider">
                    <div class="slide slide-1" style="background:url(../img/popups/mini01.png) no-repeat center center / auto 100%;">
                        <div class="mini-desc">Клубника</div>
                    </div>
                    <div class="arr arr__left"><span class="icon icon-left-dir"></span></div>
                    <div class="arr arr__right"><span class="icon icon-right-dir"></span></div>
                </div>
                <div class="popup-close"></div>
            </div>
            <div class="popup-body">
                <header class="popup-header">
                    <h2>ЧАС СТРАСТИ</h2>
                    <div class="popup-headdesc">
                        Ваши фотографии,<br/>
                        загруженные на сайт
                    </div>
                </header>
                <div class="popup-content">
                    <div class="instaphoto-slider jcarousel">
                        <ul id="photoSlider">

                            @foreach($user_photos as $photo)
                            <li class="insta-slide slide-1" style="background:url({{ Config::get('site.tmp_public_dir') }}/{{ $photo->image }}) no-repeat center center / cover;">
                                <div class="slide-desc">
                                    <div class="slide-user"></div>
                                    <div class="slide-description"></div>
                                    <div class="slide-tags"></div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <a href="#" class="jcarousel-control jcarousel-control-prev"></a>
                    <a href="#" class="jcarousel-control jcarousel-control-next"></a>                        
                </div>
            </div>                
            <div class="instaphoto-slider-vertical jcarousel-vert">
                <ul id="photoNavSlider">

                    @foreach($user_photos as $photo)
                    <li class="insta-slide slide-1" style="background:url({{ Config::get('site.tmp_public_dir') }}/{{ $photo->image }}) no-repeat center center / cover;">
                        <div class="slide-desc">
                            <div class="slide-user"></div>
                            <div class="slide-description"></div>
                            <div class="slide-tags"></div>
                        </div>
                    </li>
                    @endforeach

                </ul> 
            </div>                
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-prev">
                <span class="icon icon-up-dir"></span>
            </a>
            <a href="#" class="jcarousel-vert-control jcarousel-vert-control-next">
                <span class="icon icon-down-dir"></span>
            </a>
        </div>


    </div>
