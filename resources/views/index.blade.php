@extends('layouts.site', ['title' => 'Principal'])

@section('header')
<div class="site-heading">
    <h1>Sua Base de Conhecimento</h1>
    <span class="subheading">Guarde aqui de forma resumida tudo o que precisa se lembrar diariamente de forma rápida, deixe de ocupar seus colegas</span>
</div>
@endsection

@section('content')

<div class="post-preview">
    O que procura?
    <input type="text" name="busca" class="form-control">
    <button class="btn btn-lg btn-primary">Buscar</button>
</div>

@endsection