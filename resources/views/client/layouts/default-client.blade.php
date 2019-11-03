<!DOCTYPE html>
<html class="no-js" lang="en">
	@include('client.includes.head')

	<body class="shop">
        @include('client.includes.header')
		
		@yield('content')

		@include('client.includes.footer')
	</body>
</html>
