
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title>{{ config('app.name', 'Laravel') }}</title>
		<meta charset="utf-8" />
		<meta name="token" content="{{ session('bearer_token') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
		<meta property="og:url" content="{{ url('') }}" />
		<meta property="og:site_name" content="Laravel 11" />
		
		@include('metronic/css')
        @yield('custom-css')
	</head>
	<body 
		id="kt_body" 
		class="aside-enabled"
		@if (session('success')) notification_success="true"
        notification_message="{{ session('success') }}" @endif
        @if (session('warning')) notification_warning="true"
        notification_message="{{ session('warning') }}" @endif
        @if (session('info')) notification_info="true"
        notification_message="{{ session('info') }}" @endif
        @if (count($errors) > 0) notification_error="true"
        notification_data="{{ json_encode($errors->all()) }}" @endif
	>
		
		<script src="{{ asset('js/theme.js') }}"></script>
		
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				@include('layouts.sidebar')
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include('layouts.header')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="post d-flex flex-column-fluid" id="kt_post">
							@yield('content')
						</div>
					</div>
					@include('layouts.footer')
				</div>
			</div>
		</div>
		
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		
		@include('metronic/javascript')
        @yield('custom-js')
	</body>
</html>