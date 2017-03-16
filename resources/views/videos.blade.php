@extends('partials.base_template')

@section('title', 'Videos')

@section('description')
    All videos, page {{$videos->currentPage()}} on {{$videos->lastPage()}}.
@endsection

@push('metadata')
<meta property="og:image" content="{{$videos->first()->thumbnail_url}}">
@endpush

@section('body')
    <h1>{{$videos->total() }} videos</h1>

    @include('partials.videos', ['videos' => $videos])
@endsection