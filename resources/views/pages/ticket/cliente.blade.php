@extends('pages.ticket.index')

@section('content')
    <div class="p-5" style="width: 80%;">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead>
                <tr class="table-secondary">
                    <th style="width: 12%">Id</th>
                    <th style="width: 6%">Estado</th>
                    <th>Titulo</th>
                    <th style="width: 6%">Prioridad</th>
                    <th style="width: 10%">Categoría</th>
                    <th style="width: 10%">Cliente</th>
                    <th style="width: 10%">Ult. Actualización</th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>
                            @if ($ticket->estado->id == 1)
                                <span class="badge bg-danger">{{ $ticket->estado->descripcion }}</span>   
                            @elseif ($ticket->estado->id == 2)
                                <span class="badge bg-primary">{{ $ticket->estado->descripcion }}</span>
                            @elseif ($ticket->estado->id == 3)
                                <span class="badge bg-success">{{ $ticket->estado->descripcion }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $ticket->estado->descripcion }}</span>                             
                            @endif
                        </td>
                        <td>{{ $ticket->asunto }}</td>
                        <td>
                            @if ($ticket->prioridad->id == 3)
                                <span style="color: red"><i class="fa-solid fa-up-long"></i></span>
                            @elseif ($ticket->prioridad->id == 2)
                                <span style="color: orange"><i class="fa-solid fa-left-right"></i></span>       
                            @else
                                <span style="color: green"><i class="fa-solid fa-down-long"></i></span>
                            @endif
                        <td>{{ $ticket->categoria->descripcion }}</td>
                        <td>{{ $ticket->cliente_id->nombre }}</td>
                        <td>{{ $ticket->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group dropend w-100">
                                <button type="button" class="btn btn-light dropdown-toggle btn-sm"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-sliders"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('ticket.show', ['ofsys' => $ofsys, 'id' => $ticket->id]) }}">Visualizar</a>
                                    </li>
                                    @if ($ticket->estado->id !== 3 && $ticket->estado->id !== 4)
                                        <li>
                                            <a style="cursor: pointer" class="dropdown-item eliminar-ticket" data-ticket-id="{{ $ticket->id }}">Eliminar</a>
                                        </li>                                    
                                    @endif                                    
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-100 d-flex justify-content-center">
            {{ $tickets->links() }}
        </div>        
    </div>
@endsection
