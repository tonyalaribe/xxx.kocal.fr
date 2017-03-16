<div class="text-center">
    {{ $videos }}
</div>

@foreach($videos->chunk(4) as $chunk)
    <div class="row">
        @foreach($chunk as $video)
            <div class="col-md-3 col-xs-6">
                <a href="{{ $video->url }}" class="thumbnail text-center">
                    <img src="{{$video->thumbnail_url}}" alt="Thumbnail of « {{$video->title}} » video">
                    {{$video->title}}
                </a>
            </div>
        @endforeach
    </div>
@endforeach

<div class="text-center">
    {{ $videos }}
</div>
