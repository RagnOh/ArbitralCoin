@extends('layouts.publicPart')

@section('titolo')
ArbitralCoin
@endsection

@section('contenuto')
<div class="row" style="margin-top: 4em">
                            <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value=""/>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value=""/>
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value=""/>
                                </div>

                                <div class="form-group text-center">
                                    <input type="password" name="confirm-password" class="form-control" placeholder="Confirm password" value=""/>
                                </div>

                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Register</label>
                                <input id="Register" type="submit" value="Register" class="hidden"/>

                            </form>
                      
<div>        
@endsection        