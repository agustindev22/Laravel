@extends('layouts.app')
@section('content')
<div class="container">
    <div class="alert alert-info " role="alert">
        @if(Session::has('mensaje'))
        {{
        Session::get('mensaje')
        }}
        @endif
    
    </div>

    <a href="{{ url('empleado/create') }}" class="btn btn-dark">Registrar Nuevo Empleado</a>
    <br /><br />
    <table class="table table-secondary">
        <thead class="table tabl-secondary">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Correo</th>
                <th scope="col">Foto</th>
                <th scope="col">Acciones</th>

            </tr>
        </thead>

        <tbody>
            @foreach($empleados as $empleado)
            <tr class="">
                <td>{{$empleado->id}}</td>

                <td>{{$empleado->Nombre}}</td>

                <td>{{$empleado->ApellidoPaterno}}</td>

                <td>{{$empleado->ApellidoMaterno}}</td>

                <td>{{$empleado->Correo}}</td>

                <td> <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto}}" width="60" alt="Foto Empleado"></td>

                <td>
                    <a href="{{ url ('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-success"> Editar</a>

                    <form action="{{url('/empleado/'.$empleado->id )}}" method="post" class="d-inline ">
                        @csrf
                        {{ method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('¿Deseas Eliminar?')" value="Eliminar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
      {!! $empleados->links()!!}
</div>
@endsection