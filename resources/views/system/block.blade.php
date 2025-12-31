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
                    <a href="#" class="breadcrumb-item">لیست بلاک</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-body">
            <div class="card-header bg-info d-flex justify-content-between align-items-center">
                <h4 class="m-b-0 text-white">لیست بلاک</h4>
                <div class="d-flex gap-2">
                    @can('add_block')
                        <a type="submit" class="btn btn-success text-white btn-sm" data-toggle="modal"
                            data-target="#modal_theme_info">
                            <i class="fas fa-plus"></i> افزودن بلاک
                        </a>
                    @endcan

                    <button type="button" id="filterButton" class="btn btn-success text-white btn-sm  ml-1">
                        <i class="fas fa-search"></i> فیلتر کردن
                    </button>
                </div>
            </div>

            <div class="card mt-2" id="search">
                <div class="card-body">
                    <h4 class="">جستجو</h4>
                    <form action="{{ route('block.index') }}" method="GET" class="action">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label>ناحیه</label>
                                <div class="form-group">
                                    <select class="form-control" id="filter_district_id" name="district">
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
                            <div class="col-md-4">
                                <label>گذر </label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <select name="guzar_id" id="filter_guzar_id" class="form-control">
                                        <option value="">لطفا گذر را انتخاب کنید</option>
                                    </select>
                                    <div class="form-control-feedback">
                                        <i class="dropdown icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 align-items-end">
                            <div class="col-md-4 d-flex gap-2">
                                <button class="btn btn-outline-info" type="submit">
                                    <i class="fas fa-search"></i> جستجو
                                </button>
                                <a href="{{ route('block.index') }}" class="btn btn-link text-danger" id="removeValue">
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
            <!-- Info modal -->
            <div id="modal_theme_info" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h6 class="modal-title">افزودن بلاک </h6>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('block.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="col-12">
                                    <label>ناحیه *</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <select class="form-control" name="district_id" id="modal_district_id">
                                            <option value="">لطفا ناحیه را انتخاب کنید</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district['id'] }}"
                                                    {{ old('district_id', $selectedDistrictId) == $district['id'] ? 'selected' : '' }}>
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
                                    <label>گذر *</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <select name="guzar_id" id="modal_guzar_id" class="form-control select-search"
                                            style="width: 100%;">
                                            <option value="">لطفا گذر را انتخاب کنید</option>
                                        </select>
                                        <div class="form-control-feedback">
                                            <i class="dropdown icon"></i>
                                        </div>
                                        @error('guzar_id')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label>بلاک *</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="number" class="form-control" placeholder="بلاک" name="block">
                                        <div class="form-control-feedback">
                                            <i class="dropdown icon"></i>
                                        </div>
                                        @error('block')
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
        </div>
    </div>
    <!-- /info modal -->
@endsection
@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            function loadGuzars(districtId, targetSelectId, selectedGuzarId = null) {
                if (!districtId) return;
                $.ajax({
                    url: '/get-guzars/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        let guzarSelect = $('#' + targetSelectId);
                        guzarSelect.empty();
                        guzarSelect.append('<option value="">لطفا گذر را انتخاب کنید</option>');
                        $.each(data, function(id, guzer_Number) {
                            let selected = selectedGuzarId == id ? 'selected' : '';
                            guzarSelect.append(
                                `<option value="${id}" ${selected}>${guzer_Number}</option>`);
                        });
                    }
                });
            }

            $('#filter_district_id').on('change', function() {
                const districtId = $(this).val();
                loadGuzars(districtId, 'filter_guzar_id');
            });

            $('#modal_district_id').on('change', function() {
                const districtId = $(this).val();
                loadGuzars(districtId, 'modal_guzar_id');
            });

            const initialFilterDistrictId = @json(request('district') ?? old('district'));
            const initialFilterGuzarId = @json(request('guzar_id') ?? old('guzar_id'));
            if (initialFilterDistrictId) {
                loadGuzars(initialFilterDistrictId, 'filter_guzar_id', initialFilterGuzarId);
            }

            const initialModalDistrictId = @json(old('district_id', $selectedDistrictId ?? null));
            const initialModalGuzarId = @json(old('guzar_id', $selectedGuzarId ?? null));
            if (initialModalDistrictId) {
                loadGuzars(initialModalDistrictId, 'modal_guzar_id', initialModalGuzarId);
            }
        });
    </script>
@endpush
