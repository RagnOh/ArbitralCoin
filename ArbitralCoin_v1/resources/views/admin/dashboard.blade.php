@extends('layouts.adminPart')

@section('pageScript')
<script src="{{ url('/') }}/js/userTableScript.js"></script>

@endsection

@section('titolo')
ArbitralCoin
@endsection

@section('contenuto')

<table class="table table-striped table-hover table-responsive" 
            style="width:100%" id="userTable">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead>
                
                <tr>
                    <th>UserName</th>
                    <th>Mail</th>
                    <th>Pagante</th>
                    
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
        
            
               
            </tbody>
        </table>
@endsection