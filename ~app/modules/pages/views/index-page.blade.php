@extends('templates.default')


@section('style')
    {{ HTML::style('theme/css/fotorama.css') }}
@stop

{{-- Default layout: section('content') <= $content --}}
{{--
@section('content')
	{{ $content }}
@stop
--}}


@section('scripts')
    {{ HTML::script('theme/js/vendor/fotorama.js'); }}
@stop