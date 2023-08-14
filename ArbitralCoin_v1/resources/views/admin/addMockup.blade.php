@extends('layouts.adminPart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')

<form class="form-horizontal" name="userPreferences" method="post" action="{{ route('administrator.storeElement')}}">
@csrf
<div class="form-group">
   <input type="deposito" name="pairName" class="form-control" placeholder="Pair Name"/>
</div>
<div class="form-group">
   <input type="valuta preferita" name="price" class="form-control" placeholder="Price"/>
</div>

<label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Save</label>
<input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkPreferences('Save')"/>
</form>

@endsection