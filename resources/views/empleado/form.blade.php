<h1> {{ $modo }}  Empleados  </h1>
@if(count($errors)>0)
     <div class="alert alert-danger" role="alert" >
      <ul>  
        @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
       </ul> 
     </div>
     
@endif
<hgroup class="form-group" >
<label for="Nombre"> Nombre </label>
<input class="form-control" type="text" name="Nombre" id="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre') }}" placeholder="Nombre">
</hgroup>



<hgroup class="form-group"> 
<label for="ApellidoPaterno"> Apellido Paterno</label>
<input class="form-control" type="text" name="ApellidoPaterno" id="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}" placeholder="ApellidoPaterno">
</hgroup>



<hgroup class="form-group">
<label for="ApellidoMaterno"> Apellido Materno</label>
<input class="form-control" type="text" name="ApellidoMaterno" id="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno )?$empleado->ApellidoMaterno:old('ApellidoMaterno') }}"  placeholder="ApellidoMaterno">
</hgroup>



<hgroup class="form-group">
<label for="Correo"> Correo </label>
<input class="form-control" type="text" name="Correo" id="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" placeholder="Correo">
</hgroup>



<hgroup class="form-group">
<label for="Foto"></label>
@if(isset($empleado->Foto))
  <!-- {{ $empleado->Foto }}   Permite ver la foto -->
<img  class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto}}" width="60" alt="Foto Empleado">
@endif
<input class="form-control" type="file" name="Foto" id="Foto" value=" " placeholder="Foto">
</hgroup>

<br/>

<input type="submit" class="btn btn-success" value="{{$modo}} Datos">
<br/>
<a href="{{ url('empleado/') }}" class="btn btn-dark ">Volver</a>
