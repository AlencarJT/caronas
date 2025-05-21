<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carona;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
    {
        dd(Pessoa::all());
        Pessoa::all();
//        $Pessoas = Pessoa::get();

//        return response()->json($Pessoas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nm_pessoa'      => 'required|string|max:255',
            'cd_cidade'      => 'required',
            'nr_cpf'         => 'required|string|size:11',
            'id_sexo'        => 'required|in:1,2,3',
            'dt_nascimento'  => 'required|date',
        ]);

        $pessoa = Pessoa::create($validated);

        return response()->json($pessoa, 201);
    }

    public function obterPessoa($cd_pessoa)
    {
        $pessoa = Pessoa::find($cd_pessoa);

        if (!$pessoa)
            return response()->json(['mensagem' => 'Pessoa não encontrada'], 404);

        return response()->json($pessoa);
    }
}
