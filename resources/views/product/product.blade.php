@extends('include.master')

@section('title','Inventario | Productos')

@section('page-title','Gestión de Productos')

@section('content')

<div class="row clearfix">
    <create-product :categorys="{{ json_encode($category) }}"></create-product>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-product">
                        Nuevo Producto
                    </button>
                </h2>
            </div>

            <view-product :categorys="{{ json_encode($category) }}"></view-product>
        </div>
    </div>
</div>

@endsection

@push('script')

<script type="text/javascript" src="{{ url('public/js/product.js') }}"></script>

@endpush