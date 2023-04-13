<!DOCTYPE html>
<html>
<head>
	<title>Laravel Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/style.css') }}">
	@yield('css')
</head>
<body>
	<div class="admin-wrapper">
		@include('admin.partials.sidebar')
		@yield('content')
	</div>
</body>
</html>