@extends('layouts.master')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="icon-circle-down2"></i> تنظیمات آمریت توزیع زمین</a>
                    <a href="#" class="breadcrumb-item"><i class="fas fa-history"></i> لاگ</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-body ">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-striped']) }}
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
