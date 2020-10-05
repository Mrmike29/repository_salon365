<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

    	<meta name="csrf-token" content="{{ csrf_token() }}">

    	<style type="text/css">

    		span.list-group-item{

    			cursor: pointer;

    		}

    	</style>

        @include('includes.head')

        <!-- Checkbox code -->

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- Google Fonts -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <!-- Bootstrap core CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap tooltips -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    </head>

    @if($tipo=="Profesor")

		<!-- <div id="listado" style="

		    position: absolute;

		    right: 0;

		    width: 30px;

		    height: 30px;

		    font-size: 50px;

		    top: 0px;

		    border: 2px solid gainsboro;

		    border-right: 0;

		    background: #f9efef;

		    cursor: pointer;

		"></div> -->

		<div id="estudiantes" class="sidebar-colors" style="max-height: 100%;height: 100%;padding: 0;top:0">

		  <div class="toggle"></div>

		  <div class="list-group">

		  	<a href="#" class="list-group-item active">

		  	  Listado de asistencia

		  	</a>

		  	<span class="list-group-item">

		  		<div class="input-group mb-3">

  

			    <input type="text"  id="nameSearch" class="form-control form-control-sm">

			  <div class="input-group-append">

			    <span class="input-group-text"><i class="fa fa-search"></i></span>

			  </div>

			</div>

			</span>

		  	@foreach($listado as $key=> $value)

			  	<span class="list-group-item " id="list-search" data-name="{{$value->name}} {{$value->last_name}}">



				  	<div class="custom-control custom-checkbox">

					    <input type="checkbox" class="custom-control-input" id="defaultUnchecked_{{$key}}" value="{{encrypt($value->id."_str4t3cs4")}}" data-room="{{encrypt($room->id."_str4t3cs4")}}" @if(!empty($value->enlista)) checked @endif>

					    <label class="custom-control-label" for="defaultUnchecked_{{$key}}" >{{$value->name}} {{$value->last_name}}</label>

					</div>

				</span>

			@endforeach

		</div>



		</div>

	@endif

    <body class="admin">

        <iframe SameSite=lax src="https://pruebas.medicalcare.com.co/pages/r.html?room={{$room->code}}@if($tipo=="Administrador" || $tipo=="Profesor" ){{'&isAdmin=1'}}@endif&id={{md5(Auth::user()->id."_str4t3cs4")}}" allow="camera;microphone;autoplay" style="width: 100%;max-height: 100%;min-height: 100vh;  height: 100%;" SameSite="none" secure></iframe>

 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   

 	<script src="{{asset('js/goova-template.js')}}"></script>

 	<script type="text/javascript">

 		$(document).ready(function(){

 			$('.fa-microphone-slash').click(function(){

 			})

 			$.ajaxSetup({

			    headers: {

			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			    }

			});

 			$('#listado').click(function(){

 				if($('#estudiantes').css('display')=="none"){

 					$('#listado').css('right','30%').css('transition-delay','0.5s')

 				}else{

 					$('#listado').css('right','0').css('transition-delay','0s')

 				}

 				$('#estudiantes').toggle('slow')

 			})

 			$('.custom-control').click(function(){

 				var room=$(this).find('input').attr('data-room');

 				var id=$(this).find('input').val();

 				var status=true

 				if ($(this).find('input').is(':checked')) {

	 				$(this).find('input').prop('checked',false)

					status=false

	 			}else{

	 				$(this).find('input').prop('checked',true)

					status=true

	 			}

	 			$.ajax({

 					url:'/saveAssist',

 					type:'POST',

 					data:{id:id,room:room,status:status}

 				})

 			})

 			$('#nameSearch').keyup(function(){

 				var search=$(this).val().toLowerCase()

 				$('[id^=list-search]').each(function(){

 					var name=$(this).attr('data-name').toLowerCase().indexOf(search)

 					if (name<0) {

 						$(this).hide()

 					}else{

 						$(this).show()	

 					}

 				})

 			})
 			setTimeout(function(){
 				console.log(localStorage.getItem('prd'))
 			},10000)

 		})

 	</script>

    </body>

</html>

