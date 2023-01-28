@extends('layouts.app')
@section("title","Registration")
@section('content')
<div>
	<div class="container">
		<div class="flex justify-center">
			<div class="w-[640px]">
				<div class="bg-white p-10">
					<div class="text-center">
						<h1 class="text-xl">Login</h1>
						<p class="text-sm">Log in your account to post jobs</p>
					</div>
					<div class="mt-5">
						<form class="form">
							<div class="relative mt-5">
								<input id="email" type="text" autocomplete="email" class="w-full mt-4 peer placeholder-transparent field" name="email" placeholder="email">                               
								<label for="email" class="absolute left-0 -top-3.5 input-label">Email</label>
								<p class="mt-1 text-xs text-red-500 hidden"></p>	
							</div>
							<div class="relative mt-5">
								<input id="password" type="password" class="w-full mt-4 peer placeholder-transparent field" autocomplete="new-password" name="password" placeholder="password">                               
								<label for="password" class="absolute left-0 -top-3.5 input-label">Password</label>	
								<p class="mt-1 text-xs text-red-500 hidden"></p>
							</div>
							<div class="mt-5">
								<div class="mt-2 col-md-offset-4">
									<x-btn/>
								</div>
							</div>
						</form>
					</div>
					<div class="flex items-center mt-2">
						<p>Don't have an account?</p>
						<a href="/register" class="text-blue-300 underline cursor-pointer ml-3">Register</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection

@section('scripts')
	@vite('resources/js/login.js')
@endsection