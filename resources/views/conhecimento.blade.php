@extends('layouts.site', ['title' => $item[0]->Title, 'imageBg' => $item[0]->Image])

@section('header')
<div class="post-heading">
    <h1>{{ $item[0]->Title }}</h1>
    <h2 class="subheading">{{ $item[0]->Description }}</h2>
    <span class="meta">
        Postado por
        <a href="#!">{{ $item[0]->Name }}</a>
        on {{ date('d/m/Y', strtotime($item[0]->DtHrPublish)) }}
    </span>
</div>
@endsection

@section('content')

<!-- Post Content-->
<article class="mb-4">
{!! $item[0]->TextPost !!}
</article>

<section class="mb-4">
    <div class="fb-share-button" data-href="{{ url(ENV('APP_URL')) }}/{{ $item[0]->UrlFriendly }}/{{ $item[0]->id }}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div>
    <!-- <div class="ml-2">
    <a href="whatsapp://send?text={{ url(ENV('APP_URL') .'/'. $item[0]->UrlFriendly .'/'.$item[0]->id) }}">Compartilhar no Whatsapp</a>
    </div> -->
</section>

@endsection