<?php
namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Espectador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteAuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('cliente_id')) {
            return redirect()->route('cliente.dashboard');
        }
        return view('cliente.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'O email é obrigatório.',
            'email.email'       => 'Insere um email válido.',
            'password.required' => 'A password é obrigatória.',
        ]);

        $cliente = Espectador::where('email', $request->email)->first();

        if (!$cliente || !Hash::check($request->password, $cliente->password)) {
            return back()->withErrors(['email' => 'Email ou password incorretos.'])->withInput();
        }

        session([
            'cliente_id'   => $cliente->cod_espectador,
            'cliente_nome' => $cliente->nome,
            'cliente_email'=> $cliente->email,
        ]);

        return redirect()->route('cliente.dashboard');
    }

    public function showRegister()
    {
        if (session()->has('cliente_id')) {
            return redirect()->route('cliente.dashboard');
        }
        return view('cliente.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:espectador,email',
            'contacto'              => 'required|string|max:20',
            'password'              => 'required|min:8|confirmed',
        ], [
            'nome.required'         => 'O nome é obrigatório.',
            'email.required'        => 'O email é obrigatório.',
            'email.unique'          => 'Este email já está registado.',
            'contacto.required'     => 'O telemóvel é obrigatório.',
            'password.min'          => 'A password deve ter pelo menos 8 caracteres.',
            'password.confirmed'    => 'As passwords não coincidem.',
        ]);

        $cliente = Espectador::create([
            'nome'     => $request->nome,
            'email'    => $request->email,
            'contacto' => $request->contacto,
            'password' => Hash::make($request->password),
        ]);

        session([
            'cliente_id'    => $cliente->cod_espectador,
            'cliente_nome'  => $cliente->nome,
            'cliente_email' => $cliente->email,
        ]);

        return redirect()->route('cliente.dashboard')
            ->with('success', 'Bem-vindo ao Cinema! A tua conta foi criada com sucesso.');
    }

    public function logout()
    {
        session()->forget(['cliente_id', 'cliente_nome', 'cliente_email']);
        return redirect()->route('cliente.login')
            ->with('success', 'Sessão terminada com sucesso.');
    }
}
