<?
    if (@$_COOKIE['manifest'] == '1')
        Redirect('/main');

    $counter = 0;
    $set = Settings::where('name', 'manifest_count')->first();
    if (is_object($set))
        $counter = $set->value;

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Час Страсти</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/fotorama.css">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body class="manifest-body">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="manifest-wrapper">
            <div class="crops-wrapper">
                <div class="man man-1">
                    <span class="min">Почему мы ждем его/ее</span>
                    <span class="large">вконтакте,</span>
                    <span class="med">а не в своих</span>
                    <span class="big">объятиях?</span>
                </div>
                <div class="man man-2">
                    <span class="big">Почему смотрим</span>
                    <span class="med">на экран чаще, чем в</span>
                    <span class="large">любимые глаза</span>
                </div>
                <div class="man man-3">
                    <span class="min">Пора понять: поцелуи</span>
                    <span class="big">слаще лайков,</span>
                    <span class="med">реальная страсть</span>
                    <span class="large">вкуснее</span>
                </div>
                <div class="man man-4">
                    <span class="min">Пора выйти из сети</span>
                    <span class="med">и уделить время</span>
                    <span class="large">любимым.</span>
                </div>
                {{--
                <a href="/main<? echo (strlen($_SERVER['QUERY_STRING']) > 2) ? '?'.$_SERVER['QUERY_STRING'] : ''; ?>" class="enter-btn"> </a>
                --}}
                <form action="/main<? echo (strlen($_SERVER['QUERY_STRING']) > 2) ? '?'.$_SERVER['QUERY_STRING'] : ''; ?>" method="POST">
                <input type="hidden" name="manifest" value="1" />
                <a href="#enter" class="enter-btn" onclick="$(this).closest('form').submit()"> </a>
                </form>
                <div class="counter">
                    {{ $counter }}
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-52189500-1', 'mamba.ru');
            ga('send', 'pageview');
        </script>
</body>
</html>
