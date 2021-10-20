@extends('layouts.app')
@section('title', 'Marvel - Dashboard')
@section('conteudo')
<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Pesquisa de Comics</h5>
            <div class='d-flex'>
                <input class="form-control me-2" id="valorTitleId" type="search" placeholder="Pesquisar por Título ou Id" aria-label="Search">
                <button id="BuscarComics" class="btn btn-outline-success" type="submit">Pesquisar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $("#BuscarComics").click(function () {
            let parametro = $('#valorTitleId').val()
            $.ajax({
                method: "get",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ApiMarvel')}}",
                data: {titleId: parametro},
                success: function (dados) {
                    console.log(dados)
                }
            })
//                    .done(function (msg) {
//                        alert("Data Saved: " + msg);
//                    });
        });
    })
</script>
@endsection
