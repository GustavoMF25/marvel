@extends('layouts.app')
@section('title', 'Marvel - Meus Quadrinhos - Editar')
@section('conteudo')

<div class="container text-center">
    <form method="post" action="{{route('updateMeusQuadrinhos')}}">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        <h1>{{$data['title']}} </h1>
        <span class="fw-bold mb-3">#{{$data['idComics']}}</span>
        <div class="form-group mb-3">
            <label class="fw-bold">Descrição: </label>
            <textarea class="form-control" name="descricao" rows="3">
                {{$data['description']}}
            </textarea>
        </div>
        <div class="form-group mb-3">
            <label class="fw-bold">Comentário: </label>
            <textarea class="form-control" name="comentario" rows="3">
                {{$data['comentar']}}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

@endsection