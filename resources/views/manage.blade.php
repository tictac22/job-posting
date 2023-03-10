@extends('layouts.app')
@section("title","Manage")

@section('metatags')
<x-head 
	description="All your posts"
	title="Manage all posts"
	image="{{url('/'). '/assets/seo-images/index.png'}}"
	imageAlt='Find or post job here'
/>
@endsection

@section('content')
<main class="flex-1">
	<div class="container">
		<h1 class="text-3xl font-bold">Manage jobs</h1>
		<a href="/create" class="text-purple-700 hover:underline inline-block mt-2 text-xl">Create new one</a>
		<div class="mt-4">
			@forelse($posts as $post)
			<div class="parent items-start  flex-col sm:flex-row flex sm:items-center border-t border-solid border-gray-500 py-4 justify-between gap-4">
				<x-popup :title="$post->job_title" :id="$post->id" />
				<a href="/job/{{$post->id}}" class="text-left underline sm:overflow-hidden sm:whitespace-nowrap sm:text-ellipsis sm:max-w-[80%]">{{$post->job_title}}</a>
					<div class="flex items-center sm:ml-4">
						<a href="/edit/{{$post->id}}" class="text-cyan-500 hover:underline cursor-pointer flex items-center">
							<span class="mr-3">Edit</span>
							<i class="fa-solid fa-pen-to-square"></i>
						</a>
						<div class="popup__delete text-red-500 flex items-center cursor-pointer hover:underline ml-5">
							<span class="mr-3">Delete</span>
							<i class="fa-sharp fa-solid fa-trash"></i>
						</div>
					</div>
				</div>
			@empty
				<p class="font-bold text-lg">You have zero posts</p>
				<span>
					Go to <a href="/create" class="text-purple-500 hover:underline">create page</a> to post new one
				</span>
			@endforelse
		</div>
	</div>
</main>


@endsection
@section('scripts')
	@vite('resources/js/manage.js')
@endsection