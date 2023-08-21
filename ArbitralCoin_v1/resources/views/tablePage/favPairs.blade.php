@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('pageScript')
<script src="{{ url('/') }}/js/favPairsScript.js"></script>
<script src="{{ url('/') }}/js/favPairInputControl.js"></script>
@endsection



@section('contenuto')
<form class="form-horizontal" id="favPairInsert" name="userPreferences" method="post" action="{{ route('favPairs.store')}}">
@csrf

<div class="form-group">
   <input type="deposito" name="insertPair" class="form-control" placeholder="Aggiungi Pair"/>
   <span class="invalid-input" id="invalid-Input"></span>
</div>

<label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Add</label>
        <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkPairInput()"/>
</form>  

<table class="table table-striped table-hover table-responsive" 
            style="width:100%">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead>
                <tr>
                    <th>Pair</th>
                    <th>Binance</th>
                    <th>Kraken</th>
                    <th>Crypto.com</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        
            
               
            </tbody>
        </table>

             

@endsection