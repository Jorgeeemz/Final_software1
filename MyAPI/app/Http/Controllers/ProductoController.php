<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Producto::all();
        $query = Producto::query();

        // Si el parámetro 'nombreProducto' está presente, aplica un filtro
        if ($request->has('nombreProducto')) {
            $query->where('nombreProducto', 'like', '%' . $request->input('nombreProducto') . '%');
        }

        // Si el parámetro 'costoProducto' está presente, aplica un filtro
        if ($request->has('costoProducto')) {
            $query->where('costoProducto', $request->input('costoProducto'));
        }

        // Si el parámetro 'cantidadProducto' está presente, aplica un filtro
        if ($request->has('cantidadProducto')) {
            $query->where('cantidadProducto', $request->input('cantidadProducto'));
        }

        // Si el parámetro 'descripcionProducto' está presente, aplica un filtro
        if ($request->has('descripcionProducto')) {
            $query->where('descripcionProducto', 'like', '%' . $request->input('descripcionProducto') . '%');
        }

        // Si no hay filtros, simplemente devolver todos los productos
        $Producto = $query->get();

        // Validar si está vacío
        if ($Producto->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron productos con los criterios especificados.'
            ], 404); // Código 404: No encontrado
        }

        // Si hay resultados, retornarlos
        return response()->json($Producto);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $Producto = new Producto;
        $Producto->nombreProducto = $request->input('nombreProducto');
        $Producto->costoProducto = $request->input('costoProducto');
        $Producto->cantidadProducto = $request->input('cantidadProducto');
        $Producto->descripcionProducto = $request->input('descripcionProducto');
        $Producto->save();

        return response()->json([
            'message' => 'Producto creado correctamente',
            'producto' => $Producto
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $Producto = Producto::findOrFail($id);
        return response()->json($Producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $Producto = Producto::findOrFail($id);
        $Producto->nombreProducto = $request->input('nombreProducto', $Producto->nombreProducto);
        $Producto->costoProducto = $request->input('costoProducto', $Producto->costoProducto);
        $Producto->cantidadProducto = $request->input('cantidadProducto', $Producto->cantidadProducto);
        $Producto->descripcionProducto = $request->input('descripcionProducto', $Producto->descripcionProducto);
        $Producto->save();

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'producto' => $Producto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ]);
    }
}
