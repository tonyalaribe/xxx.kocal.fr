@extends('partials.base_template')

@section('title', 'Popular tags')
@section('description', 'Popular tags on xxx.kocal.fr')

@section('body')
    <h1>{{ $maxPopularTags }} popular tags</h1>

    @foreach($popularTags->chunk(4) as $chunk)
        <div class="row">
            @foreach($chunk as $popularTag)
                <div class="col-md-3 col-xs-6">
                    <div class="video">
                        <a href="{{ route('videos_by_tag', ['tag' => $popularTag]) }}"
                           class="video__link thumbnail text-center">
                            <img src="{{ $popularTag->videos->first()->thumbnail_url }}"
                                 class="video__thumbnail"
                                 alt="Thumbnail for « {{ $popularTag->tag }} » tag">
                            <span class="video__title">{{ $popularTag->tag }}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection