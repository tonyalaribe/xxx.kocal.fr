<div class="text-center">
    {{ $videos }}
</div>

@foreach($videos->chunk(4) as $chunk)
    <div class="row">
        @foreach($chunk as $video)
            <div class="col-md-3 col-xs-6">
                <div class="video" itemscope itemtype="http://schema.org/VideoObject">
                    <meta itemprop="url" content="{{ $video->url }}"/>
                    <meta itemprop="name" content="{{ $video->title }}"/>
                    <meta itemprop="duration" content="{{ $video->ISO8601Duration }}"/>
                    <meta itemprop="thumbnail" content="{{ $video->thumbnail_url }}"/>
                    <a href="{{ $video->url }}" class="video__link thumbnail text-center">
                        <img src="{{ $video->thumbnail_url }}"
                             class="video__thumbnail"
                             alt="Thumbnail of « {{ $video->title }} » video">
                        <span class="video__title">{{ $video->title }}</span>
                        <span class="video__duration">{{ $video->duration }}</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

<div class="text-center">
    {{ $videos }}
</div>
