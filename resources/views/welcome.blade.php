@extends('include.master')

@section('title','Inventario | Inicio')

@section('page-title','Inicio')

@section('content')

<info-box></info-box>

@endsection

@push('script')

<script type="text/javascript" src="{{ url('public/js/dashboard.js') }}"></script>

@endpush