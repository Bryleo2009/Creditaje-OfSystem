
@extends('pages.ticket.index')

@section('content')
<div class="row">
    @foreach($tickets as $ticket)
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $ticket->asunto }}</h5>
                    <p class="card-text">{{ $ticket->descripcion }}</p>
                    <a href="{{ route('new_ticket', $ticket->id) }}" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection