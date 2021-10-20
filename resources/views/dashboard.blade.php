@extends('layouts.app')
@section('title', 'Marvel - Dashboard')
@section('conteudo')
<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Pesquisa de Comics</h5>
            <form class='d-flex' method="post" accept-charset="{{route('buscaComics')}}">
                @csrf
                <input class="form-control me-2" id="valorTitleId" name="valorTitleId" type="search" placeholder="Pesquisar por Título ou Id" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
        </div>
    </div>

    @if(isset($data))
    <div class="card mt-3">
        <div class="card-body">
            @foreach($data as $key => $value)
            {{$value[1]}}
            <br>
            @endforeach
        </div>
    </div>
    @endif

    @if(isset($error))
    <div class="alert alert-danger mt-3 text-center mensagemError" role="alert">
        {{$error[0]->mensagem}}
    </div>
    @endif


</div>


@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#BuscarComics").click(function () {
            let parametro = $('#valorTitleId').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "get",
                url: "{{route('ApiMarvel')}}",
                data: {titleId: parametro},
                dataType: 'json',
                success: function (dados) {
                    if (Object.keys(dados).length > 2) {
                        $('.mensagemError').addClass('d-none');
                        console.log(dados)
                    } else {
                        $('.mensagemError').removeClass('d-none').html(dados.mensagem)
                    }
                },
                error: function (e) {
                    $('.mensagemError').removeClass('d-none').html(e)
                }
            })
        });
    })
</script>
@endsection
