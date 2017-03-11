@extends('partials.base_template')

@section('title', 'All tags')
@section('description', 'List of all tags on xxx.kocal.fr')

@section('body')
    <h1>All tags</h1>

    @foreach($sortedTags as $key => $tags)
        <h2>{{$key}}</h2>
        <ul class="list-tags">
            @foreach($tags as $tag)
                <li>
                    <a href="{{ route('tag', ['tag' => $tag->slug]) }}">{{$tag->tag}}</a>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection