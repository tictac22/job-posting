@extends('layouts.app')
@section("title","Registration")
@section('content')
<main class="flex-grow flex flex-col justify-center">
	<div>
		<div class="container">
			<div class="flex justify-center">
				<div class="w-[640px]">
					<div class="bg-white p-10">
						<div class="text-center">
							<h1 class="text-xl">Register</h1>
							<p class="text-sm">Register an account to post jobs</p>
	
						</div>
						<div class="mt-5">
							<form class="form">
								<div class="relative">
									<input id="name" type="text" class="w-full mt-4 peer placeholder-transparent field" name="name" placeholder="Name">                               
									<label for="name" class="absolute left-0 -top-3.5 input-label">Name</label>
									<p class="mt-1 text-xs text-red-500 hidden"></p>
								</div>
								<div class="relative mt-5">
									<input id="lastname" type="text" class="w-full mt-4 peer placeholder-transparent field" name="lastname" placeholder="Lastname">                               
									<label for="lastname" class="absolute left-0 -top-3.5 input-label">Lastname</label>
									<p class="mt-1 text-xs text-red-500 hidden"></p>
								</div>
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
								<div class="relative mt-5">
									<input id="password_confirmation" type="password" class="w-full mt-4 peer placeholder-transparent field" autocomplete="new-password" name="password_confirmation" placeholder="Confirm password">                               
									<label for="password_confirmation" class="absolute left-0 -top-3.5 input-label">Confirm password</label>
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
							<p>Already have an account?</p>
							<a href="/login" class="text-blue-300 underline cursor-pointer ml-3">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@section('scripts')
	@vite('resources/js/register.js')
@endsection