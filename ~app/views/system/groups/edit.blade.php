@extends('templates.'.AuthAccount::getStartPage())


@section('style')

@stop


@section('content')
	@include('system.groups.forms.edit')
@stop


@section('scripts')
	<script src="{{ link::to('js/modules/groups.js') }}"></script>
	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js') }}", runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js') }}");
		}
	</script>
@stop