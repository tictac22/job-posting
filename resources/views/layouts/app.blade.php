<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>

		<!-- Fonts -->
		<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@vite(['resources/css/app.css', 'resources/js/app.js','resources/css/fontawesome.min.css', 'resources/css/solid.min.css'])
	</head>
	<body class="antialiased bg-[#f4f9e2] font-mono">
		<div class="flex min-h-screen flex-col relative">
			@include('layouts.header')
			@yield('content')
			<footer>footer</footer>
		</div>
		@yield("scripts")
	</body>
</html>