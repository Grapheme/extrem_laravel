<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Создать фото страсти</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body class="app-body">
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <header class="app-header"></header>
    <div class="app-main">
        <div class="app-container">
            <a href="#" class="app-logo-ext"></a>
            <a href="#" class="app-logo-hou"></a>
            <!--<a href="#" class="app-add-text">Добавить текст</a>-->
            <div class="app-window">
                <div class="app-upload">
                    <a href="#" class="upload-zone">Загрузите сюда фотографию</a>
                    <a class="select-image upload-btn" href="javascript:void(0);">Выбрать фото</a>
                </div>
                <div class="app-screen">
                    <span class="logo-ext"></span>
                    <span class="logo-hou"></span>
                    <div class="app-overlay"></div>
                	<div id="HolderPhoto"></div>
                </div>
            </div>
            <div class="app-nav">
                <a href="#" class="share-btn"><span>Поделиться</span></a>
                <form id="form-photo-save" method="POST" action="/upload">
					<input type="file" style="width: 1em;" name="file" class="input-photo invisible" id="selectPhoto">
					<button value="send" type="submit" class="save-btn"><span>Сохранить</span></button>
                    <input type="hidden" name="logo-extreme" value="no">
                    <input type="hidden" name="logo-hours" value="no">
                    <input type="hidden" name="filter" value="no">
                    <input type="hidden" name="width">
                    <input type="hidden" name="height">
				</form>
                <div class="app-ices">
                    <div class="ice-item">
                        <a href="#" class="ice-cream" data-ice="yamberi"></a>
                        <span class="ice-name"><span>Ямбери</span></spam>
                    </div>
                    <div class="ice-item">
                        <a href="#" class="ice-cream" data-ice="tropic"></a>
                        <span class="ice-name"><span>Тропик</span></span>
                    </div>
                    <div class="ice-item">
                        <a href="#" class="ice-cream" data-ice="strawberry"></a>
                        <span class="ice-name"><span>Клубника</span></span>
                    </div>
                    <br>
                    <div class="ice-item">
                        <a href="#" class="ice-cream" data-ice="pistachio"></a>
                        <span class="ice-name"><span>Фисташка</span></span>
                    </div>
                    <div class="ice-item">
                        <a href="#" class="ice-cream" data-ice="whitechokolate"></a>
                        <span class="ice-name"><span>Два шоколада</span></span>
                    </div>
                    <div class="ice-item">
                        <a href="#" class="ice-cream" data-ice="blackcurrant"></a>
                        <span class="ice-name"><span>Пломбирно-Ягодный</span></span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <footer class="app-footer">
            <a href="#" class="soc-vk"></a>
            <a href="#" class="soc-fb"></a>
            <a href="#" class="soc-ok"></a>
            <span class="app-share">Делись фото в соцсетях</span>
        </footer>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/app.js"></script>
    <script src="js/libs/jquery-form.min.js"></script>
	<script src="js/libs/upload.js"></script>
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