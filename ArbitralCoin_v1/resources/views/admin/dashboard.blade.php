@extends('layouts.adminPart')


@section('cssResource')
<link rel="stylesheet" href="{{ url('/') }}/css/customTable.css">
<link rel="stylesheet" href="{{ url('/') }}/css/userList.css">
@endsection

@section('pageScript')
<script src="{{ url('/') }}/js/userTableScript.js"></script>

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

<a class="btn btn-primary" id="btn-aggiunta"

                                href="{{ route('adminUserList.register')}}"><i class="bi bi-plus"></i> Aggiungi utente</a>

<div class="main-Table ">
<table class="table table-hover table-responsive shadow" 
            style="width:100%" id="userTable">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead class="table-head">
                
                <tr>
                    <th class="head">UserName</th>
                    <th class="head">Mail</th>
                    <th class="head">Pagante</th>
                    
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
        
            
               
            </tbody>
        </table>
</div>
@endsection