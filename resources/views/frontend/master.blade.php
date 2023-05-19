<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
	<title>Blog Project</title>
    @include('frontend.layout.css')

</head>

<body>

@include('frontend.layout.header')
{{-- @include('frontend.layout.navigation') --}}
@yield('content')
@include('frontend.layout.footer')

	

@include('frontend.layout.script')
</body>

</html>