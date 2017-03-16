@extends('partials.base_template')

@section('title', 'Categories')
@section('description', 'List of categories on xxx.kocal.fr')

@section('body')
    <h1>/categories</h1>

    <div class="row">

        {{ $categories }}
        @foreach($categories as $category)
            <div class="col-md-3 col-xs-6">
                {{$category}}
                {{--<a href="{{ route('tag', ['tag' => $category->tag->slug]) }}"--}}
                   {{--class="thumbnail text-center">--}}
                    {{--<img src="{{ $category->videos->thumbnail_url }}"--}}
                         {{--alt="Category {{ $category->tag->tag }}">--}}
                    {{--{{ $category->tag->tag }}--}}
                {{--</a>--}}
            </div>
        @endforeach
    </div>

@endsection