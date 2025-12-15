@extends('layouts.guest')

@section('title', 'Historial de Movimientos')

@section('content')
<div class="container pt-3 pb-5">

    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h1 class="display-6 fw-bold text-dark"><i class="bi bi-clock-history"></i> Historial de Inventario</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-return-left"></i> Volver</a>
    </div>

    {{-- Tabla Responsive del Historial --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha y Hora</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Acción</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($historial as $registro)
                    <tr>
                        <td>{{ $registro->id }}</td>
                        <td>
                            <span class="d-block small text-muted">{{ $registro->created_at->format('d/M/Y') }}</span>
                            <span class="d-block fw-bold">{{ $registro->created_at->format('h:i:s A') }}</span>
                        </td>
                        <td class="small">{{ $registro->usuario }}</td>
                        <td>
                            @if ($registro->accion == 'CREAR')
                                <span class="badge bg-primary">CREADO</span>
                            @elseif ($registro->accion == 'EDITAR')
                                <span class="badge bg-info text-dark">EDITADO</span>
                            @elseif ($registro->accion == 'ELIMINAR')
                                <span class="badge bg-danger">ELIMINADO</span>
                            @elseif ($registro->accion == 'VENTA')
                                <span class="badge bg-success">VENTA</span>
                            @else
                                <span class="badge bg-secondary">{{ $registro->accion }}</span>
                            @endif
                        </td>
                        <td>{{ $registro->producto }}</td>
                        <td class="small text-wrap" style="max-width: 300px;">{{ $registro->detalles }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay registros de movimientos en el historial.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $historial->links() }}
    </div>

</div>
@endsection