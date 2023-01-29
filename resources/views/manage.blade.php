@extends('layouts.app')
@section("title","Manage")
@section('content')
<main class="flex-1">
	<div class="container">
		<h1 class="text-3xl font-bold">Manage jobs</h1>
		<a href="/create" class="text-purple-700 hover:underline block mt-2 text-xl">Create new one</a>

	</div>
</main>
@endsection

@section('scripts')
	<!-- @vite('resources/js/register.js') -->
@endsection