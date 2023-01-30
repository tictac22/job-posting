@extends('layouts.app')
@section("title","Create")

@section('metatags')
<x-head 
	description="Create post form"
	title="Create"
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
							<h1 class="text-xl">Create</h1>
							<p class="text-sm">Create a post to find a developer</p>
						</div>
							<form class="form">
								<div class="relative mt-5">
									<input id="company_name" type="text" class="w-full mt-4 peer placeholder-transparent field" name="company_name" placeholder="Company name">                               
									<label for="company_name" class="absolute left-0 -top-3.5 input-label">Company name</label>
									<p class="mt-1 text-xs text-red-500 hidden"></p>	
								</div>
								<div class="relative mt-5">
									<input id="job_title" type="text" class="w-full mt-4 peer placeholder-transparent field"  name="job_title" placeholder="Job title">                               
									<label for="password" class="absolute left-0 -top-3.5 input-label">Job title</label>	
									<p class="mt-1 text-xs text-red-500 hidden"></p>
								</div>
								<div class="relative mt-5">
									<input id="location" type="text" class="w-full mt-4 peer placeholder-transparent field"  name="location" placeholder="Job location">                               
									<label for="password" class="absolute left-0 -top-3.5 input-label">Job location</label>	
									<p class="mt-1 text-xs text-red-500 hidden"></p>
								</div>
								<div class="relative mt-5">
									<input id="tags" type="text" class="w-full mt-4 peer placeholder-transparent field"  name="tags" placeholder="Tags(Comma Separated)">                               
									<label for="password" class="absolute left-0 -top-3.5 input-label">Tags(Comma Separated)</label>	
									<p class="mt-1 text-xs text-red-500 hidden"></p>
								</div>
								<div class="relative mt-5">
									<input id="logo" type="file" accept="image/png, image/jpeg, image/jpg"  name="logo"  class="border border-solid py-2 px-3 focus:border-[#2563eb] border-[#6b7280] w-full mt-4 peer placeholder-transparent field" placeholder="Company logo"></input>
									<label for="logo" class="absolute left-0 -top-3.5 input-label">Company logo</label>
									<p class="mt-1 text-xs text-red-500 hidden"></p>
								</div>
								<div class="relative mt-5">
									<textarea id="description" name="description" maxlength="255"  class="resize-none min-h-[175px] w-full mt-4 peer placeholder-transparent field" placeholder="Job description"></textarea>
									<label for="description" class="absolute left-0 -top-3.5 input-label">Job description</label>
									<p class="mt-1 text-xs text-red-500 hidden"></p>
									<span data-attr="hint" class="absolute right-6 bottom-3 text-[10px]">255 characters left</span>
								</div>
								<div class="mt-5">
									<div class="mt-2 col-md-offset-4">
										<x-btn>Post</x-btn>
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
	@vite('resources/js/create.js')
@endsection