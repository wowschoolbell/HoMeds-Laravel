@extends('layouts.master')
@section('title', 'Store')

@section('content')
<div class="container " style="margin-top: 3%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive p-t-10">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $create_route = route('admin.delivery_partner.create');
@endphp
@endsection

@include('layouts.partials.datatable_scripts')
@include('layouts.partials.ajax_save_scripts')
