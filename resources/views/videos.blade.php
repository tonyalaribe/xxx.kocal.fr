@extends('partials.base_template')

@section('title', 'Videos')

@section('description')
    All videos, page {{$videos->currentPage()}} on {{$videos->lastPage()}}.
@endsection

@push('metadata')
@if($videos->total() > 0)
    <meta property="og:image" content="{{$videos->first()->thumbnail_url}}">
@endif
@endpush

@section('body')
    <h1>{{$videos->total() }} videos</h1>

    @include('partials.videos_list_and_paginations', ['videos' => $videos])
@endsection