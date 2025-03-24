<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use App\Http\Requests\StoreMarcasRequest;
use App\Http\Requests\UpdateMarcasRequest;

class MarcasController extends Controller
{

    public function index()
    {
        // Consulta los datos de la tabla 'users'
        $marcas = Marcas::all();

        // Devuelve los datos como una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Consulta exitosa',
            'codigo' => 200,
            'data' => $marcas
        ], 200);
    }


}
