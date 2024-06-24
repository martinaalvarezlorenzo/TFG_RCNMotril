<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categoria;
use App\Models\UserCategoria;
use App\Models\Noticia;
use App\Models\Solicitud;
use App\Models\SolicitudCategoria;
use App\Models\Minima;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller{
    private $disk="public";

    public function index(){
        $entrenadores = User::where('tipo','Entrenador')->get();

        return view('verEliminarEntrenadores',compact('entrenadores'));
    }

    public function mostrarSolicitudes(){
        $solicitudes = User::where('estado', 2)->get();
        return view('verSolicitudes', compact('solicitudes'));
    }

    public function destroy($id){
        UserCategoria::where('entrenador_id', $id)->delete();
    
        $entrenador = User::find($id);
        $entrenador->delete();
    
        return redirect()->route('verEliminarEntrenadores')->with('success', 'El entrenador han sido eliminado.');
    }
    

    public function register_entrenador(Request $request){
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'primer_apellido' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'segundo_apellido' => 'nullable|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',        
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:users'],
            'username' => 'required|unique:users|regex:/^@[a-zA-Z0-9_]+$/',
            'sexo' => 'required|in:masculino,femenino',
            'fecha_nacimiento' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d'),
            'telefono' => 'required|numeric|digits:9',
            'password' => 'required|min:4',
            'dni' => ['required', 'regex:/^\d{8}[A-Z]$/i', 'unique:users'], 
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,JPG|max:2048',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras. No puede introducir números',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',
            'primer_apellido.regex' => 'El apellido solo puede contener letras. No puede introducir números',
            'segundo_apellido.regex' => 'El apellido solo puede contener letras. No puede introducir números',
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:users'],
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.regex' => 'El correo electrónico debe tener el formato nombre@gmail.com.',
            'correo_electronico.email' => 'El correo electrónico debe ser válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está en uso.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'username.regex' => 'El nombre de usuario debe comenzar por "@"',
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

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $nombreImagen = $nombreImagen;
        } else {
            $nombreImagen = 'login.png';
        }
        

        //crear un nuevo usuario con los datos del formulario
        $user = new User();
        $user->nombre = $request->nombre;
        $user->primer_apellido = $request->primer_apellido;
        $user->segundo_apellido = $request->segundo_apellido;
        $user->correo_electronico = $request->correo_electronico;
        $user->username = $request->username;
        $user->sexo = $request->sexo;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->password = Hash::make($request->password);
        $user->telefono = $request->telefono;
        $user->imagen = $nombreImagen; 
        $user->tipo = 'Entrenador'; 
        $user->dni = $request->dni;

        $user->save();

        return redirect()->route('index')->with('success', 'Entrenador insertado correctamente.');

    }


    public function logout(Request $request){
        Auth::logout(); 
        
        //resetear la sesion
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    public function login(Request $request) {
        //validar los datos del formulario
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);
        
        //Buscar al usuario
        $user = User::where('username', $request->username)->first();
        if (!$user || $user->estado === 0 || $user->estado === 2) {
            return redirect()->back()->withInput()->withErrors(['username' => 'Nombre de usuario incorrecto']);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Contraseña incorrecta']);
        }
    
        Auth::login($user);
        return redirect()->intended(route('index'));
    } 

    public function mostrarCategorias(){
        $categorias = Categoria::all();
        return view('gestionEntrenadores', ['categorias' => $categorias]);
    }

    public function mostrarEntrenadoresYCategorias(){
        $entrenadores = User::where('tipo','Entrenador')->get();
        $categorias = Categoria::all();
        return view('gestionEntrenadores', compact('entrenadores', 'categorias'));
    }

    
    public function guardarCategoria(Request $request){
        $existenciaCategoria = UserCategoria::where('entrenador_id', $request->entrenador_id)
                                             ->where('categoria_id', $request->categoria_id)
                                             ->exists();
    
        if ($existenciaCategoria) {
            return redirect()->route('gestionEntrenadores')->with('error', '¡La categoría ya está asignada para este entrenador!');
        }
    
        $userCategoria = new UserCategoria();
        $userCategoria->entrenador_id = $request->entrenador_id;
        $userCategoria->categoria_id = $request->categoria_id;
        $userCategoria->save();
    
        return redirect()->route('gestionEntrenadores')->with('success', '¡Categoría añadida exitosamente!');
    }
    


    public function obtenerCategoriasPorEntrenador($entrenador_id)
    {
        $entrenador = User::findOrFail($entrenador_id);
        $categorias = $entrenador->categorias; 
        return $categorias;
    }

    public function eliminarRelacion($entrenador_id, $categoria_id){
        $relacion = UserCategoria::where('entrenador_id', $entrenador_id)
                         ->where('categoria_id', $categoria_id)
                         ->first();
        if ($relacion) {
            $relacion->delete();
            return redirect()->back()->with('success', 'Se ha eliminado al entrenador de la categoría');
        } else {
            return redirect()->back()->with('error', 'La relación entre el entrenador y la categoría no pudo ser encontrada.');
        }
    }


    //ENVIAR SOLICITUD
    public function register(Request $request){
        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'primer_apellido' => 'required|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',
            'segundo_apellido' => 'nullable|string|regex:/^[a-zA-ZÁáÉéÍíÓóÚúñ\s]+$/',        
            'correo_electronico' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:users'],
            'username' => 'required|unique:users|regex:/^@[a-zA-Z0-9_]+$/',
            'sexo' => 'required|in:masculino,femenino',
            'fecha_nacimiento' => 'required|date|before_or_equal:' . Carbon::now()->subYears(7)->format('Y-m-d'),
            'telefono' => 'required|numeric|digits:9',
            'password' => 'required|min:4',
            'dni' => ['required', 'regex:/^\d{8}[A-Z]$/i', 'unique:users'], 
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,JPG|max:2048',
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
            'username.regex' => 'El nombre de usuario debe de comenzar por un @.',
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
            'imagen.required' => 'La foto del nadador es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe ser mayor de 2MB.',
            'imagen.uploaded' => 'No se ha subido ninguna imagen.',
        ]);
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $nombreImagen = $nombreImagen;
        } else {
            $nombreImagen = 'login.png';
        }
   
        $solicitud = new User();
        $solicitud->nombre = $request->nombre;
        $solicitud->primer_apellido = $request->primer_apellido;
        $solicitud->segundo_apellido = $request->segundo_apellido;
        $solicitud->correo_electronico = $request->correo_electronico;
        $solicitud->username = $request->username;
        $solicitud->sexo = $request->sexo;
        $solicitud->fecha_nacimiento = $request->fecha_nacimiento;
        $solicitud->password = Hash::make($request->password);
        $solicitud->telefono = $request->telefono;
        $solicitud->imagen = $nombreImagen;
        $solicitud->tipo = 'Nadador'; 
        $solicitud->dni = $request->dni;
        $solicitud->estado = 2;
    
        $solicitud->save();

        $usuario_id = $solicitud->id;
        $categoria_id = $request->categoria;

        $solicitud->categorias()->attach($categoria_id);
    
        return redirect()->route('index')->with('success', 'La solicitud se ha enviado correctamente. Espere');
    
    }

    public function eliminar_solicitud($id){
        $solicitud = User::find($id);
        $solicitud->delete();
        return redirect()->route('verSolicitudes')->with('success', 'La solicitud ha sido eliminada');
    }

    public function aceptarSolicitud($id) {
        $solicitud = User::findOrFail($id);
        //Cambiamos el estado del usuario a 'activo'
        $solicitud->estado = 1;    
        $solicitud->save();

        return redirect()->route('verSolicitudes')->with('success', 'La solicitud ha sido aceptada');
    }

    public function mostrarNadadores() {
        $nadadores = User::where('tipo', 'Nadador')->orderBy('primer_apellido')->get();
        $categorias = UserCategoria::all();
        return view('verNadadores', compact('nadadores', 'categorias'));
    }
    
    

    public function eliminar_nadadores($id){
        //ELiminar las mínimas del nadador
        $minimas = Minima::where('idUsuario1', $id)
                       ->whereNull('idUsuario2')
                       ->whereNull('idUsuario3')
                       ->whereNull('idUsuario4')
                       ->get();

        // Iterar sobre las mínimas encontradas y eliminarlas una por una
        foreach ($minimas as $minima) {
            $minima->delete();
        }

        $nadador = User::find($id);
        $nadador->estado = 0;
        $nadador->save();
    
        return redirect()->route('verNadadores')->with('success', 'El nadador ha sido eliminado.');
    }   
}    
        
 

