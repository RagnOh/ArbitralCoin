@extends('layouts.adminPart')

@section('pageScript')
<script src="{{ url('/') }}/js/mockupInputControl.js"></script>
<script src="{{ url('/') }}/js/pairNameAssistant.js"></script>
@endsection

@section('titolo')
ArbitralCoin
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('privateSection.index') }}">PrivateSection</a></li>
        <li class="breadcrumb-item"><a href="{{ route('adminUserList.index') }}">Admin</a></li>
        <li class="breadcrumb-item"><a href="{{ route('adminMockup.index') }}">MockupData</a></li>
        @if(isset($pair))
        <li class="breadcrumb-item" aria-current="page">Edit</li>
        @else
        <li class="breadcrumb-item" aria-current="page">Add</li>
        @endif
        
       
    </ol>
</nav>
@endsection


@section('contenuto')
@if(isset($pair))
        <form class="form-horizontal" name="modifyMockup" id="addMockup" method="post" action="{{ route('adminMockup.update',['pair'=>$pair]) }}">
        @method('PUT')
        @else
        <form class="form-horizontal" name="addMockup" id="addMockup" method="post" action="{{ route('adminMockup.store')}}">
        @endif

@csrf
<div class="form-group" style="margin-top: 4em">
@if(isset($pair))
<input type="t" name="pairName" class="form-control" placeholder="Pair Name" value="{{$pair}}"/>
<span class="invalid-input" id="invalid-Input"></span>

<p> Inserisci il nuovo prezzo </p>                
@else
                <input type="text" name="pairName" class="form-control" placeholder="Pair Name"/>
                <span class="invalid-input" id="invalid-Input"></span>
                <div id="risultati"></div>
            
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