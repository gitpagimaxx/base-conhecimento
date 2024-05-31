@extends('layouts.app')
@section('titulo', 'Conhecimentos')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Base de Conhecimento</b></div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Novo</a>
                        </div>
                    </div>
                    @if(!empty(Session::get('message')))
                        <div class="alert alert-success"> {{ Session::get('message') }}</div>
                    @endif
                    @if(!empty(Session::get('error')))
                        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <form action="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento" method="get" class="row g-3">
                                <div class="col-sm-2">
                                    <select name="tipoBusca" id="tipoBusca" class="form-control">
                                        <option value="1">Texto</option>
                                        <option value="2">Tag</option>
                                    </select>
                                </div>
                                <div class="col-sm-9">
                                    <input type="search" class="form-control" name="buscar" id="buscar" placeholder="Buscar...">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(!empty($palavra))
                    <div class="row mb-2">
                        <div class="col">
                            Filtrado por <b>{{ $palavra }}</b>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Tags</th>
                                        <th>Data</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($list) > 0)
                                    @foreach ($list ?? '' as $item)
                                    <tr>
                                        <td><a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item->id }}">{{ $item->Titulo }}</a></td>    
                                        <td style="width:200px;"> 
                                            @foreach ($item->Tags as $key => $value)
                                                <span class="badge text-white bg-primary mr-1">{{ $value->Tag; }}</span>
                                            @endforeach
                                        </td>
                                        <td style="width:130px;">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                        <td style="width:120px;" class="text-right">
                                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item->id }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhar"><i class="fas fa-info-circle"></i></a>
                                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item->id }}/edit" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/conhecimento/{{ $item->id }}/delete" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                    @else
                                    <td colspan="3">Nenhum registro encontrado</td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col text-right">
                            {{ $list->links() }}
                        </div>
                    </div>

                    
                    
                </div>

                <div class="card-footer">
                    <small><b>{{$qtdeRegistros}}</b> registros foram encontrados</small>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
