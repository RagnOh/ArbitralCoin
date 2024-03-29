@extends('layouts.navBarbase')

@section('titolo')
ArbitralCoin
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" style="margin-top: 4em">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Login</li>

        </ol>
</nav>
@endsection


@section('contenuto')
            <div class="row" style="margin-top: 2em">
                <div>
                    <p class="testo-accesso"> Accedi </p>
                    @if($pagamento)
                    <p>Account registrato correttamente, accedi per continuare </p>
                    @endif
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                            <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email"/>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                                </div>

                                <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Login" class="btn btn-primary"><i class="bi-check-lg"></i> Login</label>
                                <input id="Login" type="submit" value="Login" class="hidden"/>

                        
                            </form>

                            <a href="/user/registration" class="my-3 bottom-link">Prima volta? Registra un account</a>
                        </div>
                     
                    </div>

                </div>
            </div>
@endsection