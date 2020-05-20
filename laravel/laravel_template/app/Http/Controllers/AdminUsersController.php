<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("admin.users.index", compact("users"));
    }

    public function create()
    {
        $rols = Rol::all();
        return view('admin/users/create', compact('rols'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $obtenerFormulario = $request->all();
      if ($archivo = $request->file('file_foto_perfil')) {
             $nombre = $archivo->getClientOriginalName();
             $archivo->move('image', $nombre);
             $obtenerFormulario['user_foto_ruta']="$nombre";
      }
      $obtenerFormulario['password']=bcrypt($request->password);
      User::create($obtenerFormulario);
      return redirect( 'admin/users');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $rols = Rol::all();
      $user = User::findOrFail($id);
      return view('admin.users.edit', compact("user"), compact("rols"));
    }

    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);
      $user->update($request->all());
      return redirect( "admin/users");
    }

    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->delete();
      return redirect('admin/users/');
    }
}
