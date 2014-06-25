
    <script type="text/javascript">
        var tag = 'часстрасти';
        var feed = new Instafeed({
            target: 'app',
            get: 'tagged',
            tagName: tag,
            clientId: 'a541556dc1cc4a6ab63d72498e28801f',
            resolution: 'low_resolution',
            template:
               '<div>' +
               '<a href="{{link}}"><img src="{{image}}" /></a>' + 
               '<img class="app-bg" src="{{image}}" alt="">' +
               '<header><span>{{model.user.full_name}}</span></header>' +
               '<div class="app-tag"><span>#' + tag + '</span></div>' +
               '</div>',
            useHttp: true,
            sortBy: 'most-liked',
            limit: 60,
            after: function(){
                fotoramaInit();
            }
        });
        feed.run();

        var bigSlider = new Instafeed({
            target: 'instaSlider',
            get: 'tagged',
            tagName: tag,
            clientId: 'a541556dc1cc4a6ab63d72498e28801f',
            resolution: 'low_resolution',
            template:

            '<li class="insta-slide slide-1" style="background:' +
                'url({{image}}) no-repeat center center / cover;">'+
                '<div class="slide-desc">'+
                    '<div class="slide-user">{{model.user.full_name}}</div>'+
                    '<div class="slide-description"></div>'+
                    '<div class="slide-tags">#часстрасти</div>' +
                '</div>' +
            '</li>',

            useHttp: true,
            sortBy: 'none',
            limit: 60,
            after: function(){
                navInit();
            }
        });
        bigSlider.run();

        function navInit() {
            var elems = $('#instaSlider .insta-slide').clone().empty();
            var parent = $('#instaNavSlider');
            parent.append(elems);
            jCarouselInit();
        };       
    </script>
