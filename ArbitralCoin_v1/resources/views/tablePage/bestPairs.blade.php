@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('stile', 'style.css')

@section('cssResource')
<link rel="stylesheet" href="{{ url('/') }}/css/customTable.css">
<link rel="stylesheet" href="{{ url('/') }}/css/bestPairs.css">
@endsection

@section('pageScript')
<script src="{{ url('/') }}/js/bestPairsScripts.js"></script>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">BestPairs</li>
       
    </ol>
</nav>
@endsection

@section('contenuto')
<div class="User-Param">

  
<ul class="list-group list-group-flush">
    <li class="list-group-item" id="setting-logo">Settings</li>
  <li class="list-group-item lista shadow">Deposito= {{$deposito}}</li>
  <li class="list-group-item lista shadow" id="lista-ultimo">Guadagno= {{$guadagno}}</li>
  
</ul>

</div>

<div class="main-Table ">
<table class="table  table-hover table-responsive shadow" 
            style="width:100%" id="bestTable">
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <col width='10%'>
            <thead class="table-head">
                <tr>
                    <th class="head">Pair</th>
                    <th class="head">From</th>
                    <th class="head">To</th>
                    <th class="head">Guadagno</th>
                </tr>
            </thead>

            <tbody>


            </tbody>
            
        </table>
</div>
@endsection

