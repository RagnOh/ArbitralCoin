@extends('layouts.navBarBase')

@section('titolo')
ArbitralCoin
@endsection

@section('scripts')
<script src="{{ url('/') }}/js/rinnovoAbbo.js"></script>
@endsection

@section('contenuto')

<div class="row" style="margin-top: 8em">
    <div class="col-md-12">
        <div class="card text-center border-danger">
            <div class='card-header'>
                Error
            </div>
            <div class='card-body text-danger'>
               
                <p>Il tuo Account non risulta pagante</p>
                
                
                <form class="form-horizontal" id="rinnovoAbbo" name="rinnovoAbbo" method="post" action="{{ route('renewAbbo')}}" style="margin-top: 2em">
@csrf

<div class="form-group" >
   <input type="deposito" name="insertMail" id="insertMail" class="form-control" placeholder="Inserisci Mail"/>
   <span class="invalid-input" id="invalid-Input"></span>
</div>


        <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Procedi con il pagamento</label>
        <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkMailInput();"/>
        <p><a class="btn btn-secondary" style="margin-top: 2em" href="{{ route('user.logout') }}"><i class="bi-box-arrow-left"></i> Back </a></p>
    </form> 
               
            </div>
        </div>
    </div>
</div>
 


    @endsection