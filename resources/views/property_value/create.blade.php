@extends('layouts.master')

@push('style')
    <style>
        .image-box {
            width: 300px;
            height: 300px;
            background: #f2f3f4;
        }

        .image-preview {
            max-width: 100%;
            max-height: 100%;
        }

        .direction-wrapper {
            position: relative;
            width: 300px;
            height: 300px;
            margin: auto;
            direction: rtl;
        }

        /* شمال */
        .north {
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* جنوب */
        .south {
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 50%);
        }

        /* شرق = ښی طرف */
        .east {
            right: 0;
            top: 50%;
            transform: translate(50%, -50%);
        }

        /* غرب = چپ طرف */
        .west {
            left: 0;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush

@section('content')
    <div class="card" id="property_values">
        <div class="card-body">
            <div class="form-group">
                <button type="button" class="btn bg-success" data-toggle="modal" data-target="#building_modal">د ساختمان
                    محاسبه
                    <i class="icon-play3 ml-2"></i></button>
                <button type="button" class="btn bg-info" data-toggle="modal" data-target="#land_modal">د ځمکی محاسبه
                    <i class="icon-play3 ml-2"></i></button>
                <a href="{{ route('properties.show', $property_Id) }}" class="btn bg-info"> د
                    ودانۍ د بیې
                    فورمه چاپول
                    <i class="icon-play3 ml-2"></i></a>
            </div>
        </div>
    </div>
    <div id="building_modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title">Success header</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('propertiesValue.store') }}" method="POST" id="frm_building_property_value">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>emarat_type_id</label>
                                    <select class="form-control select-search" data-fouc name="emarat_type_id">
                                        <option value="">عمارت وټاکئ</option>
                                        @foreach ($emarats as $emarat)
                                            <option value="{{ $emarat->id }}">
                                                {{ $emarat->emarat_Type_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>building_Categories</label>
                                    <select class="form-control select-search" data-fouc name="building_category_id">
                                        <option value="">کټګوری ساختمان وټاکئ</option>
                                        @foreach ($buildingCategories as $buildingCategory)
                                            <option value="{{ $buildingCategory->id }}">
                                                {{ $buildingCategory->building_Category_Type_Name }}
                                                {{ $buildingCategory->building_Category_details }}
                                                {{ $buildingCategory->building_Category_unit_type }}
                                                {{ $buildingCategory->building_Category_unit_Price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Number_of_Floors</label>
                                    <input type="text" name="Number_of_Floors" class="form-control"
                                        placeholder="Number_of_Floors" value="{{ $property->Number_of_Floors ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Scale</label>
                                    <input type="text" name="Scale" class="form-control" placeholder="Scale"
                                        value="{{ $property->Scale ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-success">{{ isset($property) ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="land_modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">Info header</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('propertiesValue.store') }}" method="POST" id="frm_land_property_value">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>emarat_type_id</label>
                                    <select class="form-control select-search" data-fouc name="emarat_type_id">
                                        <option value="">عمارت وټاکئ</option>
                                        @foreach ($emarats as $emarat)
                                            <option value="{{ $emarat->id }}">
                                                {{ $emarat->emarat_Type_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>distict</label>
                                    <select class="form-control select-search" data-fouc id="land_district">
                                        <option value="">ناحیه وټاکئ</option>
                                        @foreach ($disticts as $distict)
                                            <option value="{{ $distict->id }}">
                                                {{ $distict->district_Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>zones</label>
                                    <select class="form-control select-search" data-fouc id="zone">
                                        <option value="">زون وټاکئ</option>
                                        {{-- When a district is selected, all related Guzars are loaded --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>land_categories_id</label>
                                    <select class="form-control select-search" data-fouc id="land_categories_id"
                                        name="land_categories_id">
                                        <option value="">کټګوری وټاکئ</option>
                                        {{-- When a Guzar is selected, all related Blocks are loaded --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Scale</label>
                                    <input type="text" name="Scale" class="form-control" placeholder="Scale"
                                        value="{{ $property->Scale ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-info">{{ isset($property) ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="Building_Valuation_modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Full width modal</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-md-8 offset-md-2 mt-3 mb-3">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <table class="table text-center border-0" id="Building_Valuation_Form_Table">
                                    <tbody>
                                        <tr>
                                            <td>QRCode</td>
                                            <td>کابل ښارولی</td>
                                            <td>شماره مسلسل</td>
                                        </tr>
                                        <tr>
                                            <td>شماره ثبت</td>
                                            <td></td>
                                            <td>قیمت (۲۰)افغانی</td>
                                        </tr>
                                        <tr>
                                            <td>نمره ثبت فورمه کراهی</td>
                                            <td>فورمه قیمت ګذاری عمرانات</td>
                                            <td>نمبر خصوصی</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card card-table text-center table-responsive shadow-0 mb-0">
                                    <table class="table table-bordered" id="Building_Valuation_Form_Table">
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">موقعیت عمارت</td>
                                                <td>منطقه</td>
                                                <td>ناحیه</td>
                                                <td>نام یا نمبر سرک</td>
                                                <td>نمبر خانه به اساس نقشه شهری</td>
                                                <td>ملاحظات</td>
                                            </tr>
                                            <tr>
                                                <td>دهبوری</td>
                                                <td>۳</td>
                                                <td>سرک</td>
                                                <td>۶۰متره</td>
                                                <td>۵</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">هویت مالک</td>
                                                <td>اسم مالک</td>
                                                <td>اسم پدر مالک</td>
                                                <td> اسم پدر کلان مالک </td>
                                                <td> نمبر تذکره</td>
                                                <td>سند ملکیت</td>
                                            </tr>
                                            <tr>
                                                <td>احمد</td>
                                                <td>مختار</td>
                                                <td>ګل ولی</td>
                                                <td>46466</td>
                                                <td>63</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <table class="table text-center">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="5">نوعیت استفاده از ملکیت</td>
                                                            </tr>
                                                            <tr>
                                                                <td>مالک خانه</td>
                                                                <td>خانه کرایی</td>
                                                                <td>خانه ګروی</td>
                                                                <td>دکان</td>
                                                                <td>سرای</td>
                                                            </tr>
                                                            <tr>
                                                                <td>ګراچی</td>
                                                                <td>ورکشاپ</td>
                                                                <td>رستورانت</td>
                                                                <td>هوتل</td>
                                                                <td>ګدام</td>
                                                            </tr>
                                                            <tr>
                                                                <td>حمام</td>
                                                                <td>اپارتمان</td>
                                                                <td>دفتر </td>
                                                                <td>معاینه خانه</td>
                                                                <td>وغیره</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    موقعیت باید اندازه زمین مشترک علامه سرک وعمارات مربوطه زمین به مقیاس
                                                    ۵۰۰:۱ و دقت پنجاه سانتی نشان داده شود. ارتفاع هر تعمیر نشان عدد در بین
                                                    یک قوس و کتګوری ان به عدد در بین هر تعمیر تحریر ګردد
                                                </td>
                                                <td colspan="3">
                                                    <div class="direction-wrapper">

                                                        <!-- شمال -->
                                                        <div class="position-absolute north font-weight-bold">
                                                            شمال
                                                        </div>

                                                        <!-- جنوب -->
                                                        <div class="position-absolute south font-weight-bold">
                                                            جنوب
                                                        </div>

                                                        <!-- شرق -->
                                                        <div class="position-absolute east font-weight-bold">
                                                            شرق
                                                        </div>

                                                        <!-- غرب -->
                                                        <div class="position-absolute west font-weight-bold">
                                                            غرب
                                                        </div>

                                                        <!-- تصویر -->
                                                        <div
                                                            class="image-box d-flex align-items-center justify-content-center">
                                                            <img src="https://www.plannegar.com/PelanFiles/100.jpg"
                                                                class="image-preview">
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>قیمت ګذاری عمارات وزمین</td>
                                                <td>کتګوری ساختمان</td>
                                                <td>تعداد طبقه</td>
                                                <td>اندازه به متر مکعب متر مربع یا متر طول</td>
                                                <td>قیمت فی واحد به افغانی </td>
                                                <td>مجموعه قیمت</td>
                                            </tr>
                                            <tr>
                                                <td>دهبوری</td>
                                                <td>۳</td>
                                                <td>سرک</td>
                                                <td>۶۰متره</td>
                                                <td>۵</td>
                                                <td>۵</td>
                                            </tr>
                                            <tr>
                                                <td>دهبوری</td>
                                                <td>۳</td>
                                                <td>سرک</td>
                                                <td>۶۰متره</td>
                                                <td>۵</td>
                                                <td>۵</td>
                                            </tr>
                                            <tr>
                                                <td>دهبوری</td>
                                                <td>۳</td>
                                                <td>سرک</td>
                                                <td>۶۰متره</td>
                                                <td>۵</td>
                                                <td>۵</td>
                                            </tr>
                                            <tr>
                                                <td>دهبوری</td>
                                                <td>۳</td>
                                                <td>سرک</td>
                                                <td>۶۰متره</td>
                                                <td>۵</td>
                                                <td>۵</td>
                                            </tr>
                                            <tr>
                                                <td>دهبوری</td>
                                                <td>۳</td>
                                                <td>سرک</td>
                                                <td>۶۰متره</td>
                                                <td>۵</td>
                                                <td>۵</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">تاریخ قیمت ګذاری</td>
                                                <td colspan="2">۲۰۲۵/۵/۴</td>
                                                <td>سرجمع قیمت به افغانی</td>
                                                <td>۱۳۱۲۴۲۳۴۲</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">امضاء هیات</td>
                                                <td colspan="2">امضاء مالک</td>
                                                <td>ملاحظات ناحیه مربوطه</td>
                                                <td>۱۳۱۲۴۲۳۴۲</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-body">

            <div class="card card-table table-responsive shadow-0 mb-0">
                <table class="table table-bordered" id="TblPropertyValue">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>dasdf</th>
                            <th>کټګوری ساختمان</th>
                            <th>تعداد طبقه</th>
                            <th>اندازه به متر مکعب </th>
                            <th>قیمت فی واحد به افغانی</th>
                            <th>مجموعه</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#building_modal').on('shown.bs.modal', function() {
                $('.select-search').select2({
                    dropdownParent: $('#building_modal')
                });
            });
            $('#land_modal').on('shown.bs.modal', function() {
                $('.select-search').select2({
                    dropdownParent: $('#land_modal')
                });
            });
        });
    </script>
    <script>
        let zoneUrl = "{{ route('dependent.district.zones', ':id') }}";
        let landCategoriesUrl = "{{ route('dependent.zone.categories', ':id') }}";

        $('#land_district').on('change', function() {

            let districtId = $(this).val();

            $('#zone').html('<option value="">— زون انتخاب کړئ —</option>');

            if (!districtId) return;

            $.get(zoneUrl.replace(':id', districtId), function(data) {

                $.each(data, function(i, item) {
                    $('#zone').append(
                        `<option value="${item.id}">${item.zone_Name}</option>`
                    );
                });
            });
        });
        $('#zone').on('change', function() {

            let zoneId = $(this).val();

            $('#land_categories_id').html('<option value="">— کټګوری انتخاب کړئ —</option>');

            if (!zoneId) return;

            $.get(landCategoriesUrl.replace(':id', zoneId), function(data) {
                $.each(data, function(i, item) {
                    $('#land_categories_id').append(
                        `<option value="${item.id}">${item.land_Category_Name}</option>`
                    );
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const property_Id = @json($property_Id);
            $('#frm_building_property_value,#frm_land_property_value').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this);
                formData.append('property_Id', property_Id);
                $.ajax({
                    url: '{{ route('propertiesValue.store') }}',
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(result) {

                        var tr = "";
                        var total = 0;
                        $.each(result.data, function(index, item) {
                            const buildingPrice = item.building_category
                                ?.building_Category_unit_Price ?? 0;
                            const landPrice = item.land_category
                                ?.land_category_unit_Price ?? 0;
                            total += item.land_categories_id === null ? (buildingPrice *
                                item.Scale) : (landPrice * item.Scale)

                            tr += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.emarat_type?.emarat_Type_Name ?? ''}</td>
                                    <td>${item.land_categories_id === null ? item.building_category?.building_Category_Type_Name : item.land_category?.land_Category_Name}</td>
                                    <td>${item.Number_of_Floors ?? ''}</td>
                                    <td>${item.Scale ?? 0}</td>
                                    <td>${item.land_categories_id==null? item.building_category.building_Category_unit_Price:item.land_category.land_category_unit_Price }</td>
                                    <td>${item.land_categories_id === null? (buildingPrice * item.Scale):(landPrice * item.Scale)}</td>
                                    <td>
                                        <!-- actions here -->
                                    </td>
                                </tr>`;
                        });
                        tr += `
                            <tr>
                                <td colspan="6"></td>
                                <td>${total }</td>
                                <td></td>
                            </tr>`;

                        $('#TblPropertyValue > tbody').html('').html(tr);
                        this.reset();
                        $(this).closest('.modal').modal('hide');
                        alert('د قیمت ګذاری معلومات په کامیابۍ سره ثبت شول');


                    },
                    complete: function() {},
                    error: function(error) {}
                });
            });


        });
    </script>
@endpush
