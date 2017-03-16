@extends('admin.partials.base_template')

@section('title', 'Manage videos')

@section('body')
    <div id="app"></div>
@endsection

@push('scripts')
<script src="{{ mix('js/app-admin.js') }}"></script>
@endpush
