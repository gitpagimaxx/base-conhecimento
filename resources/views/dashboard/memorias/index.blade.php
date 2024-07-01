@extends('layouts.app')
@section('titulo', 'Memórias')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Memórias</b></div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/criar" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Novo</a>
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
                            <form action="{{ url(ENV('APP_URL')) }}/dashboard/memorias" method="get" class="row g-3">
                                <div class="col-11">
                                    <input type="search" class="form-control" name="buscar" id="buscar" placeholder="Buscar..." value="{{ $palavra }}">
                                </div>
                                <div class="col-1">
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
                                        <th>O que</th>
                                        <th>Quando</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($list ?? 0 && count($list) > 0)
                                    @foreach ($list ?? '' as $item)
                                        <tr>
                                            <td><a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $item->id }}">{{ $item->Atividade }}</a></td>    
                                            <td style="width:130px;">{{ date('d/m/Y', strtotime($item->DtHrMemoria)) }}</td>
                                            <td style="width:130px;" class="text-right">
                                                <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $item->id }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhar"><i class="fas fa-info-circle"></i></a>
                                                <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $item->id }}/edit" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url(ENV('APP_URL')) }}/dashboard/memorias/{{ $item->id }}/delete" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"><i class="fas fa-edit"></i></a>
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
                            @if ($list ?? 0 != null)
                            {{ $list->links() }}
                            @endif
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <small><b>{{$qtdeRegistros ?? 0}}</b> registros foram encontrados</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
