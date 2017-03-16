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
                    {{-- absolute = false to save some bandwidth--}}
                    <a href="{{ route('videos_by_tag', ['tag' => $tag], false) }}">{{$tag->tag}}</a>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection