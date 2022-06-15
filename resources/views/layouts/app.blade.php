<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Livewire Dummy App</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<livewire:styles />
	@yield('css')
</head>
<body>
	@yield('content')

	<livewire:scripts />

	@yield('js')
</body>
</html>