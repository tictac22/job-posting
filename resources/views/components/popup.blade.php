<div class="opacity-0 invisible pointer-events-none transition-opacity fixed z-20 inset-0 flex items-center justify-center text-center popup">
	<div class="w-full absolute h-full opacity-40 bg-black popup__close"></div>
		<div class="container">
		<div class="bg-white p-3 relative z-30 rounded shadow-xl">
			<h3>{{$title}}</h3>
			<p class="my-2">Are you sure that you want to delete <span class="font-bold">{{$title}}</span>?</p>
			<div class="flex items-center justify-center mt-3 md:justify-end">
				<button aria-label="close popup" class="px-4 py-2 w-24 bg-blue-400 rounded text-white popup__close">No</button>
				<button data-value="{{$id}}" aria-label="confirm" class="px-4 py-2 w-24 bg-red-400 rounded text-white ml-3 popup__confirm flex items-center justify-center">
					<span class="button-text">Yes</span><x-spinner/>
				</button>
			</div>
		</div>
	</div>
</div>