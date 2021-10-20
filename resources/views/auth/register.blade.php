@extends('layouts.modelo_login')
@section('title', 'Marvel - Register')
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
                <h1>Register</h1>
                <div class="card-body">
                    <form method="post" action="{{ route('register') }}" >
                        @csrf
                        <div class="col-lg-12 col-md-12  mb-2">
                            <input autocomplete="anyrandomstring" placeholder="Nome" id="name" class="block mt-1 w-full"  type="text" name="name" :value="old('name')" required autofocus />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <input autocomplete="off" placeholder="E-mail" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <input placeholder="Senha" autocomplete="off" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <input placeholder="Confirmar Senha" autocomplete="off" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg">Registrar-se</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection