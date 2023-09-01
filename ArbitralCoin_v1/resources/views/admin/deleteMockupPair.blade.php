@extends('layouts.adminPart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="row" style="margin-top: 7em">
    <div class="col-md-6">
        <div class="card text-center border-secondary">
            <div class='card-header'>
                Revert
            </div>
            <div class='card-body'>
                @if(!isset($pair))
                <p>All the Pairs <strong>  will not be removed</strong> from the database</p>
                @else
                <p>The Pair <strong> {{$pair}} will not be removed</strong> from the database</p>

                @endif
                <p><a class="btn btn-secondary" href="{{ route('adminMockup.index') }}"><i class="bi-box-arrow-left"></i> Back</a></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Confirm
            </div>
            <div class='card-body'>
            @if(!isset($pair))
            <p>All the Pairs <strong> will be removed</strong> from the database</p>
            <p><a class="btn btn-danger" href="{{ route('adminMockup.destroyAll') }}"><i class="bi-trash3"></i> Elimina</a></p>
            @else
            <p>The Pair <strong> {{$pair}} will be removed</strong> from the database</p>
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