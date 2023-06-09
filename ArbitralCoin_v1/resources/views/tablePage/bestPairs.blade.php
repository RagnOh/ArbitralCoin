@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('stile', 'style.css')

@section('pageScript')
<script src="{{ url('/') }}/js/bestPairsScripts.js"></script>
@endsection

@section('contenuto')
<table class="table table-striped table-hover table-responsive" 
            style="width:100%" id="bestTable">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead>
                <tr>
                    <th>Pair</th>
                    <th>From</th>
                    <th>To</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>


            </tbody>
            
        </table>

@endsection

