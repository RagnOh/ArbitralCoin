@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('contenuto')
<form class="form-horizontal" name="userPreferences" method="post" action="{{ route('FavPairsController.storeFavPair')}}">
@csrf

<div class="form-group">
   <input type="deposito" name="insertPair" class="form-control" placeholder="Aggiungi Pair"/>
</div>

<label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Add</label>
        <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkPreferences('Save')"/>
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