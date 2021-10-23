@extends('layouts.app')
@section('title', 'Marvel - Meus Quadrinhos')
@section('conteudo')

<div class="container">
    <div class="row mb-3">
        @if(isset($data))
        @foreach($data as $key => $value)

        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
            <div class="card mt-3 ">
                <form class="cardComics" id="form_{{$value[0]}}" method="get" action="{{route('verDetalhes')}}">
                    <input type="text" value="{{$value[0]}}" name="idComics" hidden>
                    <a onClick="document.getElementById('form_{{$value[0]}}').submit();">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner d-flex">

                                @if(count($value[7]) == 0)
                                <div class="carousel-item active">
                                    <img class="d-block w-100 card-img-top"  src="http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available.jpg" alt="...">
                                </div>
                                @endif
                                @foreach($value[7] as $keyimg => $valueimg)
                                @if($keyimg == 0)
                                <div class="carousel-item active">
                                    <img class="d-block w-100 card-img-top "  src="{{$valueimg['path']}}.{{$valueimg['extension']}}"  alt="...">
                                </div>
                                @else
                                <div class="carousel-item">
                                    <img class="d-block w-100 card-img-top" src="{{$valueimg['path']}}.{{$valueimg['extension']}}" alt="...">
                                </div>
                                @endif
                                @endforeach


                            </div>
                        </div>
                    </a>
                </form>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <span class="fw-bold" style="font-size: small">#{{$value[0]}}</span>
                        </div>
                        <div class="col-12">
                            <span class="fw-bold">Título:</span> {{$value[1]}}
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <span class="small">Comentar </span><i style="color: #D8D70F" class="far fa-star"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div> 


        @endforeach
        @endif
    </div>
</div>
@endsection