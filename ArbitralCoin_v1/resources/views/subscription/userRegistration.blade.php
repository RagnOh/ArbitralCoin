@extends('layouts.navBarbase')

@section('scripts')
<script src="{{ url('/') }}/js/registrationInputControls.js"></script>
@endsection

@section('titolo')
ArbitralCoin
@endsection

@section('contenuto')
<div class="row" style="margin-top: 4em">
                            <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em">
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

                                
                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Procedi con il pagamento</label>
                                <input id="Register" type="submit" value="Register" class="hidden" onclick="event.preventDefault(); checkRegistrationData();"/>
                                
                                
                               
                            </form>
                            

                            
                            <a href="/user/login" class="my-3 bottom-link">Already have an account? Log In!</a>
                      
<div>        
@endsection        