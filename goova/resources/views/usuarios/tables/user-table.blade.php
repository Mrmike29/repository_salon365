@foreach ($usuarios as $key => $val)
    <tr id="data-search" data-rol="{{$val->rol}}" data-tipo="{{$val->type_document}}" data-nombre="{{$val->name}}" data-email="{{$val->email}}" data-doc="{{$val->document}}">
        <td>{{$val->type_document}}</td>
        <td>{{$val->document}}</td>
        <td>{{$val->name}} {{$val->last_name}}</td>
        <td>{{$val->email}}</td>
        <td>{{$val->rol}}</td>
        {{-- <td>{{$val->state}}</td> --}}
        <td>{{$val->phone}}</td>
        <td>{{$val->address}}</td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                    Seleccionar
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/editar_usuario/{{$val->id}}">Editar</a>
                    {{-- @if($val->state == "HABILITADO")
                        <a class="dropdown-item inhabilitar_user" data-id="{{$val->id}}" data-toggle="modal" data-target="#inhabilitarUserModal" href="#">Inhabilitar</a>
                    @else
                        <a class="dropdown-item habilitar_user" data-id="{{$val->id}}" data-toggle="modal" data-target="#habilitarUserModal" href="#">Habilitar</a>
                    @endif --}}
                </div>
            </div>
        </td>
    </tr>
@endforeach