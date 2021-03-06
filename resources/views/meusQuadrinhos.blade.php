@extends('layouts.app')
@section('title', 'Marvel - Meus Quadrinhos')
@section('conteudo')

<div class="container">
    <div class="row mb-3">
        @if(isset($data) && $data != [])
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
                            <span class="fw-bold">T??tulo:</span> {{$value[1]}}
                        </div> 
                        <div class="col-12">
                            <span class="fw-bold">Coment??rio: </span> {{$value[8]}}
                        </div> 
                    </div>

                    <div class="row d-flex justify-content-between">
                        <div class="col-6 d-flex ml-0 justify-content-start">
                            <a class="btn" href="{{route('updateViewMeusQuadrinhos', $value[9])}}">
                                <span class="small">
                                    <i style="color: #3A86DC"  class="fas fa-edit"></i>
                                </span>
                            </a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <form method="get" action="{{route('destroyMeusQuadrinhos')}}">
                                @csrf
                                <input name="idComics" hidden value="{{$value[0]}}" />
                                <button type="submit" class="btn">
                                    <span class="small">
                                        <i style="color: #ff1a1a"  class="fas fa-trash"></i>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div> 


        @endforeach
        @else
        <div class="text-center fw-bold">
            Sua lista est?? vazia!!
        </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    function ExcluirComics(idComics) {
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            method: "get",
            url: "",
            data: {idComics: idComics, _token: '{{csrf_token()}}'},
            success: function (dados) {
            console.log(dados)
                    //                Assim que a requisi????o terminar vai exibir as mensagens recebidas do controller
                    if (dados.sucesso === true){
            $('.toast').removeClass('hide').addClass('show').addClass('bg-success').removeClass('bg-danger')
                    $('.mensagemRetorno').html(dados.mensagem)
                    setTimeout(() => {
                    $('.toast').removeClass('show').addClass('hide');
                    }, 12000)
            }

            if (dados.sucesso === false){
            $('.toast').removeClass('hide').addClass('show').addClass('bg-danger').removeClass('bg-success')
                    $('.mensagemRetorno').html(dados.mensagem)
                    setTimeout(() => {
                    $('.toast').removeClass('show').addClass('hide');
                    }, 12000)
            }
            },
            error: function (error) {
            console.log(error)
            }
    })
    }

</script>
@endsection