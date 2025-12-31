@extends('layouts.master')
@push('style')
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endpush
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item"><i class="fas fa-cogs  mr-2"></i> سیستم
                    </a>
                    <a href="#" class="breadcrumb-item">لیست گذر</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-body">
            <div class="card-header bg-info d-flex justify-content-between align-items-center">
                <h4 class="m-b-0 text-white">لیست گذر</h4>
                <div class="d-flex gap-2">
                    @can('add_guzar')
                        <a type="submit" class="btn btn-success text-white btn-sm" data-toggle="modal"
                            data-target="#modal_theme_info">
                            <i class="fas fa-plus"></i> افزودن گذر
                        </a>
                        <div id="modal_theme_info" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <h6 class="modal-title">افزودن گذر </h6>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('guzar.store') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <label>ناحیه</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <select class="form-control select-search" data-fouc name="district_id"
                                                        value="{{ old('district_id') }}">
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district['id'] }}"
                                                                {{ old('district_id') == $district['id'] ? 'selected' : '' }}>
                                                                {{ $district['district_Name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-control-feedback">
                                                        <i class="dropdown icon"></i>
                                                    </div>
                                                    @error('district_id')
                                                        <span style="color: red;">* {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>گذر</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <input type="number" class="form-control" placeholder="گذر" name="guzer_Number">
                                                    <div class="form-control-feedback">
                                                        <i class="dropdown icon"></i>
                                                    </div>
                                                    @error('guzer_Number')
                                                        <span style="color: red;">* {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn bg-info">&nbsp; <i
                                                    class="fas fa-save"></i>ذخیره</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endcan

                    <button type="button" id="filterButton" class="btn btn-success text-white btn-sm  ml-1">
                        <i class="fas fa-search"></i> فیلتر کردن
                    </button>
                </div>
            </div>

            <div class="card mt-2" id="search">
                <div class="card-body">
                    <h4 class="">جستجو</h4>
                    <form action="{{ route('guzar.index') }}" method="GET" class="action">
                        <div class="row mb-1">
                            <div class="col-4">
                                <div class="form-group">
                                    <select class="form-control" id="district_id" name="district">
                                        <option value="">-- انتخاب ناحیه --</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district['id'] }}"
                                                {{ old('district', request('district')) == $district['id'] ? 'selected' : '' }}>
                                                {{ $district['district_Name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 align-items-end">
                            <div class="col-md-4 d-flex gap-2">
                                <button class="btn btn-outline-info" type="submit">
                                    <i class="fas fa-search"></i> جستجو
                                </button>
                                <a href="{{ route('guzar.index') }}" class="btn btn-link text-danger" id="removeValue">
                                    تنظیم مجدد
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /info modal -->
@endsection
@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/form_select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select-search').select2({
                dropdownParent: $('#modal_theme_info')
            });
            $('#modal_theme_info').on('shown.bs.modal', function() {
                $('.select-search').select2({
                    dropdownParent: $('#modal_theme_info')
                });
            });
        });
        $(document).ready(function() {
            $("#filterButton").click(function() {
                $("#search").toggle();
            });
            $("#removeValue").click(function() {
                $("input[type='text']").val('');
            });

        });
    </script>
@endpush
