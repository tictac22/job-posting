<header>
	<div class="container">
		<div class="flex flex-col sm:flex-row sm:justify-between items-center py-5 ">
			<div>
				<a href="/">
					<img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo">
				</a>
			</div>
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
			<!-- <div class="flex items-center mt-2 sm:mt-0 flex-col sm:flex-row">
				<p class="overflow-hidden whitespace-nowrap text-ellipsis w-full max-w-[280px]">WELCOME TICTAC2CC2222222222222222222222222222222</p>
				<a href="/manage" class="flex items-center ml-3">
					<i class="fa-solid fa-gear mr-2"></i>
					<p>Manage listings</p>
				</a>
				<div class="flex items-center ml-3">
					<i class="fa-solid fa-door-closed mr-2"></i>
					<p>Logout</p>
				</div>
			</div> -->
		</div>
	</div>
</header>