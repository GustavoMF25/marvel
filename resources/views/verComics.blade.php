@extends('layouts.app')
@section('title', 'Marvel - Detalhes')


@section('conteudo')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-3 col-4">
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">{{$data[0][1]}}</h5>
                    <div class="comics-detalhe">
                        <div class="comics-image mb-3">
                            <img src="{{$data[0][4]->path}}.{{$data[0][4]->extension}}" class="img-responsive thunbmail" alt="">
                        </div>

                        <div class="text-center"> 
                            <span class="fw-bold"> # {{$data[0][0]}}</span>
                        </div>
                    </div>
                    <div class="row">
<!--                        <div class="col-sm-12 col-md-12 col-12 text-center">
                            <input type="hidden" id="starValue" name="idComics" value="{{$data[0][0]}}">
                            <button id="iconStar" type="button" class="btn btn-link"><i  style="color: #E8D108; font-size: 30px;" class="far fa-star"></i></button>
                        </div>-->
                        <div class="col-sm-12 col-md-6 col-12 text-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-md-9 col-8">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold ">Detalhes</h5>
                            @if($data[0][2])
                            <p class="text-break text-detalhes">{{$data[0][2]}}</p>
                            @else
                            <p class="text-break text-detalhes text-center">Sem detalhes definidos</p>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-12 mb-3">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold">Galeria</h5>

                            @if(count($data[0][7]) == 0)
                            <div class="carousel-item active">
                                <img class="d-block w-100 card-img-top"  src="http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available.jpg" alt="...">
                            </div>
                            @endif

                            <div class="row">
                                @foreach($data[0][7] as $keyimg => $valueimg)
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">
                                    <img class="d-block w-80 rounded img-fluid"  src="{{$valueimg->path}}.{{$valueimg->extension}}"  alt="...">
                                    @if(isset($data[0][6][$keyimg]->price))
                                    <span><i class="fas fa-dollar-sign" style="color:#0F9E30"></i> {{$data[0][6][$keyimg]->price}}</span>
                                    @endif
                                </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
//    document.addEventListener("DOMContentLoaded", function () {
//        $("#iconStar").hover(
//                function () {
//                    $('#iconStar').html('<i  style="color: #E8D108; font-size: 30px;" class="fas fa-star"></i>')
//                },
//                function () {
//                    $('#iconStar').html('<i  style="color: #E8D108; font-size: 30px;" class="far fa-star"></i>')
//                }
//        );
//        $('#iconStar').click(function () {
//            
//        })
//    })


</script>
@endsection