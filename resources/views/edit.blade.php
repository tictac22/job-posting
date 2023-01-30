@extends('layouts.app')
@section("title","BlueCollar")


@section('metatags')
<x-head 
	description="Edit post form"
	title="BlueCollar"
	image="{{url('/'). '/assets/seo-images/index.png'}}"
	imageAlt="Find or post job here"
/>
@endsection

@section('content')
<main class="flex-grow flex flex-col justify-center">
	<div>
		<div class="container">
			<div class="flex justify-center">
				<div class="w-[640px]">
					<div class="bg-white p-10 my-5">
						<div class="text-center">
							<h1 class="text-xl">Edit</h1>
							<p class="text-sm">{{ $post->job_title}}</p>
						</div>
						<form class="form">
							<div class="relative mt-5">
								<input id="company_name" value="{{ $post->company_name}}" type="text" class="w-full mt-4 peer placeholder-transparent field" name="company_name" placeholder="Company name">                               
								<label for="company_name" class="absolute left-0 -top-3.5 input-label">Company name</label>
								<p class="mt-1 text-xs text-red-500 hidden"></p>	
							</div>
							<div class="relative mt-5">
								<input id="job_title" value="{{$post->job_title}}" type="text" class="w-full mt-4 peer placeholder-transparent field"  name="job_title" placeholder="Job title">                               
								<label for="password" class="absolute left-0 -top-3.5 input-label">Job title</label>	
								<p class="mt-1 text-xs text-red-500 hidden"></p>
							</div>
							<div class="relative mt-5">
								<input id="location" value="{{$post->location}}" type="text" class="w-full mt-4 peer placeholder-transparent field"  name="location" placeholder="Job location">                               
								<label for="password" class="absolute left-0 -top-3.5 input-label">Job location</label>	
								<p class="mt-1 text-xs text-red-500 hidden"></p>
							</div>
							<div class="relative mt-5">
								<input id="tags" type="text" value="{{$post->tags}}"  class="w-full mt-4 peer placeholder-transparent field"  name="tags" placeholder="Tags(Comma Separated)">                               
								<label for="password" class="absolute left-0 -top-3.5 input-label">Tags(Comma Separated)</label>	
								<p class="mt-1 text-xs text-red-500 hidden"></p>
							</div>
							<div class="relative mt-8">
								<input  data-value="{{$post->logo}}" id="logo" type="file" accept="image/png, image/jpeg, image/jpg"  name="logo"  class="hidden border border-solid py-2 px-3 focus:border-[#2563eb] border-[#6b7280] w-full mt-4 peer placeholder-transparent field" placeholder="Company logo"></input>
								<label id="logoLabel" for="logo" tabindex="0" class=" focus-visible:outline-indigo-500 absolute left-0 -top-3.5 input-label p-3  rounded bg-amber-500 text-white hover:bg-amber-600 transition-colors cursor-pointer">Select another logo</label>
								<p class="mt-1 text-xs text-red-500 hidden"></p>
							</div>
							<div class="reltaive mt-20  flex items-center justify-center">
								<img id="imagePreview"class="w-60 h-60 object-cover"  src="{{$post->logo}}" alt="preview of image" />
							</div>
							<div class="relative mt-5">
								<textarea id="description" name="description" maxlength="255"  class="resize-none min-h-[175px] w-full mt-4 peer placeholder-transparent field" placeholder="Job description">{{$post->description}}</textarea>
								<label for="description" class="absolute left-0 -top-3.5 input-label">Job description</label>
								<p class="mt-1 text-xs text-red-500 hidden"></p>
								<span data-attr="hint" class="absolute right-6 bottom-3 text-[10px]">255 characters left</span>
							</div>
							<div class="mt-5">
								<div class="mt-2 col-md-offset-4">
									<x-btn>Edit</x-btn>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
		</div>	
	</div>
</main>
@endsection

@section('scripts')
	@vite('resources/js/edit.js')
@endsection