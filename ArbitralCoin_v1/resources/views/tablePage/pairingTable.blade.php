@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('cssResource')
<link rel="stylesheet" href="{{ url('/') }}/css/customTable.css">
<link rel="stylesheet" href="{{ url('/') }}/css/pairTable.css">
@endsection

@section('stile', 'style.css')

@section('pageScript')
<script src="{{ url('/') }}/js/tableScript.js"></script>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">PairsTable</li>
       
    </ol>
</nav>
@endsection

@section('contenuto')
<div class="main-Table ">
<table class="table  table-hover table-responsive shadow" 
            style="width:100%" id="pairTable">
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <thead class="table-head">
                <tr>
                    <th class="head">Pair</th>
                    <th class="head" id="binancehead">Binance</th>
                    <th class="head" id="krakenhead">Kraken</th>
                    <th class="head" id="cryptohead">Crypto.com</th>
                    <th class="head">Mockup</th>
                </tr>
            </thead>

            <tbody>


            </tbody>
            
        </table>
</div>

@endsection
