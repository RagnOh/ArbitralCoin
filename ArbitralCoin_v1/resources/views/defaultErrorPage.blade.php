@extends('layouts.navBarBase')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="row" style="margin-top: 4em">
    <div class="col-md-12">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Error
            </div>
            <div class='card-body text-danger'>
                @if($admin)
                <p>Il tuo Account non dispone dei privilegi di Amministratore</p>
                <p><a class="btn btn-secondary" href="{{ route('privateSection.index') }}"><i class="bi-box-arrow-left"></i> Torna alla sezione privata </a></p>
                @else
                <p>Il tuo Account non risulta pagante</p>
                <p><a class="btn btn-secondary" href="{{ route('user.logout') }}"><i class="bi-box-arrow-left"></i> Back </a></p>
                <p><a class="btn btn-secondary" href="{{ route('user.logout') }}"><i class="bi-box-arrow-left"></i> Procedi al pagamento </a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection