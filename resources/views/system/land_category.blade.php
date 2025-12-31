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
                    <a href="#" class="breadcrumb-item">کتگوری زمین</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-body">
            <div class="card-header bg-info d-flex justify-content-between align-items-center">
                <h4 class="m-b-0 text-white">لیست کتگوری</h4>
                <div class="d-flex gap-2">
                    @can('add_zone')
                        <a type="submit" class="btn btn-success text-white btn-sm" data-toggle="modal"
                            data-target="#modal_theme_info">
                            <i class="fas fa-plus"></i> افزودن کتگوری
                        </a>
                        <div id="modal_theme_info" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <h6 class="modal-title">افزودن کتگوری </h6>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('land_category.store') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <label style="color: black">ناحیه *</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <select class="form-control select-search" data-fouc name="district_id"
                                                        value="{{ old('district_id') }}">
                                                        <option value="0">---انتخاب ناحیه---</option>

                                                        </option>
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
                                                <label style="color: black">زون *</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <select class="form-control select-search" id="zone_id" name="zone_id">
                                                        <option value="0">---انتخاب زون---</option>
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
                                                <label style="color: black">کتگوری *</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <input type="text" class="form-control" name="land_Category_Name"
                                                        value="{{ old('land_Category_Name') }}"
                                                        placeholder="کتگوری را وارد کنید">

                                                    <div class="form-control-feedback">
                                                        <i class="dropdown icon"></i>
                                                    </div>
                                                    @error('land_Category_Name')
                                                        <span style="color: red;">* {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label style="color: black">قیمت *</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <input type="number" step="any" class="form-control"
                                                        name="land_category_unit_Price"
                                                        value="{{ old('land_category_unit_Price') }}"
                                                        placeholder="قیمت را وارد کنید">
                                                    <div class="form-control-feedback">
                                                        <i class="dropdown icon"></i>
                                                    </div>
                                                    @error('land_category_unit_Price')
                                                        <span style="color: red;">* {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label style="color: black">موقعیت ساحه *</label>
                                                <div class="form-group form-group-feedback form-group-feedback-right">
                                                    <textarea rows="10" class="form-control" name="land_category_location" value="{{ old('land_category_location') }}"
                                                        placeholder="موقعیت ساحه را وارد کنید"></textarea>
                                                    <div class="form-control-feedback">
                                                        <i class="dropdown icon"></i>
                                                    </div>
                                                    @error('land_category_location')
                                                        <span style="color: red;">* {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-info">&nbsp; <i
                                                    class="fas fa-save"></i>ذخیره</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="card mt-2" id="search">
                <div class="card-body">
                    <h4 class="">فیلتر</h4>
                    <form action="{{ route('land_category.index') }}" method="POST" class="action">
                        @csrf

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
                                    <i class="fas fa-search"></i> فیلتر
                                </button>
                                <a href="{{ route('land_category.index') }}" class="btn btn-link text-danger"
                                    id="removeValue">
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
    <div class="modal fade" id="editZoneModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editZoneForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">تصحیح کتگوری</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="edit_land_category_id">

                        <div class="form-group">
                            <label>ناحیه</label>
                            <select id="edit_district_id" name="district_id" class="form-control select2">
                                @foreach ($districts as $district)
                                    <option value="{{ $district['id'] }}">{{ $district['district_Name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>زون</label>
                            <select id="edit_zone_id_select" name="zone_id" class="form-control select2">
                                <option value="">انتخاب زون</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>نام کتگوری</label>
                            <input type="text" id="edit_land_Category_Name" name="land_Category_Name"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label>قیمت</label>
                            <input type="number" step="any" id="edit_land_category_unit_Price"
                                name="land_category_unit_Price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>موقعیت ساحه</label>
                            <textarea id="edit_land_category_location" name="land_category_location" class="form-control" rows="5"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    </div>
                </form>
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

            $("#filterButton").click(function() {
                $("#search").toggle();
            });

            $("#removeValue").click(function() {
                $("input[type='text']").val('');
            });

            $('select[name="district_id"]').on('change', function() {
                var districtID = $(this).val();
                if (districtID) {
                    $.ajax({
                        url: '/get-zones/' + districtID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#zone_id').empty();
                            $('#zone_id').append('<option value="">انتخاب زون</option>');
                            $.each(data, function(key, value) {
                                $('#zone_id').append('<option value="' + value.id +
                                    '">' + value.zone_Name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#zone_id').empty();
                    $('#zone_id').append('<option value="">انتخاب زون</option>');
                }
            });
        });

        $(document).on('click', '.edit-land-category', function() {
            let id = $(this).data('id');
            let district_id = $(this).data('district');
            let name = $(this).data('name');

            $('#edit_land_category_id').val(id);
            $('#edit_land_Category_Name').val(name);
            $('#edit_district_id').val(district_id).trigger('change');

            loadZonesForEdit(district_id, id);

            $('#editZoneForm').attr('action', '/edit_land_category/' + id);
            $('#editZoneModal').modal('show');
        });

        function loadZonesForEdit(districtID, landCategoryID) {
            if (districtID) {
                $.ajax({
                    url: '/get-zones/' + districtID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#edit_zone_id_select').empty();
                        $('#edit_zone_id_select').append('<option value="">انتخاب زون</option>');
                        $.each(data, function(key, value) {
                            $('#edit_zone_id_select').append('<option value="' + value.id + '">' + value
                                .zone_Name + '</option>');
                        });

                        if (landCategoryID) {
                            $.ajax({
                                url: '/get-land-category/' + landCategoryID,
                                type: 'GET',
                                dataType: 'json',
                                success: function(res) {
                                    $('#edit_zone_id_select').val(res.zone_id).trigger('change');
                                    $('#edit_land_category_unit_Price').val(res
                                        .land_category_unit_Price);
                                    $('#edit_land_category_location').val(res
                                        .land_category_location);
                                }
                            });
                        }
                    }
                });
            } else {
                $('#edit_zone_id_select').empty().append('<option value="">انتخاب زون</option>');
            }
        }


        $('#edit_district_id').on('change', function() {
            let districtID = $(this).val();
            loadZonesForEdit(districtID, null);
        });
    </script>
@endpush
