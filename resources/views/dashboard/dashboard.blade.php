@extends('layouts.app')
@section('titulo', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-sm-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <b>Qtd. Conhecimentos</b>
                </div>
                <div class="card-body">
                    <h1 class="text-center">{{$qtdeConhecimento}}</h1>
                </div>
                <div class="card-footer">
                    <small>Total</small>
                </div>
            </div>
        </div>

        <div class="col-sm-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <b>Qtd. Memórias</b>
                </div>
                <div class="card-body">
                    <h1 class="text-center">{{$qtdeMemorias}}</h1>
                </div>
                <div class="card-footer">
                    <small>Total</small>
                </div>
            </div>
        </div>

        <div class="col-sm-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <b>Vago</b>
                </div>
                <div class="card-body">
                    <h1 class="text-center">0</h1>
                </div>
                <div class="card-footer">
                    <small>Total</small>
                </div>
            </div>
        </div>

        <div class="col-sm-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <b>Vago</b>
                </div>
                <div class="card-body">
                    <h1 class="text-center">0</h1>
                </div>
                <div class="card-footer">
                    <small>Total</small>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <b>Últimos 5 conhecimentos</b>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$conhecimento->isEmpty())
                            @foreach ($conhecimento->take(5) as $item)
                                <tr>
                                    <td><a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item->id }}">{{ $item->Titulo }}</a></td>    
                                    <td style="width:160px;">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="3">Nenhum registro encontrado</td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <small>Do total de {{$qtdeConhecimento}} | <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento">Ir para os conhecimentos</a></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <b>Últimas 5 memórias</b>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>O que</th>
                                <th>Quando</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$memorias->isEmpty())
                            @foreach ($memorias->take(5) as $item)
                                <tr>
                                    <td><a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $item->id }}">{{ $item->Atividade }}</a></td>    
                                    <td style="width:160px;">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="3">Nenhum registro encontrado</td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <small>Do total de {{$qtdeMemorias}} | <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias">Ir para as memórias</a></small>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
