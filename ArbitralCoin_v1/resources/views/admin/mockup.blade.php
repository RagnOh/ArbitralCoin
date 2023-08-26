@extends('layouts.adminPart')

@section('cssResource')
<link rel="stylesheet" href="{{ url('/') }}/css/customTable.css">
<link rel="stylesheet" href="{{ url('/') }}/css/mockup.css">
@endsection

@section('titolo')
ArbitralCoin
@endsection

@section('contenuto')
<a class="btn btn-primary" id="btn-aggiunta"

                                href="{{ route('administrator.addNewMockup')}}"><i class="bi bi-plus"></i> Aggiungi elemento</a>
<table class="table  table-hover table-responsive shadow" 
            style="width:100%" id="mockupTable">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead class="table-head">
                <tr>
                    <th class="head">Pair</th>
                    <th class="head">Price</th>
                    
                    <th class="head"></th>
                    <th class="head"></th>
                    <th class="head"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($pairs_list as $pair)
                    <tr>
                        <td>{{ $pair->pair }}</td>
                        <td>{{ $pair->price }}</td>
                        <td>
                           
                        </td>
                        <td>
                            <a class="btn btn-primary" 
                                href="{{ route('adminMockup.edit', ['pair' => $pair->pair]) }}"><i class="bi-pencil-square"></i> Edit</a>
                        </td>
                        <td>
                         
                        <a class="btn  btn-danger" 
                                href="{{ route('adminMockup.destroy.confirm', ['pair' => $pair->pair]) }}"><i class="bi bi-trash3-fill"></i> Delete</a>
                       
                        </td>
                        
                    </tr>
                @endforeach
            
               
            </tbody>
        </table>
@endsection