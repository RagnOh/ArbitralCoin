@extends('layouts.navBarbase')

@section('scripts')
<script src="{{ url('/') }}/js/registrationInputControls.js"></script>
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
        <li class="breadcrumb-item" aria-current="page">UsersList</li>
       
    </ol>
</nav>
@endsection

@section('contenuto')
<div class="row" style="margin-top: 4em">
                            @if($admin)
                            <form id="register-form" action="{{ route('adminUserList.addUser') }}" method="post" style="margin-top: 2em">
                            @else
                            <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em">
                             @endif   
                            @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value=""/>
                                    <span class="invalid-input" id="invalid-registrationName"></span>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value=""/>
                                    <span class="invalid-input" id="invalid-registrationEmail"></span>
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value=""/>
                                    <span class="invalid-input" id="invalid-registrationPasswd"></span>
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm password" value=""/>
                                    <span class="invalid-input" id="invalid-passwdConfirm"></span>
                                </div>

                                @if($admin)
                                <a href="{{ route('adminUserList.index') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Inserisci utente</label>
                                @else
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Procedi con il pagamento</label>
                                @endif
                                <input id="Register" type="submit" value="Register" class="hidden" onclick="event.preventDefault(); checkRegistrationData();"/>
                                
                                
                               
                            </form>
                            

                            @if(!$admin)
                            <a href="/user/login" class="my-3 bottom-link">Already have an account? Log In!</a>
                            @endif
<div>        
@endsection        