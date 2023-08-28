@extends('layouts.navBarBase')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="row">
    <div class="col-md-12">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Error
            </div>
            <div class='card-body text-danger'>
                <p>Something <strong>wrong</strong> happened during payment procedure.</p>
                <p><a class="btn btn-secondary" href="{{ route('user.registration') }}"><i class="bi-box-arrow-left"></i> Back to the favourite pair list</a></p>
            </div>
        </div>
    </div>
</div>
@endsection