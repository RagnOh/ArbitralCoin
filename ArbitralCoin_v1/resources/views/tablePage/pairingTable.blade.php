@extends('layouts.privatePart')

@section('titolo')
ArbitralCoin
@endsection

@section('stile', 'style.css')


@section('contenuto')
<table class="table table-striped table-hover table-responsive" 
            style="width:100%" id="pairTable">
            <col width='20%'>
            <col width='20%'>
            <col width='20%'>
            <col width='10%'>
            <thead>
                <tr>
                    <th>Pair</th>
                    <th>Binance</th>
                    <th>Kraken</th>
                    <th>Crypto.com</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
          <!--  @foreach ($pairs_list as $row)
                <tr>
                    <td>{{ $row[0] }}</td>
                    @for ($i = 1; $i < count($row); $i++)
                        <td>{{ $row[$i] }}</td>
                    @endfor
                </tr>
            @endforeach
-->
            </tbody>
        </table>

@endsection
