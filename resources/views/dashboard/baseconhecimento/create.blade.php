@extends('layouts.app')
@section('titulo', 'Criar Conhecimento')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('conhecimento.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <h5 class="card-header"><b>Cadastrar Conhecimento</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        <div class="form-group">
                            <label for="Titulo">Título</label>
                            <input type="text" class="form-control" name="Titulo" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="Detalhamento">Detalhe aqui o que quiser</label>
                            <textarea class="form-control" name="Detalhamento" rows="10"></textarea>
                        </div>

                        <div class="form-group">

                            <label for="TagId">Tag</label>

                            <select name="TagId" class="form-control col-sm-6">
                                <option value="0">Selecione...</option>
                                @foreach ($listaTags ?? '' as $itemTag)
                                <option value="{{ $itemTag->id }}">{{ $itemTag->Tag }}</option>
                                @endforeach
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="Anexo">Anexo</label>
                            <input type="file" class="form-control col-sm-6" name="Anexo">
                        </div>

                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tags</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select name="tags" id="tags">
        @foreach ($listaTags ?? '' as $itemTag)
            <option value="">{{ $itemTag->Tag }}</option>
        @endforeach
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">X</button>
        <button type="button" class="btn btn-primary">Adicionar</button>
      </div>
    </div>
  </div>
</div>

<script>

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

</script>

@endsection