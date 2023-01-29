<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>404</title>
		@vite(['resources/css/app.css','resources/css/fontawesome.min.css', 'resources/css/solid.min.css'])
	</head>
	<body class="antialiased bg-[#f4f9e2] font-mono">
		<div class="flex min-h-screen flex-col relative">
			<main class="flex-grow flex flex-col justify-center">
				<div class="container">
					<div class="text-center">
						<p class="text-lg">Something went wrong</p>
						<h1 class="text-3xl font-bold">Such page doesn't exists</h1>
						<a href="/" class="hover:underline mt-7 text-3xl block text-purple-500">Return to home page</a>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>