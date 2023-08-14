@extends('layouts.adminPart')

@section('titolo')
ArbitralCoin
@endsection

@section('contenuto')
<a class="btn btn-danger" 
                                href="{{ route('administrator.addNewMockup')}}"><i class="bi-trash3"></i> Aggiungi elemento</a>
<table class="table table-striped table-hover table-responsive" 
            style="width:100%">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead>
                <tr>
                    <th>Pair</th>
                    <th>Price</th>
                    
                    <th></th>
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
                            <a class="btn btn-danger" 
                                href="{{ route('administrator.removeMockup', ['pair' => $pair->pair]) }}"><i class="bi-trash3"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            
               
            </tbody>
        </table>
@endsection