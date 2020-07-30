<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">

		<div class="main-wrapper" style="min-height: 600px">
    		<!-- Sidebar  -->
    		@include('includes.sidebar')
			


    	</div>

    	@include('includes.footer')
    </body>
</html>
