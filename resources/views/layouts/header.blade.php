<header>
	<div class="container">
		<div class="flex flex-col sm:flex-row sm:justify-between items-center py-5 ">
			<div>
				<a href="/">
					<img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo">
				</a>
			</div>
			@guest
				<div class="flex items-center mt-2 sm:mt-0">
					<a href="/register" class="flex items-center flex-col group">
						<i class="fa-solid fa-user-plus"></i>
						<p class="group-hover:underline">Sign up</p>
					</a>
					<a href="/login" class="flex items-center flex-col ml-3 group">
						<i class="fa-solid fa-right-to-bracket"></i>
						<p class="group-hover:underline">Login</p>
					</a>
				</div>
			@endguest
			@auth
				<div class="flex items-center mt-2 sm:mt-0 flex-col sm:flex-row">
					<p class="overflow-hidden whitespace-nowrap text-ellipsis max-w-[280px]">WELCOME {{Auth::user()->name}} {{Auth::user()->lastname}}</p>
					<a href="/manage" class="flex items-center ml-3 hover:underline">
						<i class="fa-solid fa-gear mr-2"></i>
						<p>Manage listings</p>
					</a>
					<button aria-label="logout" class="flex items-center ml-3 hover:underline cursor-pointer logout">
						<i class="fa-solid fa-door-closed mr-2"></i>
						<p>Logout</p>
					</button>
				</div>
			@endauth
		</div>
	</div>
</header>