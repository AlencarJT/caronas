<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carona;
use App\Models\Pessoa;
use App\Models\ReservaCarona;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReservaCaronaController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->validate([
            "cd_pessoa"   => "required",
            "cd_carona"   => "required",
            "qt_vagas"    => "required|integer|min:1",
        ]);

        $data['dt_reserva'] = now()->toDateString();
        $data['hr_reserva'] = now()->toTimeString();

        try
        {
            $pessoa = Pessoa::findOrFail($request->cd_pessoa);
            $carona = Carona::findOrFail($request->cd_carona);
        }
        catch (ModelNotFoundException $e)
        {
            $model = $e->getModel();

            if ($model === Pessoa::class)
                return response()->json(['erro' => 'Pessoa não encontrada'], 404);

            if ($model === Carona::class)
                return response()->json(['erro' => 'Carona não encontrada'], 404);

            return response()->json(['erro' => 'Recurso não encontrado'], 404);
        }

        if ($carona->nr_vagas < $data['qt_vagas'])
            return response()->json(['mensagem' => 'Vagas insuficientes'], 400);

        // Criar a reserva
        $reserva = ReservaCarona::create($data);

        // Atualizar vagas disponíveis
        $carona->nr_vagas -= $data['qt_vagas'];
        $carona->save();

        return response()->json([
            'mensagem' => 'Reserva realizada com sucesso!',
            'reserva'  => $reserva
        ], 201);
    }

    public function destroy($cd_reserva)
    {
        try
        {
            $reserva = ReservaCarona::findOrFail($cd_reserva);
            $carona = $reserva->carona;

            // Devolver vagas para a carona
            $carona->nr_vagas += $reserva->qt_vagas;
            $carona->save();

            // Excluir a reserva
            $reserva->delete();

            return response()->json(['mensagem' => 'Reserva cancelada com sucesso.'], 200);
        }
        catch (ModelNotFoundException $e)
        {
            return response()->json(['erro' => 'Reserva não encontrada.'], 404);
        }
    }
}
