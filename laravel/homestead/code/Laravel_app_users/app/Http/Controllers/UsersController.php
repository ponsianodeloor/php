<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
     //$usuarios = User::paginate(10);
     //return view('users.index', compact("usuarios"));
     set_time_limit(0);
     //$users = User::orderBy('id', 'DESC')->get();
     //return $users;
     $users = User::orderBy('id', 'DESC')->paginate(4);
     return [
      'pagination' => [
        'total' => $users->total(),
        'currentPage' => $users->currentPage(),
        'per_page' => $users->perPage(),
        'last_page' => $users->lastPage(),
        'from' => $users->firstItem(),
        'to' => $users->lastPage(),
      ],
      'users' => $users
     ];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
         'status'=>'required',
         'name'=>'required',
         'email'=>'required'
        ]);

        User::create($request->all());
        return;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $user = User::findOrFail($id);
      //return view("users.edit", compact("user"));
      return $user;
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
       'status'=>'required',
       'name'=>'required',
       'email'=>'required'
      ]);

      $user = User::findOrFail($id);
      $user->update($request->all());
      return;
      //return redirect( "/users");

      //$edit = Socio::find($id)->update($request->all());

        //return response()->json($edit);
    }

    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->delete();
    }
}
