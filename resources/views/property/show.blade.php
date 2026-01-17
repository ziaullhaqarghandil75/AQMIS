@extends('layouts.master')

@push('style')
    <style>
        .image-box {
            width: 400px;
            height: 300px;
            background: #ffffff;
        }

        .image-preview {
            max-width: 100%;
            max-height: 100%;
        }

        .direction-wrapper {
            position: relative;
            width: 400px;
            height: 300px;
            margin: auto;
            /* direction: rtl; */
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

        .east {
            right: 0;
            top: 50%;
            transform: translate(63%, -50%) rotate(91deg);
        }

        /* غرب = چپ طرف + rotate 90deg */
        .west {
            left: 0;
            top: 50%;
            transform: translate(-50%, -50%) rotate(90deg);
        }
    </style>
@endpush

@section('content')
    <div class="col-md-8 offset-md-2 mt-3 mb-3">
        <button class="btn btn-primary" onclick="printDiv('print')">پرنټ</button>

        <div class="card" id="print">
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
                                <td>{{ $property->property_Location }}</td>
                                <td>{{ $property->block->block_Number }}</td>
                                <td>{{ $property->project->Project_Name }}</td>
                                <td>{{ $property->property_house_Number }}</td>
                                <td>{{ $property->property_remarks }}</td>
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
                                <td>{{ $property->owner->owner_First_Name }}</td>
                                <td>{{ $property->owner->owner_Father_Name }}</td>
                                <td>{{ $property->owner->owner_GFather_Name }}</td>
                                <td>{{ $property->owner->owner_tazkira_Number }}</td>
                                <td>{{ $property->property_Code_Number }}</td>
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
                                            شمال-{{ $property->property_North }}
                                        </div>

                                        <!-- جنوب -->
                                        <div class="position-absolute south font-weight-bold">
                                            جنوب-{{ $property->property_South }}
                                        </div>

                                        <!-- شرق -->
                                        <div class="position-absolute east font-weight-bold">
                                            شرق-{{ $property->property_East }}
                                        </div>

                                        <!-- غرب -->
                                        <div class="position-absolute west font-weight-bold">
                                            غرب-{{ $property->property_West }}
                                        </div>

                                        <!-- تصویر -->
                                        <div class="image-box d-flex align-items-center justify-content-center">
                                            <img src="https://www.plannegar.com/PelanFiles/100.jpg" class="image-preview">
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
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($property->propertyValue as $Value)
                                @php
                                    $total +=
                                        $Value->landCategory == null
                                            ? $Value->buildingCategory->building_Category_unit_Price * $Value->Scale
                                            : $Value->landCategory->land_category_unit_Price * $Value->Scale;
                                @endphp
                                <tr>
                                    <td>{{ $Value->emaratType->emarat_Type_Name }}</td>
                                    <td>{{ $Value->landCategory == null ? $Value->buildingCategory->building_Category_Type_Name : $Value->landCategory->land_Category_Name }}
                                    </td>
                                    <td>{{ $Value->Number_of_Floors }}</td>
                                    <td>{{ $Value->landCategory == null ? $Value->Scale .
                                    'm³ ' : $Value->Scale . 'm² ' }}
                                    </td>
                                    <td>{{ $Value->landCategory == null ? $Value->buildingCategory->building_Category_unit_Price : $Value->landCategory->land_category_unit_Price }}
                                    </td>
                                    <td>{{ $Value->landCategory == null ? $Value->buildingCategory->building_Category_unit_Price * $Value->Scale : $Value->landCategory->land_category_unit_Price * $Value->Scale }}
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="2">تاریخ قیمت ګذاری</td>
                                <td colspan="2">{{ $property->Property_Pricing_Date }}</td>
                                <td>سرجمع قیمت به افغانی</td>
                                <td>{{ $total }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">امضاء هیات</td>
                                <td colspan="2">امضاء مالک</td>
                                <td>ملاحظات ناحیه مربوطه</td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
