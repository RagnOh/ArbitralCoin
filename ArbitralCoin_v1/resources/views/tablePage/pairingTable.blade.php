@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('stile', 'style.css')

@section('pageScript')
<script src="{{ url('/') }}/js/tableScript.js"></script>
@endsection

@section('contenuto')
<table class="table table-striped table-hover table-responsive" 
            style="width:100%" id="pairTable">
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
                    <th>Mockup</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
         
            </tbody>
        </table>

@endsection
