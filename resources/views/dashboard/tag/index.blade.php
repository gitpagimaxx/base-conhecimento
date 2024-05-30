@extends('layouts.app')
@section('titulo', 'Tags')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Tags</b></div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/tag/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Novo</a>
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
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Tag</th>
                                        <th>Data</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach ($list ?? '' as $item)
                                    <tr>
                                        <td><a href="{{ url(ENV('APP_URL')) }}/dashboard/tag/{{ $item->id }}/edit" title="Detalhar">{{ $item->Tag }}</a></td>
                                        <td style="width:160px;">{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                        <td style="width:130px;" class="text-right">
                                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/tag/{{ $item->id }}/edit" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhar"><i class="fas fa-edit"></i></a>
                                            <a href="{{ url(ENV('APP_URL')) }}/dashboard/tag/{{ $item->id }}/delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                
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
