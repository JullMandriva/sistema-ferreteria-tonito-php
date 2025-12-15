<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\HistorialCambio; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage; 
// Importar para usar la función is_dir y mkdir
use Illuminate\Support\Facades\File; 

class ProductController extends Controller
{
    // AÑADIDO: CONSTRUCTOR PARA RESTRINGIR EL ACCESO POR ROL
    public function __construct()
    {
        $this->middleware('auth'); 

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            
            if (!$user) {
                return redirect('/login');
            }

            // Define las rutas que requieren permisos de CREAR/EDITAR (Admin o Almacenero)
            $rutasModificacion = [
                'dashboard.create', 
                'dashboard.store', 
                'dashboard.edit', 
                'dashboard.update'
            ];
            
            // Proteger Creación y Edición
            if ($request->routeIs($rutasModificacion)) {
                if (!$user->isAdmin() && !$user->isAlmacenero()) {
                    return redirect()->route('dashboard')->with('error', 'Acceso denegado. No tienes permisos para crear o modificar productos.');
                }
            }

            // Proteger Eliminación (solo Admin puede hacerlo)
            if ($request->routeIs('dashboard.destroy')) {
                if (!$user->isAdmin()) {
                    return redirect()->route('dashboard')->with('error', 'Acceso denegado. Solo un Administrador puede eliminar productos.');
                }
            }

            return $next($request);
        })->except(['index', 'checkSku']); 
    }

    /**
     * Mostrar productos + buscador
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');

            $query->where(function ($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('codigo_sku', 'LIKE', "%{$searchTerm}%");
            });
        }

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
        $user = Auth::user();
        
        // Regla de Precio Condicional
        $precioRules = ($user->isAlmacenero()) 
            ? ['nullable', 'numeric', 'min:0.00'] 
            : ['required', 'numeric', 'min:0.01'];

        // 1. Validamos los datos con MENSAJES PERSONALIZADOS
        $request->validate([
            'nombre' => 'required|max:100',
            'codigo_sku' => 'required|unique:productos,codigo_sku|max:50', 
            'precio' => $precioRules, 
            'cantidad' => 'required|integer|min:0',
            'descripcion' => 'nullable',
            'ubicacion' => 'nullable|string|max:50', 
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ], [
            // --- MENSAJES EN ESPAÑOL ---
            'codigo_sku.unique' => '¡Alto ahí! Este código SKU ya está registrado en otro producto.',
            'codigo_sku.required' => 'El código SKU es obligatorio.',
            'nombre.required' => 'Por favor escribe el nombre del producto.',
            'precio.required' => 'El precio es obligatorio.',
            'cantidad.required' => 'El stock es obligatorio.',
            'cantidad.integer' => 'El stock debe ser un número entero.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o webp.',
            'imagen.max' => 'La imagen no debe pesar más de 2MB.',
        ]);

        // 2. Lógica para manejar la subida de la imagen (USANDO move() DIRECTO)
        $imageName = null;
        if ($request->hasFile('imagen')) {
            // Generar un nombre único basado en el tiempo y SKU
            $imageName = time() . '-' . $request->codigo_sku . '.' . $request->imagen->extension();
            
            // Definir la ruta física de destino (storage/app/public/images/products)
            $destinationPath = storage_path('app/public/images/products'); 
            
            // Asegurarse de que la carpeta exista y sea escribible
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true, true); 
            }

            // Mover el archivo subido desde la carpeta temporal al destino final
            // Esto usa la función move() del archivo subido.
            $request->imagen->move($destinationPath, $imageName); 
        }

        // 3. Crear el producto
        $data = $request->only('nombre', 'descripcion', 'precio', 'cantidad', 'codigo_sku', 'ubicacion');
        
        if ($user->isAlmacenero() && !isset($data['precio'])) {
            $data['precio'] = 0.00; 
        }
        
        $data['imagen'] = $imageName; // Añadir el nombre de la imagen a los datos
        
        $product = Product::create($data);

        // 4. Guardar en Historial Oculto
        $ubiTexto = $product->ubicacion ? " | Ubicación: {$product->ubicacion}" : "";

        HistorialCambio::create([
            'usuario' => Auth::user()->name, 
            'accion'  => 'CREAR',
            'producto'=> $product->nombre,
            'detalles'=> "Stock inicial: {$product->cantidad} | Precio: S/. {$product->precio}" . $ubiTexto . ($imageName ? ' | Con imagen' : ''),
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
        $user = Auth::user();

        // Regla de Precio Condicional
        $precioRules = ($user->isAlmacenero()) 
            ? ['nullable', 'numeric', 'min:0.00'] 
            : ['required', 'numeric', 'min:0.01']; 

        $request->validate([
            'nombre' => 'required|max:100',
            'codigo_sku' => [
                'required',
                Rule::unique('productos', 'codigo_sku')->ignore($product->id),
                'max:50'
            ],
            'precio' => $precioRules,
            'cantidad' => 'required|integer|min:0|max:999999',
            'descripcion' => 'nullable',
            'ubicacion' => 'nullable|string|max:50',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ], [
            // --- MENSAJES EN ESPAÑOL ---
            'codigo_sku.unique' => 'Este SKU ya pertenece a otro producto. Intenta con uno diferente.',
            'codigo_sku.required' => 'El código SKU es obligatorio.',
            'nombre.required' => 'El nombre es obligatorio.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o webp.',
            'imagen.max' => 'La imagen no debe pesar más de 2MB.',
        ]);

        // Lógica de actualización de imagen (USANDO move() DIRECTO)
        $data = $request->only('nombre', 'descripcion', 'precio', 'cantidad', 'codigo_sku', 'ubicacion');
        $oldImageName = $product->imagen;
        $destinationPath = storage_path('app/public/images/products'); 

        if ($request->hasFile('imagen')) {
            // Subir la nueva imagen
            $newImageName = time() . '-' . $request->codigo_sku . '.' . $request->imagen->extension();
            
            // Asegurarse de que la carpeta exista
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true, true); 
            }
            
            // Mover el archivo subido
            $request->imagen->move($destinationPath, $newImageName);
            $data['imagen'] = $newImageName; // Asignar la nueva imagen
            
            // Eliminar la imagen anterior si existe
            if ($oldImageName) {
                File::delete($destinationPath . '/' . $oldImageName);
            }
        } else if ($request->input('remove_image')) { 
             if ($oldImageName) {
                File::delete($destinationPath . '/' . $oldImageName);
            }
            $data['imagen'] = null; // Quitar la imagen de la BD
        } else {
             // Mantener la imagen existente si no se sube una nueva y no se pide eliminar
             $data['imagen'] = $oldImageName;
        }

        // Resto de la lógica (Stock, Precio condicional, Historial)
        $stockAntiguo = $product->cantidad;
        $precioAntiguo = $product->precio;
        $nombreAntiguo = $product->nombre;
        $ubicacionAntigua = $product->ubicacion;
        
        if ($user->isAlmacenero() && !isset($data['precio'])) {
            $data['precio'] = $product->precio;
        }

        // Actualizar el producto
        $product->update($data);

        // Comparar cambios para el historial
        $detalles = [];
        if ($stockAntiguo != $product->cantidad) {
            $detalles[] = "Stock: $stockAntiguo -> $product->cantidad";
        }
        if (!$user->isAlmacenero() && $precioAntiguo != $product->precio) {
             $detalles[] = "Precio: S/. $precioAntiguo -> S/. $product->precio";
        }
        if ($nombreAntiguo != $product->nombre) {
            $detalles[] = "Nombre cambiado";
        }
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
        // 1. Eliminar la imagen asociada si existe
        if ($product->imagen) {
            $destinationPath = storage_path('app/public/images/products');
            File::delete($destinationPath . '/' . $product->imagen);
        }
        
        $nombreProducto = $product->nombre;
        $product->delete();

        // Guardar en Historial
        HistorialCambio::create([
            'usuario' => Auth::user()->name,
            'accion'  => 'ELIMINAR',
            'producto'=> $nombreProducto,
            'detalles'=> "El producto fue eliminado permanentemente. (Imagen eliminada si existía)",
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