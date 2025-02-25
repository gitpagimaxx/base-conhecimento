@extends('layouts.app')
@section('titulo', 'Detalhes do Conhecimento')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header"><b>Conhecimento</b></h5>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Novo</a>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <h1>{{ $item[0]->Titulo }}</h1>

                    <hr>

                    {!! $item[0]->Resumo !!}

                    <p>
                        @if ($htmlContent ?? '')
                        {!! $htmlContent !!}
                        @endif
                    </p>

                    <p>
                        @if (count($tagsAssociadas) > 0)
                            @foreach($tagsAssociadas ?? '' as $tag)
                                <span class="badge text-white bg-primary mr-2">{{$tag->Tag}}</span>
                            @endforeach
                        @else
                            Nenhuma tag associada
                        @endif
                    </p>

                    <hr>

                    <p>
                        <b>Anexos</b><br>
                        @if (count($anexosPorBaseId) > 0)
                            <ol>
                            @foreach($anexosPorBaseId ?? '' as $anexo)
                                <li class="mb-1"><a href="{{ url(ENV('APP_URL')) }}/{{$anexo->Anexo}}" target="_blank">{{$anexo->NomeAnexo}}</a>&nbsp; <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/anexo/{{ $anexo->id }}" class="btn btn-sm btn-outline btn-danger"><i class="fas fa-trash"></i></a></li>
                            @endforeach
                            </ol>
                        @else
                            Nenhum anexo encontrado
                        @endif
                    </p>

                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item[0]->id }}/edit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Editar</a>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item[0]->id }}/delete" class="btn btn-outline btn-danger"><i class="fas fa-trash"></i>&nbsp;Excluir</a>&nbsp;&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Voltar a lista</a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection