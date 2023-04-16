<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    public function create()
    {
        $data['usuarios'] = User::select('idUsuario', 'name')->get();
        return view('usuarios.excluir', $data);
    }

    public function destroy(Request $request)
    {
        $idUsuario = $request->get('idUsuario');
        $usuario = User::find($idUsuario);
        $usuario->delete();

      

        $data['usuarios'] = User::select('idUsuario', 'name')->get();
        Session::flash('mensagem', 'Loja inserida com sucesso');
        return back();
        // return view('usuarios.excluir', $data);
    }
}   