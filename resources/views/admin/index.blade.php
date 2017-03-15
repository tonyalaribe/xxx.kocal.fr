@extends('admin.partials.base_template')

@section('body')
    <div id="app"></div>
@endsection

@push('scripts')
<script src="{{ mix('js/app-admin.js') }}"></script>
@endpush
