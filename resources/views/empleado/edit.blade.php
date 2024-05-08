@extends('layouts.app')
@section('content')
<div class="container">
<form action=" {{ URL ('/empleado/'.$empleado->id)}}" method="post" enctype="multipart/form-data">
@csrf 
{{ method_field('PATCH') }}

@include('empleado.form',['modo'=>'Editar']);
</form>
</div>
@endsection