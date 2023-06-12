@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('pageScript')
<script src="{{ url('/') }}/js/bestPairsScripts.js"></script>
@endsection

@section('contenuto')
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
            
        </table>

@endsection

