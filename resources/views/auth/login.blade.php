@extends('layouts.modelo_login')

@section('conteudo')
<div class="login row">
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="col-lg-12 col-md-12  mb-2">
        <h1>Login</h1>
        <form method="post" action="{{ route('login') }}" >
            @csrf
            <div class="col-lg-12 col-md-12  mb-2">
                <input type="email" name="email" placeholder="Username" required="required" />
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                <input  type="password" name="password" placeholder="Password" required="required" />
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">Let me in.</button>
            </div>
        </form>
    </div>
</div>
<!-- /.content -->
@endsection