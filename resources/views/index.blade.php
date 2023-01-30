@extends('layouts.app')
@section('title', 'Laravel')
@section('metatags')
<x-head 
	description="Find your dream job here"
	title="Job-post"
	image="{{url('/'). '/assets/seo-images/index.png'}}"
/>
@endsection
@section('content')
<main class="flex-1 my-4">
	<div class="h-[500px] bg-[#62d0df] flex items-center justify-center text-center">
		<div class="container">
			<div>
				<h1 class="text-white text-4xl tracking-wider ">BlueCollar</h1>
				<p class="mt-1">Find or post Web developer jobs</p>
				@auth
					<a href="/create" class="uppercase p-4 bg-amber-500 hover:bg-amber-600 transition-colors cursor-pointer text-white mt-5 block">Create a new job</a>
				@endauth
				@guest
					<a href="/login" class="uppercase p-4 bg-amber-500 hover:bg-amber-600 transition-colors cursor-pointer text-white mt-5 block">sign up to list a job</a>
				@endguest
			</div>
		</div>
	</div>
	<div>
		<div class="container">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
				<x-post/>
				<x-post/>
				<x-post/>
				<x-post/>
				<x-post/>
			</div>
		</div>
	</div>
</main>
@endsection