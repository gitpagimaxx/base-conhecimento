@extends('layouts.app')
@section('titulo', 'Editar Tag')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('tag.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <h5 class="card-header"><b>Editar Tag</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        <div class="form-group">
                            <label for="Tag">Tag</label>
                            <input type="text" class="form-control col-6" name="Tag" value="{{ old('Tag', $item->Tag) }}">
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/tag" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>
@endsection