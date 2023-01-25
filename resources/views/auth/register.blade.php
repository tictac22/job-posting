@extends('layouts.app')
@section("title","Registration")
@section('content')
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
						<form class="form" method="POST">
							@csrf
							<div class="relative">
								<input id="name" type="text" class="w-full mt-4 peer placeholder-transparent" name="name" placeholder="Name">                               
								<label for="name" class="absolute left-0 -top-3.5 input-label">Name</label>	
							</div>
							<div class="relative mt-5">
								<input id="email" type="text" autocomplete="email" class="w-full mt-4 peer placeholder-transparent" name="email" placeholder="email">                               
								<label for="email" class="absolute left-0 -top-3.5 input-label">Email</label>	
							</div>
							<div class="relative mt-5">
								<input id="password" type="password" class="w-full mt-4 peer placeholder-transparent" autocomplete="new-password" name="password" placeholder="password">                               
								<label for="password" class="absolute left-0 -top-3.5 input-label">Password</label>	
							</div>
							<div class="relative mt-5">
								<input id="password-confirm" type="password" class="w-full mt-4 peer placeholder-transparent" autocomplete="new-password" name="password-confirm" placeholder="Confirm password">                               
								<label for="password-confirm" class="absolute left-0 -top-3.5 input-label">Confirm password</label>	
							</div>
	
							<div class="mt-5">
								<div class="mt-2 col-md-offset-4">
									<button type="submit" class="bg-amber-500 w-full text-center p-4 text-white hover:bg-amber-600 transition-colors duration-300 ease-in">
										Register
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection

@section('scripts')
	@vite('resources/js/register.js')
@endsection