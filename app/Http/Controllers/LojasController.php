<?php

namespace App\Http\Controllers;

use App\Models\Lojas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LojasController extends Controller
{
    public function index()
    {
        $data['lojas'] = Lojas::select('idLoja', 'Nome')->where('deleted_at', NULL)->get();
        $data['mensagem'] = session('mensagem');
        return view('lojas.index', $data);
    }
    public function create(Request $request)
    {
        $Nome = $request->get('Nome');
        $idLoja = Lojas::create([
            'Nome' => $Nome
        ]);

        Session::flash('mensagem', 'Loja inserida com sucesso');
        return back();
    }
    public function listarLoja(Request $request)
    {
        $idLoja = $request->get('idLoja');

        $lojas = Lojas::select('idLoja', 'Nome')->where('idLoja', $idLoja)->get();
        return response()->json($lojas);
    }
    public function update(Request $request)
    {
        $idLoja = $request->get('idLoja');
        $Nome = $request->get('Nome');

        Lojas::where('idLoja', $idLoja)->update(['Nome' => $Nome]);

        Session::flash('mensagem', 'Loja editado com sucesso');
        return back();
    }
    public function delete(Request $request)
    {
        $idLoja = $request->get('idLoja');

        Lojas::where('idLoja', $idLoja)->delete();

        return response()->json('Sucesso');
    }
}
