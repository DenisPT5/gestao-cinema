<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Espectador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientePerfilController extends Controller
{
    public function index()
    {
        $cliente = Espectador::find(session('cliente_id'));
        return view('cliente.perfil.index', compact('cliente'));
    }

    public function update(Request $request)
    {
        $cliente = Espectador::find(session('cliente_id'));

        $request->validate([
            'nome'     => 'required|string|max:100',
            'email'    => 'required|email|unique:espectador,email,' . $cliente->cod_espectador . ',cod_espectador',
            'contacto' => 'required|string|max:20',
        ]);

        $cliente->update([
            'nome'     => $request->nome,
            'email'    => $request->email,
            'contacto' => $request->contacto,
        ]);

        session(['cliente_nome' => $request->nome, 'cliente_email' => $request->email]);

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $cliente = Espectador::find(session('cliente_id'));

        $request->validate([
            'password_atual' => 'required',
            'password'       => 'required|min:8|confirmed',
        ], [
            'password.min'       => 'A nova password deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'As passwords não coincidem.',
        ]);

        if (!Hash::check($request->password_atual, $cliente->password)) {
            return back()->withErrors(['password_atual' => 'A password atual está incorreta.']);
        }

        $cliente->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password alterada com sucesso!');
    }
}
