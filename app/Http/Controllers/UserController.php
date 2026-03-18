<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $response['users'] = User::orderByDesc('created_at')->get();
        return view('admin.user.index', $response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string']
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->save();

        return redirect()->back()->with('success', 'Cadastrado com Sucesso!');
    }

    public function show($id)
    {
        $response['user'] = User::findOrFail($id);
        return view('admin.user.details.index', $response);
    }

    public function edit($id)
    {
        $response = User::findOrFail($id);
        return view('admin.user.edit', $response);
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string']
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->update();

        return redirect()->back()->with('success', 'Atualizado com Sucesso!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'Deletado com Sucesso!');
    }
}
