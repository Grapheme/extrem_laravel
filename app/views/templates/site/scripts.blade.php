
        @if(Config::get('app.use_scripts_local'))
        	{{ HTML::script('js/vendor/jquery.min.js') }}
        @else
            {{ HTML::script("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js") }}
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        @endif
        {{-- HTML::script("js/vendor/jquery.selectbox.js") --}}

        {{ HTML::script("js/plugins.js") }}
        {{ HTML::script("js/main.js") }}
        {{ HTML::script("//ulogin.ru/js/ulogin.js") }}
        {{ HTML::script("js/vendor/instafeed.min.js") }}


    {{ HTML::script("js/vendor/fotorama.js") }}
    <script>
        function fotoramaInit() {
            var parent = $('.fotorama').fotorama({
                arrows: false,
                nav: false,
                height: '280',
                autoplay: '15000',
                transition: 'crossfade'
            });
        }
    </script>

    {{ HTML::script("js/vendor/jcarousel.js") }}
    <script>
        //Bounded slider for instagram photos
        function jCarouselInit() {
            var connector = function(itemNavigation, carouselStage) {
                return carouselStage.jcarousel('items').eq(itemNavigation.index());
            };
            var mainCarousel = $('.jcarousel').jcarousel({

            });
            var navCarousel = $('.jcarousel-vert').jcarousel({
                vertical: true
            });
//alert("1");

            navCarousel.jcarousel('items').each(function() {
                var item = $(this);

                // This is where we actually connect to items.
                var target = connector(item, mainCarousel);

                item
                    .on('jcarouselcontrol:active', function() {
                        navCarousel.jcarousel('scrollIntoView', this);
                        item.addClass('active');
                    })
                    .on('jcarouselcontrol:inactive', function() {
                        item.removeClass('active');
                    })
                    .jcarouselControl({
                        target: target,
                        carousel: mainCarousel
                    });
            });

            $('.jcarousel-control-prev')
                .on('jcarouselcontrol:active', function() {
                    $(this).removeClass('inactive');
                })
                .on('jcarouselcontrol:inactive', function() {
                    $(this).addClass('inactive');
                })
                .jcarouselControl({
                    target: '-=1'
                });

            /* Main Carousel Controls */
            $('.jcarousel-control-next')
                .on('jcarouselcontrol:active', function() {
                    $(this).removeClass('inactive');
                })
                .on('jcarouselcontrol:inactive', function() {
                    $(this).addClass('inactive');
                })
                .jcarouselControl({
                    target: '+=1'
                });

            $('.jcarousel-vert-control-prev')
                .on('jcarouselcontrol:inactive', function() {
                    $(this).addClass('inactive');
                })
                .on('jcarouselcontrol:active', function() {
                    $(this).removeClass('inactive');
                })
                .jcarouselControl({
                    target: '-=1'
                });
            /* Nav Carousel Controls */
            $('.jcarousel-vert-control-next')
                .on('jcarouselcontrol:inactive', function() {
                    $(this).addClass('inactive');
                })
                .on('jcarouselcontrol:active', function() {
                    $(this).removeClass('inactive');
                })
                .jcarouselControl({
                    target: '+=1'
                });
        };
        var $popupFotorama = $('.popup-fotorama').fotorama({
            nav: false,
            width: '848',
            height: '400',
            arrows: 'always'
        });
        var $popupFotoramaApi = $popupFotorama.data('fotorama');
        
        $popupFotorama.on(
          'fotorama: show fotorama:showend',
          function (e, fotorama, extra) {
            var index = $('.fotorama__active .slide').data('taste');
            $('#popupCont').attr('data-taste', index);
          }
        );
    </script>

    <? include(Helper::inclayout('literal')); ?>


    {{ HTML::script("js/libs/jquery-form.min.js") }}
    {{ HTML::script("js/libs/upload.js") }}

