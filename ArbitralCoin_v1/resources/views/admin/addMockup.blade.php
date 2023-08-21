@extends('layouts.adminPart')

@section('pageScript')
<script src="{{ url('/') }}/js/mockupInputControl.js"></script>
@endsection

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
@if(isset($pair))
        <form class="form-horizontal" name="modifyMockup" id="addMockup" method="post" action="{{ route('adminMockup.update',['pair'=>$pair]) }}">
        @method('PUT')
        @else
        <form class="form-horizontal" name="addMockup" id="addMockup" method="post" action="{{ route('adminMockup.store')}}">
        @endif

@csrf
<div class="form-group">
@if(isset($pair))
<input type="deposito" name="pairName" class="form-control" placeholder="Pair Name" value="{{$pair}}"/>
<span class="invalid-input" id="invalid-Input"></span>
<p> Inserisci il nuovo prezzo </p>                
@else
                <input type="deposito" name="pairName" class="form-control" placeholder="Pair Name"/>
                <span class="invalid-input" id="invalid-Input"></span>
                @endif  
   
</div>
<div class="form-group">
   <input type="valuta preferita" name="price" id="priceInput" class="form-control" placeholder="Price"/>
   <span class="invalid-price" id="invalid-price"></span>
</div>

<label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Save</label>
<input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkPairInput()"/>
</form>

@endsection