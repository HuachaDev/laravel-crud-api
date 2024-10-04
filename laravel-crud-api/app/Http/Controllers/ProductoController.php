<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProductoController extends Controller
{
    public function index()
    {

        $productos = Producto::get(['nombre', 'descripcion', 'precio', 'cantidad_stock']);
        return response()->json($productos,200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad_stock' => 'required|integer|min:0',
        ]);

        $producto = Producto::create($validatedData);

        return response()->json([
            'id' => $producto->id,
            'nombre' => $producto->descripcion,
            'precio' => $producto->precio,
            'cantidad_stock' => $producto->cantidad_stock,
            "created_at"  => $producto->created_at->format('Y-m-d H:i:s')
         ],200);
    }

    public function show($id)
    {

        $producto = Producto::findOrFail($id, ['id', 'nombre', 'descripcion', 'precio', 'cantidad_stock', 'created_at']);
        return response()->json([
            'id' => $producto->id,
            'nombre' => $producto->descripcion,
            'precio' => $producto->precio,
            'cantidad_stock' => $producto->cantidad_stock,
            "created_at"  => $producto->created_at->format('Y-m-d H:i:s')
         ],200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|required|numeric|min:0',
            'cantidad_stock' => 'sometimes|required|integer|min:0',
            'descuento_stock' => 'sometimes|integer|min:1',
        ]);

        $producto = Producto::findOrFail($id);

        if (isset($validatedData['descuento_stock'])) {
            $nuevoStock = $producto->cantidad_stock - $validatedData['descuento_stock'];

            if ($nuevoStock < 0) {
                return response()->json(['error' => 'El stock no puede ser negativo.'], 400);
            }
    
            $producto->cantidad_stock = $nuevoStock;
        }

        $producto->update($validatedData);
        return response()->json([
            'nombre' => $producto->descripcion,
            'precio' => $producto->precio,
            'cantidad_stock' => $producto->cantidad_stock,
            "updated_at"  => $producto->updated_at->format('Y-m-d H:i:s')
         ],200);
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id); 
            $nombreProducto = $producto->nombre;
            $producto->delete();
            return response()->json(['message' => "Producto '{$nombreProducto}' eliminado con éxito."], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }
    }
}
