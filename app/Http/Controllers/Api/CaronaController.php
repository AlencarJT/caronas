<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Carona;
    use App\Models\Pessoa;
    use App\Models\ReservaCarona;
    use Illuminate\Http\Request;

    class CaronaController extends Controller
    {
        public function index()
        {
            $caronasDisponiveis = Carona::where('nr_vagas', '>', 0)
            ->with(['cidadeOrigem', 'cidadeDestino', 'veiculo'])
            ->get();

            return response()->json($caronasDisponiveis);
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'cd_veiculo'        => 'required|integer',
                'cd_cidade_origem'  => 'required|integer',
                'cd_cidade_destino' => 'required|integer',
                'dt_carona'         => 'required',
                'hr_carona'         => 'required',
                'nr_vagas'          => 'required',
                'ds_observacao'     => 'nullable|string|max:1000',
            ]);

            try
            {
                $carona = Carona::create($validated);
            }
            catch (\Exception $e)
            {

                return response()->json($e->getMessage(), 201);
            }

            return response()->json("Carona salva com sucesso!", 201);
        }
    }
