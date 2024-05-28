@extends('layouts.app')
@section('titulo', 'Excluir Conhecimento')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <form action="{{ route('conhecimento.destroy', $item[0]->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                <div class="card-header">{{ __('Excluir Conhecimento') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col">

                    <p>
                    Deseja realmente excluir <b>{{ $item[0]->Titulo }}</b>?
                    </p>
                    
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-thumbs-up"></i>&nbsp;Sim</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento" class="btn btn-outline-secondary"><i class="fas fa-thumbs-down"></i>&nbsp;Não</a>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection