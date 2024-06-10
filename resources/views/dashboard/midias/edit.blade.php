@extends('layouts.app')
@section('titulo', 'Editar Memória')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('midias.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <h5 class="card-header"><b>Editar Memória</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        
                        <div class="form-group">
                            <label for="Titulo">Título</label>
                            <input type="text" class="form-control" name="Titulo" value="{{ old('Titulo', $item->Titulo) }}" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="Data">Data</label>
                            <input type="date" class="form-control col-sm-2" name="Data" value="{{ old('Data', \Carbon\Carbon::parse($item->Data)->format('Y-m-d')) }}">
                        </div>

                        <div class="form-group">
                            <label for="Resenha">Resenha</label>
                            <textarea class="form-control" name="Resenha" rows="5">{{ old('Resenha', $item->Resenha) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="Anexo">Imagem / Capa</label>
                            <input type="file" class="form-control col-sm-6" name="Anexo" accept="image/x-png,image/gif,image/jpeg">
                        </div>

                        <div class="form-group">
                            <label for="Avaliacao">Avaliação</label>
                            <input type="range" class="form-control col-sm-2" min="0" max="5" name="Avaliacao" value="{{ old('Avaliacao', $item->Avaliacao) }}">
                        </div>

                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/midias" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>
@endsection