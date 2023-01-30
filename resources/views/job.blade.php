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
<main class="flex-grow flex flex-col justify-center">
	@if($creator)
	<div class="flex justify-end ml-auto mr-0 mb-4">
		<div class="container">
			<p>Last update at {{$post->updated_at_parse }}</p>
			<a class="text-gray-400 hover:underline cursor-pointer" href="/edit/{{$post->id}}">Edit post</a>
		</div>
	</div>
	@endif
	<div class="flex items-center bg-white py-4 text-center">
		<div class="container">
			<div class="w-48 m-auto">
				<img class="w-full" src="{{$post->logo}}" alt="{{$post->company_name}}"/>
			</div>
			<div class="md:flex-grow md:flex-shrink md:flex-[66%] flex flex-col">
				<h1 href="job/3" class="font-bold hover:underline mt-5">{{$post->job_title}}</h1>
				<h3 class="font-bold mt-1">{{$post->company_name}}</h3>
				<ul class="mt-3">
					@foreach ($post->tags as $tag)
						<li class="text-white bg-black p-2 inline-block lowercase rounded-lg">
							{{$tag}}
						</li>
					@endforeach
				</ul>
				<div class="flex m-auto items-center mt-3">
					<i class="fa-sharp fa-solid fa-location-pin"></i>
					<p class="ml-1">{{$post->location}}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-white text-center mt-5 p-3">
		<div class="container">
			<h2 class="text-4xl font-bold">Job Description</h2>
			<p class="m-auto mt-15 leading-6 mt-4">{{$post->description}}</p>
			<button class="bg-[#62d0df] hover:bg-[#57b7c3] w-full p-2 rounded-lg mt-5 cursor-pointer transition-colors text-white">
				<i class="fa-solid fa-file"></i>
				<span>Apply</span>
			</button>
			<button class="bg-black hover:bg-[#434040] w-full p-2 rounded-lg mt-2 cursor-pointer transition-colors text-white">
				<i class="fa-sharp fa-solid fa-globe"></i>
				<span>Visit website</span>
			</button>
		</div>
	</div>
</main>
@endsection
