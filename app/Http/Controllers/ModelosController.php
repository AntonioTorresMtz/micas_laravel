<?php

namespace App\Http\Controllers;
use App\Models\Modelos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModelosController extends Controller
{
    public function index()
    {
        $modelos = Modelos::all();
        // Devuelve los datos como una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Consulta exitosa',
            'codigo' => 200,
            'data' => $modelos
        ], 200);
    }

    public function obtenerModeloMarca($id)
    {
        $modelos = Modelos::where('marca', $id)
            ->orderBy('nombre', 'asc')
            ->get(['id_modelo', 'nombre']);

        // Devuelve los datos como una respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Consulta exitosa',
            'codigo' => 200,
            'data' => $modelos
        ], 200);
    }

    public function obtenerMicaNormal($id)
    {
        // Realizamos la consulta con Query Builder utilizando el parámetro $id
        $micas = DB::table('micas9h as mi')
            ->join('marca as ma', 'ma.id_marca', '=', 'mi.marca')
            ->join('posicion as p', 'p.id_posicion', '=', 'mi.posicion')
            ->join('nombre_mica9h as nm', 'nm.id_mica9h', '=', 'mi.id_mica9h')
            ->join('modelos as mo', 'mo.id_modelo', '=', 'nm.nombre_modelo')
            ->select(
                'ma.marca',
                'mi.notas',
                'mi.cantidad',
                'mi.ancho',
                'mi.largo',
                'p.muro',
                'p.nombre',
                DB::raw('GROUP_CONCAT(" ", ma.marca, " ", mo.nombre) AS modelos'),
                'nm.id_mica9h'
            )
            ->groupBy('mi.id_mica9h', 'ma.marca', 'mi.cantidad', 'p.muro', 'p.nombre', 'nm.id_mica9h', 'mi.notas', 'mi.ancho', 'mi.largo', 'p.muro', 'p.nombre')
            ->havingRaw('SUM(mo.id_modelo = ?) > 0', [$id])
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Consulta exitosa',
            'codigo' => 200,
            'data' => $micas
        ], 200);
    }

    public function obtenerMicaCompleta($id)
    {
        // Realizamos la consulta con Query Builder utilizando el parámetro $id
        $micas = DB::table('micas9d as mi')
            ->join('marca as ma', 'ma.id_marca', '=', 'mi.marca')
            ->join('posicion as p', 'p.id_posicion', '=', 'mi.posicion')
            ->join('nombre as nm', 'nm.id_mica', '=', 'mi.id_mica9d')
            ->join('modelos as mo', 'mo.id_modelo', '=', 'nm.nombre_modelo')
            ->select(
                'ma.marca',
                'mi.notas',
                'mi.cantidad',
                'mi.ancho',
                'mi.largo',
                'p.muro',
                'p.nombre',
                DB::raw('GROUP_CONCAT(" ", ma.marca, " ", mo.nombre) AS modelos'),
                'nm.id_mica'
            )
            ->groupBy('mi.id_mica9d', 'ma.marca', 'mi.cantidad', 'p.muro', 'p.nombre', 'nm.id_mica', 'mi.notas', 'mi.ancho', 'mi.largo', 'p.muro', 'p.nombre')
            ->havingRaw('SUM(mo.id_modelo = ?) > 0', [$id])
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Consulta exitosa',
            'codigo' => 200,
            'data' => $micas
        ], 200);
    }
}
