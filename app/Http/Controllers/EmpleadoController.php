<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //Una forma de darle la informacion a las vistas 
         $datos['empleados']=Empleado::paginate(1);
         return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Una forma de darle la informacion a las vistas 
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        $campos=[
            // para que pongas los datos requeridos sino saldra un mensaje para que los pongas
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|mimes:jpe,png,jpg', //para la foto
        ]; 
         // para que pongas los datos requeridos sino saldra un mensaje para que los pongas
        $mensaje=[
               'required'=>'El :attribute es requerido',
               'Foto.required'=>'La Foto es Requerida'
        ];
         
        $this->validate($request,$campos,$mensaje); 

        //obtiene toda infromacion que le mandamos y va a responder en un fromato json toda la informacion del formulario
       $datosEmpleado = request()->except('_token'); //agarra toda la informacion ecepto el token,saca el token no te la agrega
       
       if($request->hasFile('Foto')){ //sirve para que aparezca la iafgen en la base de datos, tambien en aparrace en la caerpeta uploads 
          $datosEmpleado['Foto']=$request->file('Foto')-> store('uploads','public');}       
 

       Empleado::insert($datosEmpleado);//aca agrega toda la informacion
         
       return redirect ('empleado')->with('mensaje','Empleado Agregado Exitosamente 🎉');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //PERMITE EDITAR LOS REGISTROS
        $empleado=Empleado::findOrFail($id); //BUSCA LA INFROMACION POR EL ID 
        return view('empleado.edit', compact('empleado'));//retornamos a empleados
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $id)
    {
          
        $campos=[
            // para que pongas los datos requeridos sino saldra un mensaje para que los pongas
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
           
        ]; 
         // para que pongas los datos requeridos sino saldra un mensaje para que los pongas
        $mensaje=[
               'required'=>'El :attribute es requerido',
               
        ];
        if($request->hasFile('Foto')){
            // aca no es necesario que adjunte la foto nuevamente
            $campos=[ 'Foto'=>'required|mimes:jpe,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es Requerida']; //para la foto
        }
        $this->validate($request,$campos,$mensaje); 

        //PARA QUE ACTUALICE LA INFORMACION
        $datosEmpleado = request()->except(['_token','_method']);
         
       if($request->hasFile('Foto')){ //sirve para que aparezca la iafgen en la base de datos, tambien en aparrace en la caerpeta uploads 
        $empleado=Empleado::findOrFail($id);
        Storage::delete('public/'.$empleado->Foto);
        $datosEmpleado['Foto']=$request->file('Foto')-> store('uploads','public');}       

        
        Empleado::where('id', '=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id); //BUSCA LA INFROMACION POR EL ID 
       // return view('empleado.edit', compact('empleado'));
       return redirect('empleado')->with('mensaje','El Registro Fue Editado Correctamente ✔');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {     
        //PARA BORRAR LAS FOTOS DE STORAGE
        $empleado=Empleado::findOrFail($id);

        if(Storage::delete('public/'.$empleado->Foto)){

            //PERMITE ELIMINAR LOS REGISTROS
            Empleado::destroy($id);
               
        };

        return redirect('empleado')->with('mensaje','El Registro Fue Eliminado Correctamente ✔');
    }
}
