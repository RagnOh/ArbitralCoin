@extends('layouts.privatePart')

@section('pageScript')

@endsection
<script src="{{ url('/') }}/js/checkSettingsInput.js"></script>
@section('titolo')
ArbitralCoin
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('privateSection.index') }}">PrivateSection</a></li>
        <li class="breadcrumb-item" aria-current="page">PreferenceSettings</li>
       
    </ol>
</nav>
@endsection


@section('contenuto')

<div class="card  border-secondary" style="margin-top: 2em">
<div class='card-body'>
<form class="form-horizontal" name="userPreferences" id="user-pref" method="post" action="{{ route('preferenceSettings.store')}}">
@csrf
<div class="exchanges_selection">
<div class="form-check form-switch" style="margin-top: 2em">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Binance" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Binance
                </label>
</div>
<div class="form-check form-switch">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Kraken" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Kraken
                </label>
</div>
<div class="form-check form-switch">
<label>

                    <input
                        type="checkbox" class="form-check-input" name="Crypto" id="flexSwitchCheckDefault" checked data-toggle="toggle" data-height="60" data-width="100"
                        data-on="<i class='fa-solid fa-trophy fa-beat'></i> Ranked"
                        data-off="<i class='fa-solid fa-dumbbell'></i> Training" class="px-3 py-2"
                        onchange="document.getElementById('cb').style.display = this.checked ? 'none' : 'block'"
                    />
                    Crypto
                </label>
</div>


</div>
<span class="invalid-Switch" id="invalid-Switch"></span>
<div class="form-group" style="margin-top: 2em">
   <input type="deposito" name="depositAmount" class="form-control" placeholder="Cifra_Deposito"/>
   <span class="invalid-deposit" id="invalid-deposit"></span>
</div>
<div class="form-group">
<select class="form-select" name="favoriteValute">
                @foreach($fiatList as $type)
                 
                    <option value="{{ $type }}" selected="selected">{{ $type }}</option>
                @endforeach
                </select>
</div>
<div class="form-group">
   <input type="minimo guadagno" name="minGain" class="form-control" placeholder="Min_Guadagno"/>
   <span class="invalid-gain" id="invalid-gain"></span>
</div>

<div class='card-footer text-center'>
<label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Save</label>
<input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkSettingsInput()"/>
</div>
</form>
</div>
</div>
@endsection

