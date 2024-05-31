@extends('layouts.app')
@section('titulo', 'Criar Memória')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('memorias.store') }}" method="POST">
            @csrf
            <div class="card">
                <h5 class="card-header"><b>Criar Memória</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        
                        <div class="form-group">
                            <label for="Atividade">O que rolou?</label>
                            <input type="text" class="form-control" name="Atividade" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="DtHrMemoria">Quando?</label>
                            <input type="date" class="form-control col-sm-2" name="DtHrMemoria">
                        </div>

                        <div class="form-group">
                            <label for="Detalhamento">Detalhe aqui o que quiser</label>
                            <textarea class="form-control" name="Detalhamento" rows="5"></textarea>
                        </div>

                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>

@endsection