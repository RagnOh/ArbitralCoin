@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('cssResource')
<link rel="stylesheet" href="{{ url('/') }}/css/customTable.css">
<link rel="stylesheet" href="{{ url('/') }}/css/favPairs.css">
@endsection

@section('pageScript')
<script src="{{ url('/') }}/js/favPairsScript.js"></script>
<script src="{{ url('/') }}/js/favPairInputControl.js"></script>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">FavoritePairs</li>
       
    </ol>
</nav>
@endsection


@section('contenuto')
<form class="form-horizontal" id="favPairInsert" name="userPreferences" method="post" action="{{ route('favPairs.store')}}">
@csrf

<div class="form-group">
   <input type="deposito" name="insertPair" id="insertPair" class="form-control" placeholder="Aggiungi Pair"/>
   <span class="invalid-input" id="invalid-Input"></span>
</div>

        <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Add</label>
        <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkPairInput()"/>

    </form>  

<div class="main-Table ">
<table class="table  table-hover table-responsive shadow" 
            style="width:100%" id="favTable">
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <thead class="table-head">
                <tr>
                    <th class="head">Pair</th>
                    <th class="head">Binance</th>
                    <th class="head">Kraken</th>
                    <th class="head">Crypto.com</th>
                    <th class="head"></th>
                </tr>
            </thead>

            <tbody>


            </tbody>
            
        </table>
</div>
             

@endsection