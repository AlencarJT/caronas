<?php

    use App\Http\Controllers\Api\PessoaController;
    use App\Http\Controllers\Api\ReservaCaronaController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\CaronaController;

    Route::get('/caronas', [CaronaController::class, 'index']);

    Route::post('/pessoa',                  [PessoaController::class,        'store']);
    Route::post('/carona',                  [CaronaController::class,        'store']);
    Route::get('/obter_pessoas',            [PessoaController::class,        'index']);
    Route::get('/buscar/{cd_pessoa}',       [PessoaController::class,        'obterPessoa']);
    Route::post('/reservas',                [ReservaCaronaController::class, 'store']);
    Route::delete('/excluir_reserva/{cd_reserva}', [ReservaCaronaController::class, 'destroy']);
