@extends(Helper::layout())


@section('style')
@stop


@section('content')
	<main class="container services contacts">
		<h1>{{ $page_title }}</h1>
		<div class="content">

			{{ @$content }}

			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:500px;width:600px;"><div id="gmap_canvas" style="height:400px;width:100%;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(47.231278, 39.689791),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(47.231278, 39.689791)});infowindow = new google.maps.InfoWindow({content:"{{trans('interface.map_adress')}}" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);
        	</script>
		</div>
	</main>
@stop


@section('scripts')
@stop
