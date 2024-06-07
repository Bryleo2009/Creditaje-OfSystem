@extends('pages.ticket.index')

@section('content')
    <div class="d-flex flex-wrap" style="width: 90%;">
        <div class="container {{ $view ? 'col-5' : 'col-12' }}" style="{{ $view ? 'max-height: 60vh;' : '' }}">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center mt-3 mb-5">
                        @if ($view)
                            {{ $ticket->id }}
                        @else
                            Nuevo Ticket
                        @endif
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form class="row justify-content-between" id="formTicket" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 col-5">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select class="form-select w-100" id="cliente" name="cliente" required>
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-3">
                        </div>
                        <div class="mb-3 col-2">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            @if ($view)
                                <input type="text" class="form-control" id="prioridad" name="prioridad"
                                    value="{{ $prioridades->descripcion }}" readonly>
                            @else
                                <select class="form-select w-100" id="prioridad" name="prioridad" required>
                                    @foreach ($prioridades as $prioridad)
                                        <option value="{{ $prioridad->id }}">{{ $prioridad->descripcion }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="mb-3 col-2">
                            <label for="categoria" class="form-label">Categoría</label>
                            @if ($view)
                                <input type="text" class="form-control" id="categoria" name="categoria"
                                    value="{{ $categorias->descripcion }}" readonly>
                            @else
                                <select class="form-select w-100" id="categoria" name="categoria" required>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="mb-3 col-12">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required
                                maxlength="500" value="{{ $view ? $ticket->asunto : '' }}" {{ $view ? 'readonly' : '' }}>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control {{ $view ? '' : 'autoheigth' }}" id="descripcion" name="descripcion" rows="3"
                                required {{ $view ? 'readonly' : '' }}>{{ $view ? $ticket->descripcion : '' }}</textarea>
                        </div>
                        {{-- <div class="mb-3 col-12">
                    <div id="editor">
                    </div>
                    <label for="archivo" class="form-label">Adjuntar archivo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="archivo" name="archivo" multiple>
                        <label class="custom-file-label" for="archivo">Subir Archivos</label>
                    </div>
                    <div id="archivos-adjuntos" class="mt-3">
                        <!-- Aquí se mostrarán los archivos adjuntos -->
                    </div>
                </div> --}}
                        <div class="col-12">
                            @if ($view)
                                <a href="{{ route('client_tickets', ['ofsys' => $ofsys]) }}"
                                    class="btn btn-secondary w-100">Regresar</a>
                            @else
                                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($view)
            <div class="mb-5 col-7">
                @if ($ticket->estado != 4 && $ticket->estado != 5)
                <div class="row justify-content-center">
                    <div class="col-2"></div>
                    <div class="col-8 comentario cliente mt-4">
                        <form class="row justify-content-between" id="formComentario">
                            @csrf
                            <input type="hidden" name="ticket_id" id='ticket_id' value="{{ $ticket->id }}">
                            <div class="mb-3 col-12">
                                <label for="comentario" class="form-label">Agregar Comentario</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-1 d-flex flex-column align-items-center">
                        <div class="avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="mt-2 text-center">
                            {{ $cliente->nombre }}
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
                @endif
                <div class="row mt-3 justify-content-center">
                    @foreach ($comentarios as $comentario)
                        <div class="row col-12 mb-3 justify-content-center">
                            @if ($comentario->cliente_id->id == $cliente->id)
                                <div class="col-2"></div>
                                <div class="col-8 comentario cliente mt-4">
                                @else
                                    <div class="col-1"></div>
                                    <div class="col-1 d-flex flex-column align-items-center">
                                        <div class="avatar">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div class="mt-2">
                                            {{ $comentario->cliente_id->nombre }}
                                        </div>
                                    </div>
                                    <div class="col-8 comentario admin mt-4">
                            @endif
                            <div class="row justify-content-between">
                                <div class="mb-3 col-12">
                                    <h6><b>Fecha de Registro:</b>
                                        {{ $comentario->created_at->format('H:i d/m/Y') }}</h6>
                                </div>
                                <hr>
                                <div class="mb-3 col-12">
                                    <h6><b>Comentario:</b></h6>
                                    <p>{{ $comentario->comentario }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($comentario->cliente_id->id == $cliente->id)
                            <div class="col-1 d-flex flex-column align-items-center">
                                <div class="avatar">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="mt-2 text-center">
                                    {{ $comentario->cliente_id->nombre }}
                                </div>
                            </div>
                            <div class="col-1"></div>
                        @else
                            <div class="col-2"></div>
                        @endif
                </div>
        @endforeach
    </div>
    </div>
    @endif
    </div>
@endsection