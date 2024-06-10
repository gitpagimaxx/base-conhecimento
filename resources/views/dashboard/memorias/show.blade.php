@extends('layouts.app')
@section('titulo', 'Detalhes da Memória')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header"><b>Memórias</b></h5>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/criar" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Novo</a>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <h1>{{ $model[0]->Atividade }}</h1>

                    <hr>

                    <p>
                        {!! $model[0]->Detalhamento !!}
                    </p>

                    <p>
                        Atividade realizada em <b>{{ date('d/m/Y', strtotime($model[0]->DtHrMemoria)) }}</b>
                    </p>

                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $model[0]->id }}/edit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Editar</a>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $model[0]->id }}/delete" class="btn btn-outline btn-danger"><i class="fas fa-trash"></i>&nbsp;Excluir</a>&nbsp;&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Voltar a lista</a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection