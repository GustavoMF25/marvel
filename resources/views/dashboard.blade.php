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

    <div class="row">
        @if(isset($data))
        @foreach($data as $key => $value)
        <div class="col-lg-3">
            <div class="card mt-3">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner d-flex">
                        @foreach($value[7] as $keyimg => $valueimg)
                        @if($keyimg == 0)
                        <div class="carousel-item active">
                            <img class="d-block w-100 " id="{{$value[0]}}_{{$keyimg}}" src="{{$valueimg->path}}.{{$valueimg->extension}}" class="card-img-top" alt="...">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img class="d-block w-100" id="{{$value[0]}}_{{$keyimg}}" src="{{$valueimg->path}}.{{$valueimg->extension}}" class="card-img-top" alt="...">
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-body">
                    #{{$value[0]}}
                    <br>
                    Nome: {{$value[1]}}
                    <br>
                    Descrição: {{$value[2]}}
                    <br>

                    <br>

                </div>
            </div>            
        </div>
        @endforeach
    </div>

</div>
@endif

@if(isset($error))
<div class="alert alert-danger mt-3 text-center mensagemError" role="alert">
    {{$error[0]->mensagem}}
</div>
@endif


<!--</div>-->
@endsection

@section('script')

@endsection
