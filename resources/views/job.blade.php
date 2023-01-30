@extends('layouts.app')
@section("title","Manage")

@section('metatags')
<x-head 
	description="Find your dream job here"
	title="Job-post"
	image="{{url('/'). '/assets/seo-images/index.png'}}"
	imageAlt='Find or post job here'
/>
@endsection

@section('content')
<main class="flex-1">
	<div class="container">
		<h1>Posts!!!!!</h1>
	</div>
</main>
@endsection

@section('scripts')
	<!-- @vite('resources/js/register.js') -->
@endsection