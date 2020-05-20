<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rol;

class AdminRolsController extends Controller
{
    public function index()
    {
        $rols = Rol::all();
        return view("admin.rols.index", compact("rols"));
    }

    public function create()
    {
        return view('admin/rols/create');
    }

    public function store(Request $request)
    {
      $obtenerFormulario = $request->all();
      Rol::create($obtenerFormulario);
      return redirect( 'admin/rols');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
