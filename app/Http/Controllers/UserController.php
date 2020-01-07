<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $usuarios = [];

        if ($buscar == ''){
            
            $usuarios = User::join('rol', 'users.idrol', '=', 'rol.id')
                ->select('users.nombre','users.email','users.password', 'users.condicion', 'users.idrol', 'rol.nombre as rol')
                ->where('users.'.$criterio, 'like', '%'.$buscar.'%')
                ->orderBy('users.nombre', 'asc')->paginate(3);
        }else{
            $usuarios = User::join('rol', 'users.idrol', '=', 'rol.id')
                ->select('users.nombre','users.email','users.password', 'users.condicion', 'users.idrol', 'rol.nombre as rol')
                ->where('users.'.$criterio, 'like', '%'.$buscar.'%')
                ->orderBy('users.nombre', 'asc')->paginate(3);
        }

        return [
            'pagination' => [
                'total'         => $usuarios->total(),
                'current_page'  => $usuarios->currentPage(),
                'per_page'      => $usuarios->perPage(),
                'last_page'     => $usuarios->lastPage(),
                'from'          => $usuarios->firstItem(),
                'to'            => $usuarios->lastItem()
            ],
            'personas'    => $usuarios
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

            DB::beginTransaction();
            $user = new User();
            $user->usuario = $request->usuario;
            $user->nombre = $request->nombre;
            $user->password = bcrypt($request->password);
            $user->condicion = 1;
            $user->idrol = $request->idrol;
            $user->save();
            DB::commit();

        }catch (Exception $exception){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            //Buscar al proveedor a modificar
            $user = User::findOrFail($request->id);
            $persona = Persona::findOrFail($user->id);


            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password);
            $user->condicion = 1;
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
        }

    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

}
