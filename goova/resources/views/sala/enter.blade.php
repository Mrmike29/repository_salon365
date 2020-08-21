<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body class="admin">
        <iframe src="https://pruebas.medicalcare.com.co/pages/r.html?room={{$room->code}}@if($tipo=="Administrador" || $tipo=="Profesor" )&isAdmin=1 @endif" allow="camera;microphone;autoplay" style="width: 100%;max-height: 100%;min-height: 100vh;  height: 100%;" SameSite="none" secure></iframe>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
 	<script type="text/javascript">
 		$(document).ready(function(){
 			$('.fa-microphone-slash').click(function(){
 			})
 		})
 	</script>
    </body>
</html>
