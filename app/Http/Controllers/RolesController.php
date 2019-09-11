<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index (Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $rol = Roles::orderBy('id', 'desc')->paginate(3);
        } else {
            $rol = Roles::where($criterio, 'like', '%' . $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }

        return [
            'pagination' => [
                'total' => $rol->total(),
                'current_page' => $rol->currentPage(),
                'per_page' => $rol->perPage(),
                'last_page' => $rol->lastPage(),
                'from' => $rol->firstItem(),
                'to' => $rol->lastItem()
            ],
            'roles' => $rol
        ];
    }

    public function selectRol (Request $request)
    {
        $rol = Rol::where('condicion', '=', '1')
            ->select('id', 'nombre')
            ->orderBy('nombre', 'asc')->get();
        return ['roles' => $rol];
    }
}
