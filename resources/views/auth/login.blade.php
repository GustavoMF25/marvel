@extends('layouts.modelo_login')
@section('title', 'Marvel - Login')
@section('conteudo')

<div class="login">
    <div class="row view-imagem">
        <div class="col-lg-12 col-md-12 mb-2">
            <image class="login-background " src="{{asset('../imagens/backgroud-login.jpg')}}" />
        </div>
    </div>
    <div class="row">
        <x-auth-validation-errors class=" error-text mb-4" :errors="$errors" />
        <div class="col-lg-12 col-md-12  mb-2">
            <div class="card" style="width: 18rem;">
                <h1>Login</h1>
                <div class="card-body">
                    <form method="post" action="{{ route('login') }}" >
                        @csrf
                        <div class="col-lg-12 col-md-12  mb-2">
                            <input type="email" name="email" placeholder="Username" required="required" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <input  type="password" name="password" placeholder="Password" required="required" />
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg">Fazer Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection