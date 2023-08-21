@extends('layouts.adminPart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<div class="row">
    <div class="col-md-12">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Access denied
            </div>
            <div class='card-body text-danger'>
                <p>Something <strong>wrong</strong> happened during deleting procedure. Maybe wrong mockup pair?</p>
                <p><a class="btn btn-secondary" href="{{ route('adminMockup.index') }}"><i class="bi-box-arrow-left"></i> Back to the mockup pair list</a></p>
            </div>
        </div>
    </div>
</div>
@endsection