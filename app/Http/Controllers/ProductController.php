<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\HistorialCambio; // Modelo para el historial
use Illuminate\Support\Facades\Auth; // Para obtener el usuario actual
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Mostrar productos + buscador
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtro de búsqueda
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');

            $query->where(function ($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('codigo_sku', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Paginación + orden descendente (lo nuevo primero)
        $products = $query->orderBy('id', 'desc')->paginate(10);

        return view('dashboard', [
            'products' => $products,
            'search' => $request->search
        ]);
    }

    /**
     * Formulario para crear producto
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Guardar nuevo producto (Con validación en ESPAÑOL)
     */
    public function store(Request $request)
    {
        // 1. Validamos los datos con mensajes personalizados
        $request->validate([
            'nombre' => 'required|max:100',
            'codigo_sku' => 'required|unique:products,codigo_sku|max:50',
            'precio' => 'required|numeric|min:0.01',
            'cantidad' => 'required|integer|min:0',
            'descripcion' => 'nullable',
            // Agregamos la validación para ubicación
            'ubicacion' => 'nullable|string|max:50', 
        ], [
            // --- MENSAJES EN ESPAÑOL ---
            'codigo_sku.unique' => '¡Alto ahí! Este código SKU ya está registrado en otro producto.',
            'codigo_sku.required' => 'El código SKU es obligatorio.',
            'nombre.required' => 'Por favor escribe el nombre del producto.',
            'precio.required' => 'El precio es obligatorio.',
            'cantidad.required' => 'El stock es obligatorio.',
            'cantidad.integer' => 'El stock debe ser un número entero.',
            'precio.numeric' => 'El precio debe ser un número válido.',
        ]);

        // 2. Crear el producto (Incluyendo ubicación)
        $product = Product::create($request->only('nombre', 'descripcion', 'precio', 'cantidad', 'codigo_sku', 'ubicacion'));

        // 3. Guardar en Historial Oculto
        // Usamos el operador ?? '' por si la ubicación viene vacía
        $ubiTexto = $product->ubicacion ? " | Ubicación: {$product->ubicacion}" : "";

        HistorialCambio::create([
            'usuario' => Auth::user()->name, 
            'accion'  => 'CREAR',
            'producto'=> $product->nombre,
            'detalles'=> "Stock inicial: {$product->cantidad} | Precio: S/. {$product->precio}" . $ubiTexto,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Producto registrado exitosamente.');
    }

    /**
     * Formulario para editar producto
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Actualizar producto (Con validación en ESPAÑOL)
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'codigo_sku' => [
                'required',
                Rule::unique('products', 'codigo_sku')->ignore($product->id),
                'max:50'
            ],
            'precio' => 'required|numeric|min:0.01',
            'cantidad' => 'required|integer|min:0|max:999999',
            'descripcion' => 'nullable',
            // FALTABA ESTO: Validación de ubicación al editar
            'ubicacion' => 'nullable|string|max:50',
        ], [
            // --- MENSAJES EN ESPAÑOL ---
            'codigo_sku.unique' => 'Este SKU ya pertenece a otro producto. Intenta con uno diferente.',
            'codigo_sku.required' => 'El código SKU es obligatorio.',
            'nombre.required' => 'El nombre es obligatorio.',
        ]);

        // Capturar datos antiguos para el historial
        $stockAntiguo = $product->cantidad;
        $precioAntiguo = $product->precio;
        $nombreAntiguo = $product->nombre;
        $ubicacionAntigua = $product->ubicacion; // Capturamos ubicación vieja

        // Actualizar el producto (Incluyendo ubicación)
        $product->update($request->only('nombre', 'descripcion', 'precio', 'cantidad', 'codigo_sku', 'ubicacion'));

        // Comparar cambios para el historial
        $detalles = [];
        if ($stockAntiguo != $product->cantidad) {
            $detalles[] = "Stock: $stockAntiguo -> $product->cantidad";
        }
        if ($precioAntiguo != $product->precio) {
            $detalles[] = "Precio: S/. $precioAntiguo -> S/. $product->precio";
        }
        if ($nombreAntiguo != $product->nombre) {
            $detalles[] = "Nombre cambiado";
        }
        // Detectamos si cambió la ubicación
        if ($ubicacionAntigua != $product->ubicacion) {
            $oldUbi = $ubicacionAntigua ?? 'Sin asignar';
            $newUbi = $product->ubicacion ?? 'Sin asignar';
            $detalles[] = "Ubicación: $oldUbi -> $newUbi";
        }
        
        $textoDetalles = count($detalles) > 0 ? implode(' | ', $detalles) : "Actualización de datos (SKU/Descripción)";

        // Guardar en Historial
        HistorialCambio::create([
            'usuario' => Auth::user()->name,
            'accion'  => 'EDITAR',
            'producto'=> $product->nombre,
            'detalles'=> $textoDetalles,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar producto
     */
    public function destroy(Product $product)
    {
        $nombreProducto = $product->nombre;
        $product->delete();

        // Guardar en Historial
        HistorialCambio::create([
            'usuario' => Auth::user()->name,
            'accion'  => 'ELIMINAR',
            'producto'=> $nombreProducto,
            'detalles'=> "El producto fue eliminado permanentemente.",
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Verificar SKU (Para uso interno o JS si se requiere)
     */
    public function checkSku(Request $request)
    {
        $sku = $request->get('sku');
        $exists = Product::where('codigo_sku', $sku)->exists();
        return response()->json(['exists' => $exists]);
    }
}