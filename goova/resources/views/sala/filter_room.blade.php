@foreach ($room as $key => $val)
    @if(date('Y-m-d') <= date('Y-m-d',strtotime($val->fecha)))
        <tr>
            @if($tipo!="Administrador" && $tipo!="Profesor")
                <td>{{$val->nombre}} {{$val->apellido}}</td>
            @endif
            <td>{{$val->listado}}</td>
            <td>{{$val->fecha}}</td>
            <td>{{$val->asignatura}}</td>
            <td>{{$val->materia}}</td>
            <td>{{$val->status}}</td>
            <td>
                
                <div class="dropdown">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        Seleccionar
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if($val->status == "HABILITADO")
                            <a href="/ingresar/sala/{{encrypt($val->id)}}" target="_blank" class="dropdown-item">Ingresar</button>
                        @endif
                        @if($tipo=="Administrador" || $tipo=="Profesor")
                            <a href="/editar/sala/{{encrypt($val->id)}}" class="dropdown-item">Editar</button>
                            @if($val->status == "HABILITADO")
                                <a class="dropdown-item inhabilitar_sala" data-id="{{encrypt($val->id)}}" data-toggle="modal" data-target="#inhabilitarSalaModal" href="#">Inhabilitar</a>
                            @else
                                <a class="dropdown-item habilitar_sala" data-id="{{encrypt($val->id)}}" data-toggle="modal" data-target="#habilitarSalaModal" href="#">Habilitar</a>
                            @endif
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    @endif
@endforeach