<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:gestor,coordenador',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Conta criada com sucesso!');
    }

    public function edit(User $user)
    {
        // Não pode editar o superadmin
        if ($user->isSuperAdmin()) {
            abort(403, 'Não podes editar a conta principal.');
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            abort(403);
        }

        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:gestor,coordenador',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Conta atualizada com sucesso!');
    }

    public function destroy(User $user)
    {
        if ($user->isSuperAdmin()) {
            abort(403, 'Não podes eliminar a conta principal.');
        }

        if ($user->id === auth()->id()) {
            abort(403, 'Não podes eliminar a tua própria conta.');
        }

        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'Conta eliminada com sucesso!');
    }
}