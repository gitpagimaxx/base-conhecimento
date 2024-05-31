@extends('layouts.app')
@section('titulo', 'Midias - Novo')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('midias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <h5 class="card-header"><b>O que eu vi - Novo</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        
                        <div class="form-group">
                            <label for="Titulo">Título</label>
                            <input type="text" class="form-control" name="Titulo">
                        </div>

                        <div class="form-group">
                            <label for="Data">Data</label>
                            <input type="date" class="form-control col-sm-2" name="Data">
                        </div>

                        <div class="form-group">
                            <label for="Resenha">Resenha</label>
                            <textarea class="form-control" name="Resenha" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Anexo">Imagem / Capa</label>
                            <input type="file" class="form-control col-sm-6" name="Anexo">
                        </div>

                        <div class="form-group">
                            <label for="Avaliacao">Avaliação</label>
                            <input type="range" class="form-control col-sm-2" min="0" max="5" name="Avaliacao">
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