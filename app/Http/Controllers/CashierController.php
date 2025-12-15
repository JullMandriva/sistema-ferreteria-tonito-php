<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Importar el Modelo Product
use App\Models\Venta; // Usaremos el modelo Venta
use App\Models\DetalleVenta; // Usaremos el modelo DetalleVenta
use Illuminate\Support\Facades\DB; // Para transacciones

class CashierController extends Controller
{
    /**
     * Muestra la interfaz principal del TPV.
     */
    public function index()
    {
        return view('ventas.index');
    }

    /**
     * Busca productos por SKU o nombre para el TPV (AJAX).
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('codigo_sku', 'LIKE', "%$query%")
            ->orWhere('nombre', 'LIKE', "%$query%")
            ->where('cantidad', '>', 0) // Solo productos con stock > 0
            ->limit(10) 
            ->get(['id', 'nombre', 'codigo_sku', 'precio', 'cantidad']);

        return response()->json($products);
    }

    /**
     * Procesa y guarda una nueva venta, descontando el stock.
     */
    public function store(Request $request)
    {
        // Validación básica (deberías expandirla)
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:productos,id',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // 1. Crear el registro de Venta
            $venta = Venta::create([
                'user_id' => auth()->id(), // Usuario autenticado (vendedor)
                'fecha_venta' => now(),
                'total_final' => $request->total,
                // Puedes añadir campos para cliente, tipo de pago, etc.
            ]);

            $totalVenta = 0;

            // 2. Procesar cada ítem del carrito
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);

                if (!$product || $product->cantidad < $item['quantity']) {
                    DB::rollBack();
                    return back()->with('error', 'Stock insuficiente para el producto: ' . $product->nombre);
                }

                // 2.1. Descontar el stock
                $product->cantidad -= $item['quantity'];
                $product->save();

                // 2.2. Crear el Detalle de Venta
                $subtotal = $product->precio * $item['quantity'];
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'product_id' => $product->id,
                    'cantidad_vendida' => $item['quantity'],
                    'precio_unitario' => $product->precio,
                    'subtotal' => $subtotal,
                ]);

                $totalVenta += $subtotal;
            }

            // 3. Confirmar la transacción
            DB::commit();

            return redirect()->route('ventas.index')->with('success', '¡Venta procesada con éxito! Total: S/. ' . number_format($venta->total_final, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la venta. Intente de nuevo. (Detalle: ' . $e->getMessage() . ')');
        }
    }
}