<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use App\Models\UserCategoria;
use App\Models\Noticia;
use App\Models\Material;
use App\Models\Entrenamiento;
use App\Models\Horario;
use App\Models\Competicion;
use App\Models\CompeticionCategoria;
use App\Models\Tiempo;
use App\Models\Minima;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DateTime;

class AltasController extends Controller{

    //GUARDAR LA NOTICIA EN LA BASE DE DATOS
    public function altaNoticia(Request $request){
        //validación
        $request->validate([
            'titulo' => 'required|string|unique:noticias|min:3|max:100',
            'texto' =>'required|string|min:10|max:500',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,JPG|max:2048'
    
        ],[
            'titulo.required' => 'El titulo es obligatorio',
            'titulo.unique' => 'El titulo de la noticia ya está registrado',
            'titulo.min' => 'El titulo tiene que tener al menos 3 letras',
            'titulo.max' => 'El titulo tiene que tener un maximo de 100 letras',
            'texto.required' => 'El contenido de la noticia es obligatoria',
            'texto.min' => 'El texto tiene que tener al menos 10 letras',
            'texto.max' => 'El texto tiene que tener un maximo de 500 letras',
            'imagen.required' => 'La foto de la noticia es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
    
        ]);
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $nombreImagen = $nombreImagen;
        } else {
            $nombreImagen = 'noticia.jpg';
        }
    
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo; 
        $noticia->texto = $request->texto;
        $noticia->imagen = $nombreImagen;
    
        $noticia->save();
    
        return redirect()->route('administrador')->with('success', 'La noticia se ha insertado correctamente.');
    
    }
    public function mostrarNoticias(){
        $noticias = Noticia::all();
        return view('index', compact('noticias'));
    }
    public function mostrarNoticiasEliminar(){
        $noticias = Noticia::all();
        return view('eliminarNoticias', compact('noticias'));
    }

    public function eliminarNoticia($id){
        $noticia = Noticia::find($id);
        $noticia->delete();
        return redirect()->route('eliminarNoticias')->with('success','La noticia ha sido eliminada');
    }

    public function datosNoticias($id){
        $noticia = Noticia::find($id);
        return view('editarNoticia',['noticia' => $noticia]);
    }

    public function actualizarNoticia(Request $request, $id){
        $request->validate([
            'titulo' => [
                'required','string','min:3','max:100',Rule::unique('noticias')->ignore($id)
            ],
            'texto' => [
                'required',
                'string',
                'min:10',
                'max:500'
            ],
            'imagen' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ]
    
        ],[
            'titulo.required' => 'El titulo es obligatorio',
            'titulo.unique' => 'El titulo ya está en uso',
            'titulo.min' => 'El titulo tiene que tener al menos 3 letras',
            'titulo.max' => 'El titulo tiene que tener un maximo de 100 letras',
            'texto.required' => 'El contenido de la imagen es obligatoria',
            'texto.min' => 'El texto tiene que tener al menos 10 letras',
            'texto.max' => 'El texto tiene que tener un maximo de 500 letras',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
    
        ]);
    
        //buscamos la noticia
        $noticia = Noticia::find($id);
    
        //Si la imagen es proporcionada, la procesamos
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $noticia->imagen = $nombreImagen;
        }
    
        //Actualizamos la noticia
        $noticia->titulo = $request->titulo;
        $noticia->texto = $request->texto;
    
        $noticia->save();
    
        return redirect()->route('eliminarNoticias')->with('successNoticia', 'La noticia se ha actualizado.');
    }
    


    //MATERIALES
    public function altaMaterial(Request $request){

        $request->validate([
            'nombre' => 'required|string|unique:materiales|min:3|max:500',
            'marca' =>'required|string|max:100',
            'enlace' => 'required|string|max:500',
            'precio' => 'required|numeric',
            'tipo' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    
        ],[
            'nombre.required' => 'El nombre del material es obligatorio',
            'nombre.unique' => 'El nombre del materual ya está registrado',
            'nombre.min' => 'El nombre tiene que tener al menos 3 letras',
            'nombre.max' => 'El nombre tiene que tener un maximo de 100 letras',
            'marca.required' => 'La marca del material es obligatoria',
            'marca.max' => 'La marca tiene que tener un maximo 100 letras',
            'enlace.required' => 'El enlace a la página oficial es obligatorio',
            'enlace.max' => 'El enlace a la pagina oficial tiene que tener un maximo de 500 letras',
            'precio.required' => 'El precio del material es obligatorio',
            'precio.numeric' => 'El precio debe ser un valor numérico',
            'tipo.required' => 'El tipo de material es obligatorio',
            'imagen.required' => 'La foto del material es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
    
        ]);
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $nombreImagen = $nombreImagen;
        } else {
            $nombreImagen = 'materiales.jpg';
        }
    
        $material = new material();
        $material->nombre = $request->nombre; 
        $material->marca = $request->marca;
        $material->enlace = $request->enlace;
        $material->precio = $request->precio;
        $material->tipo = $request->tipo;
        $material->imagen = $nombreImagen;
    
        $material->save();
    
        return redirect()->route('administrador')->with('success', 'El material se ha insertado correctamente.');
    
    }

    public function mostrarMateriales(){
        $materiales = Material::orderBy('precio', 'desc')->get();
        return view('materiales', compact('materiales'));
    }

    public function mostrarMaterialesEliminar(){
        $materiales = Material::orderBy('precio', 'asc')->get();
        return view('eliminarMateriales', compact('materiales'));
    }

    public function eliminar($id) {
        //Buscar el material por su ID
        $material = Material::find($id);
        
        if (!$material) {
            return redirect()->back()->with('error', 'Material no encontrado');
        }
    
        //Eliminar el material
        $material->delete();
    
        return redirect()->route('verEliminarMateriales')->with('success', 'Material eliminado exitosamente');
    }


    //EDITAR MATERIAL
    public function datosMateriales($id){
        $material = Material::find($id);
        return view('editarMaterial',['material' => $material]);
    }

    public function actualizarMaterial(Request $request, $id){
        $request->validate([
            'nombre' => [
                'required','string','min:3','max:100',Rule::unique('materiales')->ignore($id)
            ],
            'marca' =>'required|string|max:100',
            'enlace' => 'required|string|max:500',
            'precio' => 'required|numeric|between:0,999.99',
            'tipo' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,JPG|max:2048'
    
        ],[
            'nombre.required' => 'El nombre del material es obligatorio',
            'nombre.min' => 'El nombre tiene que tener al menos 3 letras',
            'nombre.max' => 'El nombre tiene que tener un maximo de 100 letras',
            'nombre.unique' => 'El nombre tiene que ser único, ya existe otro material con ese mismo nombre',
            'marca.required' => 'La marca del material es obligatoria',
            'marca.max' => 'La marca tiene que tener un maximo 100 letras',
            'enlace.required' => 'El enlace a la página oficial es obligatorio',
            'enlace.max' => 'El enlace a la pagina oficial tiene que tener un maximo de 500 letras',
            'precio.required' => 'El precio del material es obligatorio',
            'precio.numeric' => 'El precio debe ser un valor numérico',
            'precio.between' => 'El precio debe estar entre 0 y 999.99',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
    
        ]);
    
        //Obtener el material por su ID
        $material = Material::findOrFail($id);
    
        //Si se proporciona una nueva imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $material->imagen = $nombreImagen;
        }
    
        //Actualizar el material con los otros campos
        $material->nombre = $request->nombre;
        $material->marca = $request->marca;
        $material->enlace = $request->enlace;
        $material->precio = $request->precio;
        $material->tipo = $request->tipo;
        $material->save();
    
        return redirect()->route('verEliminarMateriales')->with('successMaterial', 'El material se ha actualizado.');
    }



    //EDITAR PERFIL
    public function datosUsuario($id){
        $usuario = User::find($id);
        $categoria = UserCategoria::where('entrenador_id', $usuario->id)->first();
        return view('editarPerfil', compact('usuario', 'categoria'));
    }

    
    public function actualizarPerfilEntrenador(Request $request, $id) {
        //Obtener el usuario que se desea modificar
        $user = User::findOrFail($id);
    
        //Validar los datos
        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'primer_apellido' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'segundo_apellido' => 'nullable|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', Rule::unique('users')->ignore($id)],
            'username' => ['required', Rule::unique('users')->ignore($id)],
            'sexo' => 'required|in:masculino,femenino',
            'fecha_nacimiento' => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'telefono' => 'required|numeric|digits:9',
            'password' => 'nullable|min:4',
            'dni' => ['required', 'regex:/^\d{8}[A-Z]$/i', Rule::unique('users')->ignore($id)],
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras. No puede introducir números',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',
            'segundo_apellido.regex' => 'El apellido solo puede contener letras. No puede introducir números',
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:users'],
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.regex' => 'El correo electrónico debe tener el formato nombre@gmail.com.',
            'correo_electronico.email' => 'El correo electrónico debe ser válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está en uso.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'sexo.required' => 'El sexo es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser válida.',
            'fecha_nacimiento.before_or_equal' => 'Debe tener al menos 18 años para registrarse.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'dni.required' => 'El DNI es obligatorio',
            'dni.regex' => 'El DNI debe tener 8 números y una letra en mayuscula al final',
            'dni.unique' => 'El DNI ya está en uso',
            'imagen.required' => 'La foto del entrenador es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
        ]);
    
        //Actualizar los campos del usuario con los datos del formulario
        $user->nombre = $request->nombre;
        $user->primer_apellido = $request->primer_apellido;
        $user->segundo_apellido = $request->segundo_apellido;
        $user->correo_electronico = $request->correo_electronico;
        $user->username = $request->username;
        $user->sexo = $request->sexo;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;
    
        //si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        //Si se proporciona una nueva imagen, actualizarla
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $user->imagen = $nombreImagen;
        }
    
        $user->save();

        if ($request->filled('categoria')) {
            $categoria = UserCategoria::where('entrenador_id', $user->id)->first();
            if ($categoria) {
                $categoria->categoria_id = $request->categoria;
                $categoria->save();
            } 
        }
    
        return redirect()->route('index')->with('success', 'Perfil actualizado correctamente.');
    }
    public function actualizarPerfilNadador(Request $request, $id) {
        //Obtener el usuario que se desea modificar
        $user = User::findOrFail($id);
    
        //Validar los datos
        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'primer_apellido' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'segundo_apellido' => 'nullable|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', Rule::unique('users')->ignore($id)],
            'username' => ['required', Rule::unique('users')->ignore($id)],
            'sexo' => 'required|in:masculino,femenino',
            'fecha_nacimiento' => 'required|date|before_or_equal:' . now()->subYears(8)->format('Y-m-d'),
            'telefono' => 'required|numeric|digits:9',
            'password' => 'nullable|min:4',
            'dni' => ['required', 'regex:/^\d{8}[A-Z]$/i', Rule::unique('users')->ignore($id)],
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras. No puede introducir números',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',
            'segundo_apellido.regex' => 'El apellido solo puede contener letras. No puede introducir números',
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:users'],
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.regex' => 'El correo electrónico debe tener el formato nombre@gmail.com.',
            'correo_electronico.email' => 'El correo electrónico debe ser válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está en uso.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'sexo.required' => 'El sexo es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser válida.',
            'fecha_nacimiento.before_or_equal' => 'Debe tener al menos 8 años para registrarse.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser numérico.',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'dni.required' => 'El DNI es obligatorio',
            'dni.regex' => 'El DNI debe tener 8 números y una letra en mayuscula al final',
            'dni.unique' => 'El DNI ya está en uso',
            'imagen.required' => 'La foto del entrenador es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
        ]);
    
        //Actualizar los campos del usuario con los datos del formulario
        $user->nombre = $request->nombre;
        $user->primer_apellido = $request->primer_apellido;
        $user->segundo_apellido = $request->segundo_apellido;
        $user->correo_electronico = $request->correo_electronico;
        $user->username = $request->username;
        $user->sexo = $request->sexo;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;
    
        //Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        //Si se proporciona una nueva imagen, actualizarla
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $user->imagen = $nombreImagen;
        }
    
        $user->save();

        if ($request->filled('categoria')) {
            $categoria = UserCategoria::where('entrenador_id', $user->id)->first();
            if ($categoria) {
                $categoria->categoria_id = $request->categoria;
                $categoria->save();
            } 
        }
    
        return redirect()->route('index')->with('success', 'Perfil actualizado correctamente.');
    }

    public function altaEntrenamiento(Request $request){

        $request->validate([
            'entrenamiento' =>'required|string|min:10|max:1000',
            'dia' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    $categoria_id = $request->categoria;
                    $entrenamientoExistente = Entrenamiento::where('categoria_id', $categoria_id)
                                                ->where('dia', $value)
                                                ->first();
                    if ($entrenamientoExistente) {
                        $fail('Ya existe un entrenamiento para esta categoría en la fecha seleccionada.');
                    }
                },
            ],  
        ],[
            'entrenamiento.required' => 'El entrenamiento es obligatorio',
            'entrenamiento.min' => 'El entrenamiento tiene que tener al menos 10 letras',
            'entrenamiento.max' => 'El entrenamiento tiene que tener un maximo de 1000 letras',
            'dia.required' => 'El día debe de ser obligatorio',
            'dia.date' => 'El día debe de ser válido',
            'dia.after_or_equal' => 'El día no debe ser anterior al actual.',

        ]);
    
        $entreno = new Entrenamiento();
        $entreno->categoria_id = $request->categoria;
        $entreno->entrenamiento = $request->entrenamiento;
        $entreno->dia = $request->dia;
    
        $entreno->save();
    
        return redirect()->route('entrenador')->with('success', 'El entrenamiento se ha añadido');
    
    }
    

    public function mostrarEntrenamientos(){
        $entrenamientos = Entrenamiento::all();
        $categorias = UserCategoria::all();
        $misCategorias = Categoria::all();
        return view('entrenamientos', compact('entrenamientos','categorias', 'misCategorias'));
    }

    public function mostrarCategoriasEntrenamientos(){
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
    
        $idsCategorias = $categorias->pluck('categoria_id');
    
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();
    
        return view('altaEntrenamiento', compact('categorias', 'misCategorias'));
    }
    

    public function altaHorario(Request $request) {
        $validator = Validator::make($request->all(), [
            'categoria' => 'required',
            'semana' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $fecha = new DateTime($value);
                    if ($fecha->format('N') != 1) { // 1 es lunes
                        $fail('La semana debe ser un lunes.');
                    }
                },
                // Ver si existe un horario para esa categoria y esa semana
                function ($attribute, $value, $fail) use ($request) {
                    $categoria_id = $request->categoria;
                    $horarioExistente = Horario::where('categoria_id', $categoria_id)
                                                ->where('semana', $value)
                                                ->first();
                    if ($horarioExistente) {
                        $fail('Ya existe un horario para esta categoría en la fecha seleccionada.');
                    }
                },
            ],
            'horarioLunes' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioMartes' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioMiercoles' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioJueves' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioViernes' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioSabado' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
        ], [
            'horarioLunes.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioMartes.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioMiercoles.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioJueves.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioViernes.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioSabado.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'semana.required' => 'La semana es obligatoria.',
            'semana.date' => 'La semana debe ser una fecha válida.',
            'semana.unique' => 'Ya se ha introducido esa semana',
            'semana.after_or_equal' => 'La semana no debe ser anterior a la actual.',
            'semana.custom_lunes' => 'La semana debe ser un lunes.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Crear y guardar el horario si pasa todas las validaciones
        $horario = new Horario();
        $horario->categoria_id = $request->categoria;
        $horario->horarioLunes = $request->horarioLunes;
        $horario->horarioMartes = $request->horarioMartes;
        $horario->horarioMiercoles = $request->horarioMiercoles;
        $horario->horarioJueves = $request->horarioJueves;
        $horario->horarioViernes = $request->horarioViernes;
        $horario->horarioSabado = $request->horarioSabado;
        $horario->semana = $request->semana;
    
        $horario->save();
    
        return redirect()->route('entrenador')->with('success', 'El horario se ha establecido correctamente.');
    }


    public function mostrarHorarios(){
        $horarios = Horario::all();
        $categorias = UserCategoria::all();
        $misCategorias = Categoria::all();
        return view('horarios', compact('horarios','categorias', 'misCategorias'));
    }

    public function mostrarCategoriasHorarios(){
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
    
        $idsCategorias = $categorias->pluck('categoria_id');
    
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();
    
        return view('altaHorario', compact('categorias', 'misCategorias'));
    }


    //EDITAR ELIMINAR HORARIOS
    public function mostrarHorariosEntrenador() {
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();
        $horarios = Horario::whereIn('categoria_id', $idsCategorias)->orderBy('semana','asc')->get();
        return view('verEliminarHorarios', compact('horarios','categorias', 'misCategorias'));
    }


    public function eliminarHorario($id) {
        $horario = Horario::find($id);
        if (!$horario) {
            return redirect()->back()->with('error', 'Horario no encontrado');
        }
        $horario->delete();
        return redirect()->route('verEliminarHorarios')->with('success', 'Horario eliminado exitosamente');
    }



    public function datosHorarios($id){
        $horario = Horario::find($id);
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();    
        return view('editarHorarios', compact('horario', 'categorias', 'misCategorias'));
    }
    

    public function actualizarHorario(Request $request, $id) {
        $horario = Horario::find($id);

        $validator = Validator::make($request->all(), [
            'categoria' => 'required',
            'semana' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $fecha = new DateTime($value);
                    if ($fecha->format('N') != 1) { 
                        $fail('La semana debe ser un lunes.');
                    }
                },
                function ($attribute, $value, $fail) use ($request, $id) {
                    $categoria_id = $request->categoria;
                    $horarioExistente = Horario::where('categoria_id', $categoria_id)
                                                ->where('semana', $value)
                                                ->where('id', '!=', $id) 
                                                ->first();
                    if ($horarioExistente) {
                        $fail('Ya existe un horario para esta categoría en la fecha seleccionada.');
                    }
                },
            ],
            'horarioLunes' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioMartes' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioMiercoles' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioJueves' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioViernes' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
            'horarioSabado' => 'nullable|string|max:500|regex:/^\d{2}:\d{2}-\d{1,2}:\d{2}(,\s?\d{2}:\d{2}-\d{1,2}:\d{2})*$/',
        ], [
            'horarioLunes.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioMartes.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioMiercoles.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioJueves.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioViernes.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'horarioSabado.regex' => 'El formato es inválido. Debes introducir "HH:MM-HH:MM"',
            'semana.required' => 'La semana es obligatoria.',
            'semana.date' => 'La semana debe ser una fecha válida.',
            'semana.unique' => 'Ya se ha introducido esa semana',
            'semana.after_or_equal' => 'La semana no debe ser anterior a la actual.',
            'semana.custom_lunes' => 'La semana debe ser un lunes.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $horario->categoria_id = $request->categoria;
        $horario->horarioLunes = $request->horarioLunes;
        $horario->horarioMartes = $request->horarioMartes;
        $horario->horarioMiercoles = $request->horarioMiercoles;
        $horario->horarioJueves = $request->horarioJueves;
        $horario->horarioViernes = $request->horarioViernes;
        $horario->horarioSabado = $request->horarioSabado;
        $horario->semana = $request->semana;
    
        $horario->save();
    
        return redirect()->route('entrenador')->with('success', 'El horario se ha modificado correctamente.');
    }

    public function mostrarEntrenamientoEntrenador() {
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();
        $entrenamientos = Entrenamiento::whereIn('categoria_id', $idsCategorias)->get();
        return view('verEliminarEntrenamiento', compact('entrenamientos','categorias', 'misCategorias'));
    }


    public function eliminarEntrenamiento($id) {
        $entrenamiento = Entrenamiento::find($id);
        
        if (!$entrenamiento) {
            return redirect()->back()->with('error', 'Entrenamiento no encontrado');
        }
        $entrenamiento->delete();
    
        return redirect()->route('verEliminarEntrenamiento')->with('success', 'Entrenamiento eliminado exitosamente');
    }

    public function datosEntrenamiento($id){
        $entrenamiento = Entrenamiento::find($id);
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();    
        return view('editarEntrenamiento', compact('entrenamiento', 'categorias', 'misCategorias'));
    }

    public function actualizarEntrenamiento(Request $request, $id){

        $entreno = Entrenamiento::find($id);
        $request->validate([
            'entrenamiento' =>'required|string|min:10|max:1000',
            'dia' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $categoria_id = $request->categoria;
                    $entrenamientoExistente = Entrenamiento::where('categoria_id', $categoria_id)
                                                ->where('dia', $value)
                                                ->where('id', '!=', $id) 
                                                ->first();
                    if ($entrenamientoExistente) {
                        $fail('Ya existe un entrenamiento para esta categoría en la fecha seleccionada.');
                    }
                },
            ],  
        ],[
            'entrenamiento.required' => 'El entrenamiento es obligatorio',
            'entrenamiento.min' => 'El entrenamiento tiene que tener al menos 10 letras',
            'entrenamiento.max' => 'El entrenamiento tiene que tener un maximo de 1000 letras',
            'dia.required' => 'El día debe de ser obligatorio',
            'dia.date' => 'El día debe de ser válido',
            'dia.after_or_equal' => 'El día no debe ser anterior al actual',
        ]);
    
        
        $entreno->categoria_id = $request->categoria;
        $entreno->entrenamiento = $request->entrenamiento;
        $entreno->dia = $request->dia;
    
        $entreno->save();
    
        return redirect()->route('verEliminarEntrenamiento')->with('success', 'El entrenamiento se sido modificado');
    
    }


    //COMPETICIONES
    public function mostrarCategoriasCompeticiones(){
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
    
        $idsCategorias = $categorias->pluck('categoria_id');
    
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();
    
        return view('altaCompeticion', compact('categorias', 'misCategorias'));
    }

    public function altaCompeticion(Request $request) {
        $request->validate([
            'descripcion' => 'required|string|min:10|max:1000',
            'titulo' => 'required|string|min:5|max:250|unique:competiciones',
            'localizacion' => 'required|string|min:3|max:50',
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    // Comprobar competición para una fecha y categoria
                    $competenciaExistente = DB::table('competiciones_categoria')
                        ->join('competiciones', 'competiciones_categoria.competicion_id', '=', 'competiciones.id')
                        ->where('competiciones_categoria.categoria_id', $request->categoria)
                        ->whereDate('competiciones.fecha', $value)
                        ->exists();
    
                    if ($competenciaExistente) {
                        $fail('Ya existe una competición para esta categoría en la fecha seleccionada.');
                    }
                },
            ],
        ], [
            'titulo.required' => 'El título de la competición es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 5 caracteres.',
            'titulo.max' => 'El título debe tener como máximo 250 caracteres.',
            'titulo.unique' => 'Ya existe un competición con ese título.',
            'descripcion.required' => 'La descripción de la competición es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción debe tener como máximo 1000 caracteres.',
            'localizacion.required' => 'La localización es obligatoria.',
            'localizacion.min' => 'La localización debe tener al menos 3 caracteres.',
            'localizacion.max' => 'La localización debe tener como máximo 50 caracteres.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'fecha.after_or_equal' => 'La fecha no puede ser anterior al día actual',
        ]);
    
        // Verificar si ya existe una competición para la categoría y fecha especificadas
        $competenciaExistente = DB::table('competiciones_categoria')
            ->join('competiciones', 'competiciones_categoria.competicion_id', '=', 'competiciones.id')
            ->where('competiciones_categoria.categoria_id', $request->categoria)
            ->where('competiciones.fecha', $request->fecha)
            ->exists();
    
        if ($competenciaExistente) {
            return redirect()->back()->with('error', 'Ya existe una competición para esta categoría en la fecha seleccionada.');
        }
    
        $competicion = new Competicion();
        $competicion->titulo = $request->titulo;
        $competicion->descripcion = $request->descripcion;
        $competicion->localizacion = $request->localizacion;
        $competicion->fecha = $request->fecha;
    
        $competicion->save();
    
        $competicion->categorias()->attach($request->categoria);
    
        return redirect()->route('entrenador')->with('success', 'La competición se ha creado correctamente.');
    }

    public function mostrarCompeticiones(){
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();

        $competicion_categorias = CompeticionCategoria::whereIn('categoria_id', $idsCategorias)->get();
        $idsCompeticion = $competicion_categorias->pluck('competicion_id');
        $competiciones = Competicion::whereHas('categorias', function ($query) use ($idsCategorias) {
            $query->whereIn('categoria_id', $idsCategorias);
        })->orderBy('fecha', 'asc')->get();
            
        return view('competiciones', compact('competiciones', 'categorias','misCategorias', 'competicion_categorias'));
    }

    

    public function mostrarCompeticionesCualquiera(){
        $categorias = UserCategoria::all();
        $misCategorias = Categoria::all();
        $competicion_categorias = CompeticionCategoria::all();
        $competiciones = Competicion::orderBy('fecha', 'asc')->get();

        return view('competicionesCualquiera', compact('categorias','misCategorias', 'competicion_categorias','competiciones'));
    }


    public function mostrarCompeticionesEliminar(){
        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();

    
        $competicion_categorias = CompeticionCategoria::whereIn('categoria_id', $idsCategorias)->get();
        $idsCompeticion = $competicion_categorias->pluck('competicion_id');
    
        $competiciones = Competicion::whereHas('categorias', function ($query) use ($idsCategorias) {
            $query->whereIn('categoria_id', $idsCategorias);
        })->orderBy('fecha', 'asc')->get();;
            
        return view('eliminarCompeticiones', compact('competiciones', 'categorias','misCategorias', 'competicion_categorias'));
    }

    public function datosCompeticion($id){
        $competicion = Competicion::find($id);
        $competicion_categorias = CompeticionCategoria::where('competicion_id', $competicion->id)->first();

        $categorias = UserCategoria::where('entrenador_id', auth()->id())->get();
        $idsCategorias = $categorias->pluck('categoria_id');
        $misCategorias = Categoria::whereIn('id', $idsCategorias)->get();
    
        return view('editarCompeticion', compact('competicion', 'competicion_categorias','misCategorias','categorias'));
    }

    public function actualizarCompeticion(Request $request, $id) {

        $competicion = Competicion::find($id);
        $request->validate([
            'descripcion' => 'required|string|min:10|max:1000',
            'titulo' => ['required', 'string', 'min:5', 'max:250', Rule::unique('competiciones')->ignore($id)],
            'localizacion' => 'required|string|min:3|max:50',
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $competenciaExistente = DB::table('competiciones_categoria')
                        ->join('competiciones', 'competiciones_categoria.competicion_id', '=', 'competiciones.id')
                        ->where('competiciones_categoria.categoria_id', $request->categoria)
                        ->where('competiciones.id', '!=', $id) 
                        ->whereDate('competiciones.fecha', $value)
                        ->exists();
    
                    if ($competenciaExistente) {
                        $fail('Ya existe una competición para esta categoría en la fecha seleccionada.');
                    }
                },
            ],
        ], [
            'titulo.required' => 'El título de la competición es obligatorio.',
            'titulo.min' => 'El título debe tener al menos 5 caracteres.',
            'titulo.max' => 'El título debe tener como máximo 250 caracteres.',
            'titulo.unique' => 'Ya existe una competición con ese título.',
            'descripcion.required' => 'La descripción de la competición es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción debe tener como máximo 1000 caracteres.',
            'localizacion.required' => 'La localización es obligatoria.',
            'localizacion.min' => 'La localización debe tener al menos 3 caracteres.',
            'localizacion.max' => 'La localización debe tener como máximo 50 caracteres.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'fecha.after_or_equal' => 'La fecha no puede ser anterior al día actual',
        ]);
    
        $competicion->titulo = $request->titulo;
        $competicion->descripcion = $request->descripcion;
        $competicion->localizacion = $request->localizacion;
        $competicion->fecha = $request->fecha;
    
        $competicion->save();
    
        //Actualizar la relación CompeticionCategoria
        $competicion_categoria = CompeticionCategoria::where('competicion_id', $competicion->id)->first();
        $competicion_categoria->categoria_id = $request->categoria;
        $competicion_categoria->save();
    
        return redirect()->route('entrenador')->with('success', 'La competición se ha actualizado correctamente.');
    }
    

    public function eliminarCompeticion($id){
        CompeticionCategoria::where('competicion_id', $id)->delete();
        $competicion = Competicion::find($id);
        $competicion->delete();
    
        return redirect()->route('eliminarCompeticiones')->with('success', 'La competición ha sido eliminada');
    }


    //TIEMPOS
    public function mostrarNadadoresTiempos(){
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();

            $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
                foreach ($nadador->categorias as $categoriaNadador) {
                    if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                        return true;
                    }
                }
                return false;
            });
            return view('altaTiempo',compact('nadadores'));

    }


    public function altaTiempo(Request $request){
        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $existingTime = DB::table('tiempos')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where('idUsuario1', $request->idUsuario1)
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe un tiempo para esta fecha, estilo, distancia y nadador.');
                    }
                },
            ],      
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);

   
        $tiempo = new Tiempo();
        $tiempo->piscina = $request->piscina;
        $tiempo->crono = $request->crono;
        $tiempo->estilo = $request->estilo;
        $tiempo->distancia = $request->distancia;
        $tiempo->lugar = $request->lugar;
        $tiempo->fecha = $request->fecha;
        $tiempo->tiempo = $request->tiempo;
        $tiempo->idUsuario1 = $request->idUsuario1;

        $tiempo->save();

    
        return redirect()->route('entrenador')->with('success', 'El tiempo se ha creado correctamente.');
    
    }

    public function buscarTiempos(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador); 
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
    
        $tiempos = Tiempo::whereIn('idUsuario1', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        $resultadosFinales = collect();
        foreach ($tiempos as $tiempo) {
            $nadador = User::find($tiempo->idUsuario1);
            if ($nadador && $nadador->sexo == $sexo) {
                $resultadosFinales->push($tiempo);
            }
        }
    
        return view('verEliminarTiempos', ['resultadosFinales' => $resultadosFinales, 'nadadores' => $nadadores]);
    }
    

    public function datosTiempo($id){
        $tiempo = Tiempo::find($id);
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
            foreach ($nadador->categorias as $categoriaNadador) {
                if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                    return true;
                }
            }
            return false;
        });
        return view('editarTiempo', compact('tiempo', 'nadadores'));
    }
    

    public function actualizarTiempo(Request $request, $id){
        $tiempo = Tiempo::find($id);

        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            
            
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $existingTime = DB::table('tiempos')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where('idUsuario1', $request->idUsuario1)
                        ->where('id', '!=', $id) 
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe un tiempo para esta fecha, estilo, distancia y nadador.');
                    }
                },
            ],      
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);

        $tiempo->piscina = $request->piscina;
        $tiempo->crono = $request->crono;
        $tiempo->estilo = $request->estilo;
        $tiempo->distancia = $request->distancia;
        $tiempo->lugar = $request->lugar;
        $tiempo->fecha = $request->fecha;
        $tiempo->tiempo = $request->tiempo;
        $tiempo->idUsuario1 = $request->idUsuario1;

        $tiempo->save();

    
        return redirect()->route('verEliminarTiempos')->with('success', 'El tiempo se ha actualizado.');
    
    }

    public function eliminarTiempo($id){
        $tiempo = Tiempo::find($id);
        $tiempo->delete();
    
        return redirect()->route('verEliminarTiempos')->with('success', 'El tiempo se ha sido eliminado');
    }

    public function buscarTiemposMenuNadadores(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');

        //buscar tiempos
        $tiempos = Tiempo::where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->orderBy('tiempo', 'asc')
                        ->get();

        $nadadores = User::whereIn('id', $tiempos->pluck('idUsuario1'))->get();

        return view('tiempos', ['tiempos' => $tiempos, 'nadadores' => $nadadores]);
    }
    

    public function buscarTiemposMenu(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
    
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador);
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
    
        $tiempos = Tiempo::whereIn('idUsuario1', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        $resultadosFinales = collect();
        foreach ($tiempos as $tiempo) {
            $nadador = User::find($tiempo->idUsuario1);
            if ($nadador && $nadador->sexo == $sexo) {
                $resultadosFinales->push($tiempo);
            }
        }
    
        return view('tiempos', ['resultadosFinales' => $resultadosFinales, 'nadadores' => $nadadores]);
    }
    

    //Tiempo de relevo
    public function mostrarNadadoresTiemposRelevos(){
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();

        $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
            foreach ($nadador->categorias as $categoriaNadador) {
                if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                    return true;
                }
            }
            return false;
        });
        return view('altaTiempoRelevo',compact('nadadores'));

    }


    public function altaTiempoRelevo(Request $request){

        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $existingTime = DB::table('tiempos')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where(function ($query) use ($request) {
                            $query->whereIn('idUsuario1', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario2', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario3', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario4', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4]);
                        })
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe un tiempo para esta fecha, estilo, distancia y nadadores.');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->idUsuario1 == $request->idUsuario2 || 
                        $request->idUsuario1 == $request->idUsuario3 || 
                        $request->idUsuario1 == $request->idUsuario4 || 
                        $request->idUsuario2 == $request->idUsuario3 || 
                        $request->idUsuario2 == $request->idUsuario4 || 
                        $request->idUsuario3 == $request->idUsuario4) {
                        
                        $fail('Los nadadores deben ser distintos entre sí.');
                    }
                }
            ],     
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);
    
        $tiempo = new Tiempo();
        $tiempo->piscina = $request->piscina;
        $tiempo->crono = $request->crono;
        $tiempo->estilo = $request->estilo;
        $tiempo->distancia = $request->distancia;
        $tiempo->lugar = $request->lugar;
        $tiempo->fecha = $request->fecha;
        $tiempo->tiempo = $request->tiempo;
        $tiempo->sexo = $request->sexo;
        $tiempo->idUsuario1 = $request->idUsuario1;
        $tiempo->idUsuario2 = $request->idUsuario2;
        $tiempo->idUsuario3 = $request->idUsuario3;
        $tiempo->idUsuario4 = $request->idUsuario4;
    
        $tiempo->save();
    
        return redirect()->route('entrenador')->with('success', 'El tiempo del relevo se ha creado correctamente.');
    }

    public function buscarTiemposRelevos(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador); 
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
        $tiemposRelevos = Tiempo::whereIn('idUsuario1', $nadadoresIds)
                        ->whereIn('idUsuario2', $nadadoresIds)
                        ->whereIn('idUsuario3', $nadadoresIds)
                        ->whereIn('idUsuario4', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('sexo', $sexo)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        return view('verEliminarTiempos', [
            'tiemposRelevos' => $tiemposRelevos]);
    }
    

    public function buscarTiemposRelevosMenu(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
    
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador); 
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
        $tiemposRelevos = Tiempo::whereIn('idUsuario1', $nadadoresIds)
                        ->whereIn('idUsuario2', $nadadoresIds)
                        ->whereIn('idUsuario3', $nadadoresIds)
                        ->whereIn('idUsuario4', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('sexo', $sexo)
                        ->orderBy('tiempo', 'asc')
                        ->get();

        return view('tiempos', ['tiemposRelevos' => $tiemposRelevos]);
    }

    public function buscarTiemposRelevosMenuNadadores(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');

    
        //buscar tiempos solo de los nadadores gestionados por el entrenador y que pertenecen a la misma categoría
        $tiemposRelevosNad = Tiempo::where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('sexo', $sexo)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        return view('tiempos', [
            'tiemposRelevosNad' => $tiemposRelevosNad]);
    }
    

    //EDITAR TIEMPO RELEVO
    public function datosTiempoRelevo($id){
        $tiempo = Tiempo::find($id);
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
            foreach ($nadador->categorias as $categoriaNadador) {
                if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                    return true;
                }
            }
            return false;
        });
        return view('editarTiempoRelevo', compact('tiempo', 'nadadores'));
    }

    //ACTUALIZAR DATOS RELEVO
    public function actualizarTiempoRelevo(Request $request, $id){

        $tiempo = Tiempo::find($id);
        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    // Verificar que el array tiene exactamente 3 partes
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $existingTime = DB::table('tiempos')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where('idUsuario1', $request->idUsuario1)
                        ->where('idUsuario2', $request->idUsuario2)
                        ->where('idUsuario3', $request->idUsuario3)
                        ->where('idUsuario4', $request->idUsuario4)
                        ->where('id', '!=', $id) 
                        ->exists();
        
                    if ($existingTime) {
                        $fail('Ya existe un tiempo para esta fecha, estilo, distancia y nadadores.');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->idUsuario1 == $request->idUsuario2 || 
                        $request->idUsuario1 == $request->idUsuario3 || 
                        $request->idUsuario1 == $request->idUsuario4 || 
                        $request->idUsuario2 == $request->idUsuario3 || 
                        $request->idUsuario2 == $request->idUsuario4 || 
                        $request->idUsuario3 == $request->idUsuario4) {
                        
                        $fail('Los nadadores deben ser distintos entre sí.');
                    }
                }
            ],     
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);
    
        $tiempo->piscina = $request->piscina;
        $tiempo->crono = $request->crono;
        $tiempo->estilo = $request->estilo;
        $tiempo->distancia = $request->distancia;
        $tiempo->lugar = $request->lugar;
        $tiempo->fecha = $request->fecha;
        $tiempo->tiempo = $request->tiempo;
        $tiempo->sexo = $request->sexo;
        $tiempo->idUsuario1 = $request->idUsuario1;
        $tiempo->idUsuario2 = $request->idUsuario2;
        $tiempo->idUsuario3 = $request->idUsuario3;
        $tiempo->idUsuario4 = $request->idUsuario4;
    
        $tiempo->save();
    
        return redirect()->route('verEliminarTiempos')->with('success', 'El tiempo del relevo se ha actualizado correctamente.');
    }
    

    //MINIMAS
    public function mostrarNadadoresMinimas(){
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();

            $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
                foreach ($nadador->categorias as $categoriaNadador) {
                    if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                        return true;
                    }
                }
                return false;
            });
            return view('altaMinima',compact('nadadores'));

    }
    

    public function altaMinima(Request $request){

        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'tipo' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $existingTime = DB::table('minimas')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where('idUsuario1', $request->idUsuario1)
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe una mínima para esta fecha, estilo, distancia y nadador.');
                    }
                },
            ],      
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);

   
        $minima = new Minima();
        $minima->piscina = $request->piscina;
        $minima->crono = $request->crono;
        $minima->estilo = $request->estilo;
        $minima->distancia = $request->distancia;
        $minima->lugar = $request->lugar;
        $minima->fecha = $request->fecha;
        $minima->tiempo = $request->tiempo;
        $minima->tipo = $request->tipo;
        $minima->idUsuario1 = $request->idUsuario1;

        $minima->save();

    
        return redirect()->route('entrenador')->with('success', 'La mínima se ha creado correctamente.');
    
    }

    public function mostrarNadadoresMinimasRelevos(){
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();

        $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
            foreach ($nadador->categorias as $categoriaNadador) {
                if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                    return true;
                }
            }
            return false;
        });
        return view('altaMinimaRelevo',compact('nadadores'));

    }

    public function altaMinimaRelevo(Request $request){

        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'sexo' => 'required|string',
            'tipo' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    // Verificar que el array tiene exactamente 3 partes
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $existingTime = DB::table('minimas')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where(function ($query) use ($request) {
                            $query->whereIn('idUsuario1', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario2', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario3', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario4', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4]);
                        })
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe una mínima para esta fecha, estilo, distancia y nadadores.');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->idUsuario1 == $request->idUsuario2 || 
                        $request->idUsuario1 == $request->idUsuario3 || 
                        $request->idUsuario1 == $request->idUsuario4 || 
                        $request->idUsuario2 == $request->idUsuario3 || 
                        $request->idUsuario2 == $request->idUsuario4 || 
                        $request->idUsuario3 == $request->idUsuario4) {
                        
                        $fail('Los nadadores deben ser distintos entre sí.');
                    }
                }
            ],     
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);
    
        $minima = new Minima();
        $minima->piscina = $request->piscina;
        $minima->crono = $request->crono;
        $minima->estilo = $request->estilo;
        $minima->distancia = $request->distancia;
        $minima->lugar = $request->lugar;
        $minima->fecha = $request->fecha;
        $minima->tiempo = $request->tiempo;
        $minima->sexo = $request->sexo;
        $minima->tipo = $request->tipo;
        $minima->idUsuario1 = $request->idUsuario1;
        $minima->idUsuario2 = $request->idUsuario2;
        $minima->idUsuario3 = $request->idUsuario3;
        $minima->idUsuario4 = $request->idUsuario4;
    
        $minima->save();
    
        return redirect()->route('entrenador')->with('success', 'La mínima del relevo se ha creado correctamente.');
    }


    public function buscarMinimas(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $tipo = $request->input('tipo');
        $sexo = $request->input('sexo');

        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
    
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador);
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
    
        $minimas = Minima::whereIn('idUsuario1', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('tipo', $tipo)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        $resultadosFinales = collect();
        foreach ($minimas as $tiempo) {
            $nadador = User::find($tiempo->idUsuario1);
            if ($nadador && $nadador->sexo == $sexo) {
                $resultadosFinales->push($tiempo);
            }
        }
    
        return view('verEliminarMinimas', ['resultadosFinales' => $resultadosFinales, 'nadadores' => $nadadores]);
    }

    public function buscarMinimasRelevos(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
        $tipo = $request->input('tipo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador); 
                        })
                        ->get();
        $nadadoresIds = $nadadores->pluck('id')->toArray();
    
        $minimasRelevos = Minima::whereIn('idUsuario1', $nadadoresIds)
                        ->whereIn('idUsuario2', $nadadoresIds)
                        ->whereIn('idUsuario3', $nadadoresIds)
                        ->whereIn('idUsuario4', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('sexo', $sexo)
                        ->where('tipo', $tipo)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        return view('verEliminarMinimas', [
            'minimasRelevos' => $minimasRelevos]);
    }
    
    //ELIMINAR MÍNIMA
    public function eliminarMinima($id){
        $minima = Minima::find($id);
        $minima->delete();
    
        return redirect()->route('verEliminarMinimas')->with('success', 'La mínima se ha eliminado');
    }

    //MENÚ
    public function buscarMinimasMenu(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $tipo = $request->input('tipo');
        $sexo = $request->input('sexo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
    
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador); 
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
    
        //buscar tiempos solo de los nadadores gestionados por el entrenador
        $minimas = Minima::whereIn('idUsuario1', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('tipo', $tipo)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        $resultadosFinales = collect();
        foreach ($minimas as $tiempo) {
            $nadador = User::find($tiempo->idUsuario1);
            if ($nadador && $nadador->sexo == $sexo) {
                $resultadosFinales->push($tiempo);
            }
        }
    
        return view('minimas', ['resultadosFinales' => $resultadosFinales, 'nadadores' => $nadadores]);
    }

    public function buscarMinimasRelevosMenu(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
        $tipo = $request->input('tipo');
    
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
    
        $nadadores = User::where('tipo', 'Nadador')
                        ->whereHas('categorias', function($query) use ($categoriasEntrenador) {
                            $query->whereIn('categorias.id', $categoriasEntrenador); 
                        })
                        ->get();
    
        $nadadoresIds = $nadadores->pluck('id')->toArray();
        $minimasRelevos = Minima::whereIn('idUsuario1', $nadadoresIds)
                        ->whereIn('idUsuario2', $nadadoresIds)
                        ->whereIn('idUsuario3', $nadadoresIds)
                        ->whereIn('idUsuario4', $nadadoresIds)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('sexo', $sexo)
                        ->where('tipo', $tipo)
                        ->orderBy('tiempo', 'asc')
                        ->get();
    
        return view('minimas', ['minimasRelevos' => $minimasRelevos]);
    }


    public function buscarMinimasMenuNadadores(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $tipo = $request->input('tipo');
        $sexo = $request->input('sexo');

        $categoriasUsuario = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();

        $nadadoresCategoria = UserCategoria::whereIn('categoria_id', $categoriasUsuario)
                                        ->whereNotNull('entrenador_id') 
                                        ->pluck('entrenador_id');

        $minimas = Minima::whereIn('idUsuario1', $nadadoresCategoria)
                        ->where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->where('tipo', $tipo)
                        ->orderBy('tiempo', 'asc')
                        ->get();

        $resultadosFinales = collect();
        foreach ($minimas as $tiempo) {
            $nadador = User::find($tiempo->idUsuario1);
            if ($nadador && $nadador->sexo == $sexo) {
                $resultadosFinales->push($tiempo);
            }
        }
    
        return view('minimas', ['resultadosFinales' => $resultadosFinales]);
    }


    public function buscarMinimasRelevosMenuNadadores(Request $request) {
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $sexo = $request->input('sexo');
        $tipo = $request->input('tipo');
    
        $nadadorLogueadoId = Auth::user()->id;
        $minimasRelevos = Minima::where(function ($query) use ($nadadorLogueadoId) {
                $query->where('idUsuario1', $nadadorLogueadoId)
                    ->orWhere('idUsuario2', $nadadorLogueadoId)
                    ->orWhere('idUsuario3', $nadadorLogueadoId)
                    ->orWhere('idUsuario4', $nadadorLogueadoId);
            })
            ->where('piscina', $piscina)
            ->where('crono', $crono)
            ->where('estilo', $estilo)
            ->where('distancia', $distancia)
            ->where('sexo', $sexo)
            ->where('tipo', $tipo)
            ->orderBy('tiempo', 'asc')
            ->get();
    
        return view('minimas', [
            'minimasRelevos' => $minimasRelevos
        ]);
    }
    

    //EDITAR MINIMAS
    public function datosMinimas($id){
        $minima = Minima::find($id);
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
            foreach ($nadador->categorias as $categoriaNadador) {
                if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                    return true;
                }
            }
            return false;
        });
        return view('editarMinima', compact('minima', 'nadadores'));
    }


    public function datosMinimaRelevo($id){
        $minima = Minima::find($id);
        $categoriasEntrenador = UserCategoria::where('entrenador_id', Auth::user()->id)->pluck('categoria_id')->toArray();
        $nadadores = User::where('tipo', 'Nadador')->get()->filter(function($nadador) use ($categoriasEntrenador) {
            foreach ($nadador->categorias as $categoriaNadador) {
                if (in_array($categoriaNadador->id, $categoriasEntrenador)) {
                    return true;
                }
            }
            return false;
        });
        return view('editarMinimaRelevo', compact('minima', 'nadadores'));
    }

    //ACTUALIZAR MINIMAS RELEVO
    public function actualizarMinimaRelevo(Request $request, $id){

        $minima = Minima::find($id);

        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'sexo' => 'required|string',
            'tipo' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $existingTime = DB::table('minimas')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where(function ($query) use ($request) {
                            $query->whereIn('idUsuario1', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario2', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario3', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4])
                                  ->orWhereIn('idUsuario4', [$request->idUsuario1, $request->idUsuario2, $request->idUsuario3, $request->idUsuario4]);
                        })
                        ->where('id', '!=', $id) 
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe una mínima para esta fecha, estilo, distancia y nadadores.');
                    }
                },
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->idUsuario1 == $request->idUsuario2 || 
                        $request->idUsuario1 == $request->idUsuario3 || 
                        $request->idUsuario1 == $request->idUsuario4 || 
                        $request->idUsuario2 == $request->idUsuario3 || 
                        $request->idUsuario2 == $request->idUsuario4 || 
                        $request->idUsuario3 == $request->idUsuario4) {
                        
                        $fail('Los nadadores deben ser distintos entre sí.');
                    }
                }
            ],     
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);
    
        $minima->piscina = $request->piscina;
        $minima->crono = $request->crono;
        $minima->estilo = $request->estilo;
        $minima->distancia = $request->distancia;
        $minima->lugar = $request->lugar;
        $minima->fecha = $request->fecha;
        $minima->tiempo = $request->tiempo;
        $minima->sexo = $request->sexo;
        $minima->tipo = $request->tipo;
        $minima->idUsuario1 = $request->idUsuario1;
        $minima->idUsuario2 = $request->idUsuario2;
        $minima->idUsuario3 = $request->idUsuario3;
        $minima->idUsuario4 = $request->idUsuario4;
    
        $minima->save();
    
        return redirect()->route('verEliminarMinimas')->with('success', 'La mínima del relevo se ha actualizado correctamente.');
    }

    public function actualizarMinima(Request $request, $id){

        $minima = Minima::find($id);

        $request->validate([
            'piscina' => 'required|string',
            'crono' => 'required|string',
            'estilo' => 'required|string',
            'distancia' => 'required|string',
            'tipo' => 'required|string',
            'lugar' => 'required|string|max:50|min:3',
            'tiempo' => [
                'required',
                'string',
                'regex:/^\d{2}\.\d{2}\.\d{2}$/',
                function ($attribute, $value, $fail) {
                    $parts = explode('.', $value);
                    
                    if (count($parts) !== 3 || 
                        (int)$parts[0] < 0 || (int)$parts[0] > 59 ||  
                        (int)$parts[1] < 0 || (int)$parts[1] > 59 ||  
                        (int)$parts[2] < 0 || (int)$parts[2] > 99) {  
                        
                        $fail('El formato del tiempo es inválido.');
                    }
                }
            ],
            
            
            'fecha' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request, $id) {
                    $existingTime = DB::table('minimas')
                        ->where('fecha', $request->fecha)
                        ->where('estilo', $request->estilo)
                        ->where('distancia', $request->distancia)
                        ->where('idUsuario1', $request->idUsuario1)
                        ->where('id', '!=', $id) 
                        ->exists();
            
                    if ($existingTime) {
                        $fail('Ya existe una mínima para esta fecha, estilo, distancia y nadador.');
                    }
                },
            ],      
        ], [
            'piscina.required' => 'El tipo de piscina es obligatorio.',
            'crono.required' => 'El tipo de cronómetro es obligatorio.',
            'estilo.required' => 'El estilo es obligatorio.',
            'distancia.required' => 'La distancia de la piscina es obligatoria.',
            'lugar.required' => 'La localización es obligatoria.',
            'lugar.min' => 'El lugar de la competición debe tener al menos 3 caracteres.',
            'lugar.max' => 'El lugar de la competición debe tener como máximo 50 caracteres.',
            'tiempo.required' => 'El tiempo es obligatorio.',
            'tiempo.regex' => 'El formato del tiempo es incorrecto.',
            'fecha.required' => 'La fecha de la competición es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'idUsuario1.unique' => 'Ya existe un registro para esta fecha, estilo y distancia.'
        ]);

        $minima->piscina = $request->piscina;
        $minima->crono = $request->crono;
        $minima->estilo = $request->estilo;
        $minima->distancia = $request->distancia;
        $minima->lugar = $request->lugar;
        $minima->fecha = $request->fecha;
        $minima->tiempo = $request->tiempo;
        $minima->tipo = $request->tipo;
        $minima->idUsuario1 = $request->idUsuario1;

        $minima->save();

    
        return redirect()->route('verEliminarMinimas')->with('success', 'La mínima se ha actualizado correctamente.');
    
    }

    //RANKING
    public function buscarTiemposRanking(Request $request){
        $piscina = $request->input('piscina');
        $crono = $request->input('crono');
        $estilo = $request->input('estilo');
        $distancia = $request->input('distancia');
        $resultadosAMostrar = $request->input('resultados');
    
        $tiempos = Tiempo::where('piscina', $piscina)
                        ->where('crono', $crono)
                        ->where('estilo', $estilo)
                        ->where('distancia', $distancia)
                        ->orderBy('tiempo', 'asc')
                        ->get();

        $resultadosFinales = collect();

        $tiemposPorNadador = $tiempos->groupBy('idUsuario1');
        foreach ($tiemposPorNadador as $idUsuario => $tiemposNadador) {
            $tiempoMasBajo = $tiemposNadador->sortBy('tiempo')->first();
        
            $nadador = User::find($idUsuario);
        
            if ($nadador && $nadador->sexo == $request->input('sexo')) {
                $resultadosFinales->push($tiempoMasBajo);
            }
        }
        
        $resultadosFinales = $resultadosFinales->take($resultadosAMostrar);
        
        return view('ranking', ['resultadosFinales' => $resultadosFinales]);
                        
    }
    
     
}
