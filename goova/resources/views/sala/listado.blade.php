@foreach($listado as $key=> $value)

  	<span class="list-group-item " id="list-search" data-name="{{$value->name}} {{$value->last_name}}">



	  	<div class="custom-control custom-checkbox">

		    <input type="checkbox" class="custom-control-input" id="defaultUnchecked_{{$key}}" disabled="" @if(!empty($value->enlista)) checked @endif>

		    <label class="custom-control-label" for="defaultUnchecked_{{$key}}" >{{$value->name}} {{$value->last_name}}</label>

		</div>

	</span>

@endforeach