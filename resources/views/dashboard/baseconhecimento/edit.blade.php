@extends('layouts.app')
@section('titulo', 'Editar Conhecimento')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('conhecimento.update', $item[0]->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <h5 class="card-header"><b>Editar Conhecimento</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        <div class="form-group">
                            <label for="Titulo">Título</label>
                            <input type="text" class="form-control" name="Titulo" value="{{ old('Titulo', $item[0]->Titulo) }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="Detalhamento">Detalhe aqui tudo o aprendeu</label>
                            <textarea class="form-control" name="Detalhamento" rows="10">{{ old('Detalhamento', $item[0]->Detalhamento) }}</textarea>
                        </div>
                        
                        <div class="form-group">

                            <label for="Detalhamento">Tag</label>

                            <select name="TagId" class="form-control col-sm-6">
                                <option value="0">Selecione...</option>
                                @foreach ($listaTags ?? '' as $itemTag)
                                <option value="{{ $itemTag->id }}">{{ $itemTag->Tag }}</option>
                                @endforeach
                            </select>

                            <p>
                            @foreach($tagsAssociadas ?? '' as $tag)
                                <span class="badge text-white bg-primary mr-2">{{$tag->Tag}}</span>
                            @endforeach
                            </p>
                            
                        </div>

                        <div class="form-group">
                            <label for="Anexo">Anexo</label>
                            <input type="file" class="form-control col-6" name="Anexo">
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{$item[0]->id}}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>
@endsection