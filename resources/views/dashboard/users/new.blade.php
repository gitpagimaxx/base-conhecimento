@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card">
                <h5 class="card-header"><b>Cadastrar Usuário</b></h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control col-6" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">E-mail</label>
                            <input type="email" class="form-control col-6" name="email">
                        </div>
                        <div class="form-group">
                            <label for="name">Telefone <small>(DDD Telefone)</small></label>
                            <input type="tel" class="form-control col-2" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="name">Twitter</label>
                            <input type="text" class="form-control col-2" name="twitter">
                        </div>

                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control col-2" name="instagram">
                        </div>

                        <div class="form-group">
                            <label for="facebook">Facebook <small>(Página)</small></label>
                            <input type="text" class="form-control col-2" name="facebook">
                        </div>

                        <div class="form-group">
                            <label for="type_user_id">Tipo Usuário</label>
                            <select name="type_user_id" class="form-control col-6">
                                <option value="0">Selecione...</option>
                                @foreach ($typeUserList as $typeUser)
                                <option value="{{$typeUser->id}}">{{$typeUser->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <input type="hidden" name="UserId" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Salvar</button>&nbsp;
                    <a href="{{ url(ENV('APP_URL')) }}/blog-admin/users" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i>&nbsp;Cancelar</a>
                </div>

            </div>
            </form>

        </div>
    </div>
</div>
@endsection