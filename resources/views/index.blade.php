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
				@foreach ($posts as $post)
					<div class="flex items-center bg-white mt-5 p-4">
						<div class="w-48 hidden md:block">
							<img class="w-full" src="{{$post->logo}}" alt="{{$post->company_name}}"/>
						</div>
						<div class="md:ml-5 md:flex-grow md:flex-shrink md:flex-[66%] flex flex-col">
							<a href="job/{{$post->id}}" class="font-bold hover:underline">{{$post->job_title}}</a>
							<h3 class="font-bold mt-1">{{$post->company_name}}</h3>
							<ul class="mt-1">
								@foreach ($post->tags as $tag)
									<li class="text-white bg-black p-2 inline-block lowercase rounded-lg">
										<a href="?tag={{$tag}}">{{$tag}}</a>
									</li>
								@endforeach
								
								<p class="text-gray-400 text-xs mt-1">Click on tag search to search on it</p>
							</ul>
							<div class="flex items-center mt-1">
								<i class="fa-sharp fa-solid fa-location-pin"></i>
								<p class="ml-1">{{$post->location}}</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</main>
@endsection