@extends('layouts.app')
@section('titulo', 'Perfil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('profile.update', $item[0]->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <h5 class="card-header"><b>Perfil</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control col-6" name="name" value="{{ old('Name', $item[0]->name) }}">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control col-6" name="email" value="{{ old('Email', $item[0]->email) }}">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="text" class="form-control col-6" name="phone" value="{{ old('Phone', $item[0]->phone) }}">
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>
@endsection