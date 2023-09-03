@extends('layouts.adminPart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="row" style="margin-top: 7em">
    <div class="col-md-6">
        <div class="card text-center border-secondary">
            <div class='card-header'>
                Annulla
            </div>
            <div class='card-body'>
                @if(!isset($pair))
                <p>Turri i Pairs <strong>  non verrà rimosso</strong> dal database</p>
                @else
                <p>Il Pair <strong> {{$pair}} non verrà rimosso</strong> dal database</p>

                @endif
                <p><a class="btn btn-secondary" href="{{ route('adminMockup.index') }}"><i class="bi-box-arrow-left"></i> Back</a></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Conferma
            </div>
            <div class='card-body'>
            @if(!isset($pair))
            <p>Tutti i Pairs <strong> verranno rimossi</strong> dal database</p>
            <form class="form-horizontal" name="destroy" method="POST" action="{{ route('adminMockup.destroyAll') }}">
                @csrf
                @method('DELETE')
                <button type='submit' class="btn btn-danger" data-toggle="tooltip" style="margin-bottom: 1em" ><i class="bi-trash3"></i> Elimina </button>
               </form>
            
            @else
            <p>Il Pair <strong> {{$pair}} verrà rimosso</strong> dal database</p>
            <form class="form-horizontal" name="destroy" method="POST" action="{{ route('adminMockup.destroy', ['pair' => $pair]) }}">
                @csrf
                @method('DELETE')
                <button type='submit' class="btn btn-danger" data-toggle="tooltip" style="margin-bottom: 1em" ><i class="bi-trash3"></i> Elimina </button>
               </form>
               @endif  
                
            </div>
        </div>
    </div>
</div>

@endsection