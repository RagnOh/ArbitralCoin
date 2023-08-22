@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="row">
    <div class="col-md-6">
        <div class="card text-center border-secondary">
            <div class='card-header'>
                Revert
            </div>
            <div class='card-body'>
                <p>The favourite pair <strong>will not be removed</strong> from the database</p>
                <p><a class="btn btn-secondary" href="{{ route('favPairs.index') }}"><i class="bi-box-arrow-left"></i> Back</a></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Confirm
            </div>
            <div class='card-body'>
                <p>The User <strong>will be removed</strong> from the database</p>
                <form class="form-horizontal" name="destroy" method="POST" action="{{ route('favPairs.destroy', ['favPair' => $pair]) }}">
                @csrf
                @method('DELETE')
                <button type='submit' class="btn btn-danger" data-toggle="tooltip" ><i class="bi-trash3"></i> Elimina </button>
               </form>
                
            </div>
        </div>
    </div>
</div>

@endsection