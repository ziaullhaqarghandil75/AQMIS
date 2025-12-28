@extends('layouts.master')
@push('style')
    <style>
        /* @media print {
            body {
                direction: ltr;
                font-family: Tahoma, sans-serif;
            }

            .table-responsive {
                overflow: visible !important;
            }

            @page {
                size: landscape;
                margin: 10mm;
            }
        } */
        @media print {
    .no-print {
        display: none;
    }
    .bg-warning {
        background-color: yellow !important;
        -webkit-print-color-adjust: exact;
    }
    .text-white {
        color: black !important;
    }
}
    </style>
@endpush
@section('content')
    @php
        use Carbon\Carbon;
        use Morilog\Jalali\Jalalian;
    @endphp
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="breadcrumb">
                <a href="javascript:void(0)" class="breadcrumb-item"><i class="icon-circle-down2"></i> تنظیمات ثبت املاک</a>
                <a href="javascript:void(0)" class="breadcrumb-item"><i class="fas fa-history"></i> لاگ</a>
                <span class="breadcrumb-item active"><i class="fas fa-street-view"></i> نمایش</span>
            </div>
            <button onclick="printSection()" type="button" class="btn btn-outline-primary btn-sm no-print"><i
                    class="fas fa-print"></i>
                پرنت معلومات </button>
        </div>
    </div>
    <!-- /page header -->
    <div id="show_book_img" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <iframe src="" id="myframe" class="w-100" height="820"></iframe>
            </div>
        </div>
    </div>
    <div id="printSection">
        <div class="row">
            <div class="col-12">
                <div class="card mb-1">
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <th class="text-center">نام کاربر</th>
                                <th class="text-center">جدول</th>
                                <th class="text-center">تاریخ تغیرات</th>
                            </thead>
                            <tbody>
                                @foreach ($audits as $audit)
                                    <tr>
                                        <td>
                                            @if ($audit->user)
                                                {{ $audit->user->name }} {{ $audit->user->last_name }}
                                            @else
                                                ناشناس
                                            @endif
                                        </td>
                                        <td>{{ class_basename($audit->auditable_type) }}</td>
                                        <td>{{ Jalalian::fromDateTime($audit->created_at)->format('Y/m/d') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {{-- start new informition --}}
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="p-2 py-3">
                            <h4 class="text-center">معلومات جدید</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered my-2">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ناحیه</th>
                                        <th>جلد</th>
                                        <th>صفحه</th>
                                        <th>شماره دفتر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $book_of_real_estate_registration->district->name_da }}</td>
                                        <td>{{ $book_of_real_estate_registration->district_book->volume }}</td>
                                        <td>{{ $book_of_real_estate_registration->page_no }}</td>
                                        <td>{{ $book_of_real_estate_registration->dafter_no }}</td>
                                    </tr>
                                </tbody>
                                <thead class="thead-light">
                                    <tr>
                                        <th>تاریخ</th>
                                        <th>شماره فورمه</th>
                                        <th>نمبر سرک</th>
                                        <th>نمبر خانه</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $book_of_real_estate_registration->book_date }}</td>
                                        <td>{{ $book_of_real_estate_registration->form_no }}</td>
                                        <td>{{ $book_of_real_estate_registration->street_no }}</td>
                                        <td>{{ $book_of_real_estate_registration->home_no }}</td>
                                    </tr>
                                </tbody>
                                <thead class="thead-light">
                                    <tr>
                                        <th>اسم</th>
                                        <th>پدر</th>
                                        <th>پدر کلان </th>
                                        <th>موقعیت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $book_of_real_estate_registration->peoples->first()->name }}</td>
                                        <td>{{ $book_of_real_estate_registration->peoples->first()->father_name }}</td>
                                        <td>{{ $book_of_real_estate_registration->peoples->first()->grand_father_name }}
                                        </td>
                                        <td>{{ $book_of_real_estate_registration->address }}</td>
                                    </tr>
                                </tbody>
                                <thead class="thead-light">
                                    <tr>
                                        <th>سند ملکیت</th>
                                        <th>نمبر ملکیت</th>
                                        <th>مساحت زمین</th>
                                        <th>نوع تعمیر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $book_of_real_estate_registration->property_description }}</td>
                                        <td>{{ $book_of_real_estate_registration->document_no }}</td>
                                        <td>{{ $book_of_real_estate_registration->area }}
                                            {{ $book_of_real_estate_registration->unit->name }}
                                        </td>
                                        <td>{{ $book_of_real_estate_registration->type_of_buildings->name }}</td>
                                    </tr>
                                </tbody>
                                <thead class="thead-light">
                                    <tr>
                                        <th>تعداد طبقات</th>
                                        <th>صفحه دفتر سابقه</th>
                                        <th>محصول زمین</th>
                                        <th>قیمت زمین</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $book_of_real_estate_registration->number_of_floor }}</td>
                                        <td>{{ $book_of_real_estate_registration->book_number_of_record }}</td>
                                        <td>{{ $book_of_real_estate_registration->tax }}</td>
                                        <td>{{ $book_of_real_estate_registration->peoples->first()->price }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- start book comment -->
                        <div class="table-responsive">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center bg-info">ملاحظات</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>توضیحات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($book_of_real_estate_registration->book_comment->isNotEmpty())
                                        @foreach ($book_of_real_estate_registration->book_comment as $key => $book_comment)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>

                                                <td>
                                                    {{ $book_comment->comments ?? '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                ملاحظات موجود نیست
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- end book comment -->
                        <!-- start final price -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="10" class="text-center bg-info">بیع قاطع</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم</th>
                                        <th>پدر</th>
                                        <th>پدر کلان</th>
                                        <th>قیمت زمین</th>
                                        <th>توضیحات سند ملکیت</th>
                                        <th>تاییدی ناحیه</th>
                                        <th>توضیحات تاییدی ناحیه</th>
                                        <th> تصویر کتاب</th>
                                        <th>قباله</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($book_of_real_estate_registration->peoples as $key => $person)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $person->name }}</td>
                                            <td>{{ $person->father_name }}</td>
                                            <td>{{ $person->grand_father_name }}</td>
                                            <td>{{ $person->price }}</td>
                                            <td>{{ $person->pivot->comments }}</td>

                                            <td>
                                                @if ($person->district_approvals != null)
                                                    @if ($person->district_approvals->district_approval_and_reject == '1')
                                                        تایید
                                                    @elseif($person->district_approvals->district_approval_and_reject == '0')
                                                        رد
                                                    @else
                                                        معلق
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($person->district_approvals != null)
                                                    @if ($person->district_approvals->district_approval_and_reject == '1')
                                                        {{ $person->district_approvals->district_book->volume }} - صفحه :
                                                        {{ $person->district_approvals->district_book_page_no }}
                                                    @elseif($person->district_approvals->district_approval_and_reject == '0')
                                                        {{ $person->district_approvals->description }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" onclick="show_img('{{ asset($person->book_img) }}')"
                                                    title="تصویر کتاب">
                                                    <i class="fas fa-book"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" onclick="show_img('{{ asset($person->person_img) }}')"
                                                    title="قباله">
                                                    <i class="fas fa-book"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end final price -->
                        <!-- start mortgage rates  -->
                        <div class="table-responsive">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th colspan="10" class="text-center bg-info">بیع جایز</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم</th>
                                        <th>پدر</th>
                                        <th>پدر کلان</th>
                                        <th>قیمت زمین</th>
                                        <th>توضیحات</th>
                                        <th>تاییدی ناحیه</th>
                                        <th>توضیحات تاییدی ناحیه</th>
                                        <th> تصویر کتاب</th>
                                        <th>قباله</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$book_of_real_estate_registration->mortgageRatesPersons->isEmpty())
                                        @foreach ($book_of_real_estate_registration->mortgageRatesPersons as $Key => $person)
                                            <tr>
                                                <td>{{ $Key + 1 }}</td>
                                                <td>{{ $person->name }}</td>
                                                <td>{{ $person->father_name }}</td>
                                                <td>{{ $person->grand_father_name }}</td>
                                                <td>{{ $person->price }}</td>
                                                <td>{{ $person->pivot->comments }}</td>
                                                <td>
                                                    @if ($person->district_approvals != null)
                                                        @if ($person->district_approvals->district_approval_and_reject == '1')
                                                            تایید
                                                        @elseif($person->district_approvals->district_approval_and_reject == '0')
                                                            رد
                                                        @else
                                                            معلق
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($person->district_approvals != null)
                                                        @if ($person->district_approvals->district_approval_and_reject == '1')
                                                            {{ $person->district_approvals->district_book->volume }} - صفحه
                                                            :
                                                            {{ $person->district_approvals->district_book_page_no }}
                                                        @elseif($person->district_approvals->district_approval_and_reject == '0')
                                                            {{ $person->district_approvals->description }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" onclick="show_img('{{ asset($person->book_img) }}')"
                                                        title="تصویر کتاب">
                                                        <i class="fas fa-book"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#"
                                                        onclick="show_img('{{ asset($person->person_img) }}')"
                                                        title="قباله">
                                                        <i class="fas fa-book"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">بیع جایز موجود نیست</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- end mortgage rates  -->
                        <!-- start under control  -->
                        <div class="table-responsive">
                            <table class="table datatable-basic">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="text-center bg-info">تحت مراقبت</th>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>توضیحات</th>
                                        <th>تاییدی ناحیه</th>
                                        <th>توضیحات تاییدی ناحیه</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$book_of_real_estate_registration->under_controls->isEmpty())
                                        @foreach ($book_of_real_estate_registration->under_controls as $KEY => $under_comment)
                                            <tr>
                                                <td> {{ $KEY + 1 }}</td>
                                                <td>{{ $under_comment->comments }}</td>
                                                <td>
                                                    @if ($under_comment->district_approvals != null)
                                                        @if ($under_comment->district_approvals->district_approval_and_reject == '1')
                                                            تایید
                                                        @elseif($under_comment->district_approvals->district_approval_and_reject == '0')
                                                            رد
                                                        @else
                                                            معلق
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($under_comment->district_approvals != null)
                                                        @if ($under_comment->district_approvals->district_approval_and_reject == '1')
                                                            {{ $under_comment->district_approvals->district_book->volume }}
                                                            -
                                                            صفحه :
                                                            {{ $under_comment->district_approvals->district_book_page_no }}
                                                        @elseif($under_comment->district_approvals->district_approval_and_reject == '0')
                                                            {{ $under_comment->district_approvals->description }}
                                                        @endif
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">تحت مراقبت موجود نیست</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- end under control  -->
                    </div>
                    {{-- end new informition --}}
                    {{-- start old informition --}}
                    @foreach ($audits as $audit)
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="p-2 py-3">
                                <h4 class="text-center">معلومات قبلی</h4>
                            </div>
                            @if (!function_exists('highlightChange'))
                                @php
                                    function highlightChange($oldValues, $key, $currentValue)
                                    {
                                        return isset($oldValues[$key]) && $oldValues[$key] != $currentValue
                                            ? 'bg-warning text-white'
                                            : '';
                                    }
                                @endphp
                            @endif
                            @php
                                $isMatched = $book_of_real_estate_registration->id == $audit->auditable_id;
                                $oldValues = $isMatched ? json_decode($audit->old_values, true) : null;
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered my-2">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ناحیه</th>
                                            <th>جلد</th>
                                            <th>صفحه</th>
                                            <th>شماره دفتر</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td
                                                class="{{ highlightChange($oldValues, 'district_id', $book_of_real_estate_registration->district_id) }}">
                                                {{ $isMatched && isset($oldValues['district_id'])
                                                    ? App\Models\LandDistributionAuthority\District::find($oldValues['district_id'])?->name_da ??
                                                        $book_of_real_estate_registration->district->name_da
                                                    : $book_of_real_estate_registration->district->name_da }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'book_no_id', $book_of_real_estate_registration->book_no_id) }}">
                                                {{ $isMatched && isset($oldValues['book_no_id'])
                                                    ? App\Models\LandDeed\district_books::find($oldValues['book_no_id'])?->volume ??
                                                        $book_of_real_estate_registration->district_book->volume
                                                    : $book_of_real_estate_registration->district_book->volume }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'page_no', $book_of_real_estate_registration->page_no) }}">
                                                {{ $isMatched ? $oldValues['page_no'] ?? $book_of_real_estate_registration->page_no : $book_of_real_estate_registration->page_no }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'dafter_no', $book_of_real_estate_registration->dafter_no) }}">
                                                {{ $isMatched ? $oldValues['dafter_no'] ?? $book_of_real_estate_registration->dafter_no : $book_of_real_estate_registration->dafter_no }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead class="thead-light">
                                        <tr>
                                            <th>تاریخ</th>
                                            <th>شماره فورمه</th>
                                            <th>نمبر سرک</th>
                                            <th>نمبر خانه</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td
                                                class="{{ highlightChange($oldValues, 'book_date', $book_of_real_estate_registration->book_date) }}">
                                                {{ $isMatched ? $oldValues['book_date'] ?? $book_of_real_estate_registration->book_date : $book_of_real_estate_registration->book_date }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'form_no', $book_of_real_estate_registration->form_no) }}">
                                                {{ $isMatched ? $oldValues['form_no'] ?? $book_of_real_estate_registration->form_no : $book_of_real_estate_registration->form_no }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'street_no', $book_of_real_estate_registration->street_no) }}">
                                                {{ $isMatched ? $oldValues['street_no'] ?? $book_of_real_estate_registration->street_no : $book_of_real_estate_registration->street_no }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'home_no', $book_of_real_estate_registration->home_no) }}">
                                                {{ $isMatched ? $oldValues['home_no'] ?? $book_of_real_estate_registration->home_no : $book_of_real_estate_registration->home_no }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead class="thead-light">
                                        <tr>
                                            <th>اسم</th>
                                            <th>پدر</th>
                                            <th>پدر کلان </th>
                                            <th>موقعیت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                                $isMatchedPeople =
                                                    $book_of_real_estate_registration->peoples->first()->id ==
                                                    $audit->auditable_id;
                                                $oldValuesPeople = $isMatchedPeople
                                                    ? json_decode($audit->old_values, true) ?? []
                                                    : [];
                                            @endphp
                                            <td
                                                class="{{ highlightChange($oldValuesPeople, 'name', $book_of_real_estate_registration->peoples->first()->name) }}">
                                                {{ $isMatchedPeople ? $oldValuesPeople['name'] ?? $book_of_real_estate_registration->peoples->first()->name : $book_of_real_estate_registration->peoples->first()->name }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValuesPeople, 'father_name', $book_of_real_estate_registration->peoples->first()->father_name) }}">
                                                {{ $isMatchedPeople ? $oldValuesPeople['father_name'] ?? $book_of_real_estate_registration->peoples->first()->father_name : $book_of_real_estate_registration->peoples->first()->father_name }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValuesPeople, 'grand_father_name', $book_of_real_estate_registration->peoples->first()->grand_father_name) }}">
                                                {{ $isMatchedPeople ? $oldValuesPeople['grand_father_name'] ?? $book_of_real_estate_registration->peoples->first()->grand_father_name : $book_of_real_estate_registration->peoples->first()->grand_father_name }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'address', $book_of_real_estate_registration->address) }}">
                                                {{ $isMatched ? $oldValues['address'] ?? $book_of_real_estate_registration->address : $book_of_real_estate_registration->address }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead class="thead-light">
                                        <tr>
                                            <th>سند ملکیت</th>
                                            <th>نمبر ملکیت</th>
                                            <th>مساحت زمین</th>
                                            <th>نوع تعمیر</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td
                                                class="{{ highlightChange($oldValues, 'property_description', $book_of_real_estate_registration->property_description) }}">
                                                {{ $isMatched ? $oldValues['property_description'] ?? $book_of_real_estate_registration->property_description : $book_of_real_estate_registration->property_description }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'document_no', $book_of_real_estate_registration->document_no) }}">
                                                {{ $isMatched ? $oldValues['document_no'] ?? $book_of_real_estate_registration->document_no : $book_of_real_estate_registration->document_no }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'area', $book_of_real_estate_registration->area) }}">
                                                {{ $isMatched
                                                    ? $oldValues['area'] ?? $book_of_real_estate_registration->area
                                                    : $book_of_real_estate_registration->area }}
                                                -
                                                <span
                                                    class="{{ highlightChange($oldValues, 'unit_id', $book_of_real_estate_registration->unit_id) }}">
                                                    {{ $isMatched
                                                        ? App\Models\LandDeed\Unit::find($oldValues['unit_id'] ?? null)?->name ??
                                                            $book_of_real_estate_registration->unit->name
                                                        : $book_of_real_estate_registration->unit->name }}
                                                </span>
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'type_of_building_id', $book_of_real_estate_registration->type_of_building_id) }}">
                                                {{ $isMatched && isset($oldValues['type_of_building_id'])
                                                    ? App\Models\LandDeed\type_of_building::find($oldValues['type_of_building_id'])
                                                            ?->name ?? $book_of_real_estate_registration->type_of_buildings->name
                                                    : $book_of_real_estate_registration->type_of_buildings->name }}
                                            </td>

                                        </tr>
                                    </tbody>
                                    <thead class="thead-light">
                                        <tr>
                                            <th>تعداد طبقات</th>
                                            <th>صفحه دفتر سابقه</th>
                                            <th>محصول زمین</th>
                                            <th>قیمت زمین</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td
                                                class="{{ highlightChange($oldValues, 'number_of_floor', $book_of_real_estate_registration->number_of_floor) }}">
                                                {{ $isMatched ? $oldValues['number_of_floor'] ?? $book_of_real_estate_registration->number_of_floor : $book_of_real_estate_registration->number_of_floor }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'book_number_of_record', $book_of_real_estate_registration->book_number_of_record) }}">
                                                {{ $isMatched ? $oldValues['book_number_of_record'] ?? $book_of_real_estate_registration->book_number_of_record : $book_of_real_estate_registration->book_number_of_record }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValues, 'tax', $book_of_real_estate_registration->tax) }}">
                                                {{ $isMatched ? $oldValues['tax'] ?? $book_of_real_estate_registration->tax : $book_of_real_estate_registration->tax }}
                                            </td>
                                            <td
                                                class="{{ highlightChange($oldValuesPeople, 'price', $book_of_real_estate_registration->peoples->first()->price) }}">
                                                {{ $isMatchedPeople ? $oldValuesPeople['price'] ?? $book_of_real_estate_registration->peoples->first()->price : $book_of_real_estate_registration->peoples->first()->price }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- start book comment -->
                            <div class="table-responsive">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center bg-info">ملاحظات</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>توضیحات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$book_of_real_estate_registration->book_comment->isEmpty())
                                            @foreach ($book_of_real_estate_registration->book_comment as $key => $book_comment)
                                                @php
                                                    $isMatched = $book_comment->id == $audit->auditable_id;
                                                    $oldValues = $isMatched
                                                        ? json_decode($audit->old_values, true)
                                                        : null;
                                                @endphp
                                                <tr class="{{ $isMatched ? 'bg-warning' : '' }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        {{ $isMatched ? $oldValues['comments'] ?? '' : optional($book_comment)->comments ?? '' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2" class="text-center">ملاحظات موجود نیست</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- end book comment -->
                            <!-- start final price -->
                            <div class="table-responsive">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th colspan="10" class="text-center bg-info">بیع قاطع</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم</th>
                                            <th>پدر</th>
                                            <th>پدر کلان</th>
                                            <th>قیمت زمین</th>
                                            <th>توضیحات سند ملکیت</th>
                                            <th>تاییدی ناحیه</th>
                                            <th>توضیحات تاییدی ناحیه</th>
                                            <th>تصویر کتاب</th>
                                            <th>قباله</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!function_exists('highlightChange'))
                                            @php
                                                function highlightChange($oldValues, $key, $currentValue)
                                                {
                                                    return isset($oldValues[$key]) && $oldValues[$key] != $currentValue
                                                        ? 'bg-danger text-white'
                                                        : '';
                                                }
                                            @endphp
                                        @endif

                                        @foreach ($book_of_real_estate_registration->peoples as $key => $person)
                                            @php
                                                $isMatched = $person->id == $audit->auditable_id;
                                                $oldValues = $isMatched
                                                    ? json_decode($audit->old_values, true) ?? []
                                                    : [];
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="{{ highlightChange($oldValues, 'name', $person->name) }}">
                                                    {{ $isMatched ? $oldValues['name'] ?? $person->name : $person->name }}
                                                </td>

                                                <td
                                                    class="{{ highlightChange($oldValues, 'father_name', $person->father_name) }}">
                                                    {{ $isMatched ? $oldValues['father_name'] ?? $person->father_name : $person->father_name }}
                                                </td>

                                                <td
                                                    class="{{ highlightChange($oldValues, 'grand_father_name', $person->grand_father_name) }}">
                                                    {{ $isMatched ? $oldValues['grand_father_name'] ?? $person->grand_father_name : $person->grand_father_name }}
                                                </td>

                                                <td class="{{ highlightChange($oldValues, 'price', $person->price) }}">
                                                    {{ $isMatched ? $oldValues['price'] ?? $person->price : $person->price }}
                                                </td>
                                                @if (
                                                    $person->pivot->id == $audit->auditable_id and
                                                        $audit->auditable_type ==
                                                            'App\Models\book_of_real_estate_registration_folder\book_of_real_estate_registration_final_states')
                                                    <td class="bg-danger text-white">
                                                        {{ $oldValues['comments'] ?? '' }}
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ $person->pivot->comments }}
                                                    </td>
                                                @endif

                                                <td>
                                                    @switch($person->district_approvals->district_approval_and_reject ??
                                                        null)
                                                        @case('1')
                                                            تایید
                                                        @break

                                                        @case('0')
                                                            رد
                                                        @break

                                                        @default
                                                            معلق
                                                    @endswitch
                                                </td>

                                                <td>
                                                    @if ($person->district_approvals)
                                                        @if ($person->district_approvals->district_approval_and_reject == '1')
                                                            {{ $person->district_approvals->district_book->volume }} -
                                                            صفحه :
                                                            {{ $person->district_approvals->district_book_page_no }}
                                                        @elseif ($person->district_approvals->district_approval_and_reject == '0')
                                                            {{ $person->district_approvals->description }}
                                                        @endif
                                                    @endif
                                                </td>

                                                @php
                                                    $book_img_changed =
                                                        $isMatched &&
                                                        isset($oldValues['book_img']) &&
                                                        $oldValues['book_img'] != $person->book_img;
                                                    $book_img = asset(
                                                        $isMatched && isset($oldValues['book_img'])
                                                            ? $oldValues['book_img']
                                                            : $person->book_img,
                                                    );
                                                @endphp
                                                <td class="{{ $book_img_changed ? 'bg-warning text-white' : '' }}">
                                                    <a href="javascript:void(0)"
                                                        onclick="show_img('{{ $book_img }}')" title="تصویر کتاب">
                                                        <i class="fas fa-book"></i>
                                                    </a>
                                                </td>

                                                @php
                                                    $person_img_changed =
                                                        $isMatched &&
                                                        isset($oldValues['person_img']) &&
                                                        $oldValues['person_img'] != $person->person_img;
                                                    $deed = asset(
                                                        $isMatched && isset($oldValues['person_img'])
                                                            ? $oldValues['person_img']
                                                            : $person->person_img,
                                                    );
                                                @endphp
                                                <td class="{{ $person_img_changed ? 'bg-warning text-white' : '' }}">
                                                    <a href="javascript:void(0)"
                                                        onclick="show_img('{{ $deed }}')" title="تصویر شخص">
                                                        <i class="fas fa-book"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end final price -->
                            <!-- start mortgage rates  -->
                            <div class="table-responsive">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th colspan="10" class="text-center bg-info">بیع جایز</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم</th>
                                            <th>پدر</th>
                                            <th>پدر کلان</th>
                                            <th>قیمت زمین</th>
                                            <th>توضیحات</th>
                                            <th>تاییدی ناحیه</th>
                                            <th>توضیحات تاییدی ناحیه</th>
                                            <th>تصویر کتاب</th>
                                            <th>قباله</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$book_of_real_estate_registration->mortgageRatesPersons->isEmpty())
                                            @if (!function_exists('highlightChange'))
                                                @php
                                                    function highlightChange($oldValues, $key, $currentValue)
                                                    {
                                                        return isset($oldValues[$key]) &&
                                                            $oldValues[$key] != $currentValue
                                                            ? 'bg-danger text-white'
                                                            : '';
                                                    }
                                                @endphp
                                            @endif

                                            @foreach ($book_of_real_estate_registration->mortgageRatesPersons as $key => $person)
                                                @php
                                                    $isMatched =
                                                        $person->id == $audit->auditable_id ||
                                                        $person->pivot->id == $audit->auditable_id;
                                                    $oldValues = $isMatched
                                                        ? json_decode($audit->old_values, true) ?? []
                                                        : [];
                                                @endphp
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td class="{{ highlightChange($oldValues, 'name', $person->name) }}">
                                                        {{ $isMatched ? $oldValues['name'] ?? $person->name : $person->name }}
                                                    </td>

                                                    <td
                                                        class="{{ highlightChange($oldValues, 'father_name', $person->father_name) }}">
                                                        {{ $isMatched ? $oldValues['father_name'] ?? $person->father_name : $person->father_name }}
                                                    </td>

                                                    <td
                                                        class="{{ highlightChange($oldValues, 'grand_father_name', $person->grand_father_name) }}">
                                                        {{ $isMatched ? $oldValues['grand_father_name'] ?? $person->grand_father_name : $person->grand_father_name }}
                                                    </td>

                                                    <td
                                                        class="{{ highlightChange($oldValues, 'price', $person->price) }}">
                                                        {{ $isMatched ? $oldValues['price'] ?? $person->price : $person->price }}
                                                    </td>

                                                    @if ($person->pivot->id == $audit->auditable_id)
                                                        <td class="bg-danger text-white">
                                                            {{ $oldValues['comments'] ?? '' }}
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ $person->pivot->comments }}
                                                        </td>
                                                    @endif

                                                    <td>
                                                        @switch($person->district_approvals->district_approval_and_reject ??
                                                            null)
                                                            @case('1')
                                                                تایید
                                                            @break

                                                            @case('0')
                                                                رد
                                                            @break

                                                            @default
                                                                معلق
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @if ($person->district_approvals)
                                                            @if ($person->district_approvals->district_approval_and_reject == '1')
                                                                {{ $person->district_approvals->district_book->volume }} -
                                                                صفحه :
                                                                {{ $person->district_approvals->district_book_page_no }}
                                                            @elseif ($person->district_approvals->district_approval_and_reject == '0')
                                                                {{ $person->district_approvals->description }}
                                                            @endif
                                                        @endif
                                                    </td>

                                                    @php
                                                        $book_img_changed =
                                                            $isMatched &&
                                                            isset($oldValues['book_img']) &&
                                                            $oldValues['book_img'] != $person->book_img;
                                                        $book_img = asset(
                                                            $isMatched && isset($oldValues['book_img'])
                                                                ? $oldValues['book_img']
                                                                : $person->book_img,
                                                        );
                                                    @endphp
                                                    <td class="{{ $book_img_changed ? 'bg-warning text-white' : '' }}">
                                                        <a href="javascript:void(0)"
                                                            onclick="show_img('{{ $book_img }}')"
                                                            title="تصویر کتاب">
                                                            <i class="fas fa-book"></i>
                                                        </a>
                                                    </td>

                                                    @php
                                                        $person_img_changed =
                                                            $isMatched &&
                                                            isset($oldValues['person_img']) &&
                                                            $oldValues['person_img'] != $person->person_img;
                                                        $person_img = asset(
                                                            $isMatched && isset($oldValues['person_img'])
                                                                ? $oldValues['person_img']
                                                                : $person->person_img,
                                                        );
                                                    @endphp
                                                    <td class="{{ $person_img_changed ? 'bg-warning text-white' : '' }}">
                                                        <a href="javascript:void(0)"
                                                            onclick="show_img('{{ $person_img }}')" title="تصویر شخص">
                                                            <i class="fas fa-book"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center">بیع جایز موجود نیست</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- end mortgage rates  -->
                            <!-- start under control  -->
                            <div class="table-responsive">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-center bg-info">تحت مراقبت</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>توضیحات</th>
                                            <th>تاییدی ناحیه</th>
                                            <th>توضیحات تاییدی ناحیه</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$book_of_real_estate_registration->under_controls->isEmpty())
                                            @foreach ($book_of_real_estate_registration->under_controls as $KEY => $under_comment)
                                                @php
                                                    $isMatched = $under_comment->id == $audit->auditable_id;
                                                    $oldValues = $isMatched
                                                        ? json_decode($audit->old_values, true)
                                                        : null;
                                                @endphp
                                                <tr class="{{ $isMatched ? 'bg-warning' : '' }}">
                                                    <td> {{ $KEY + 1 }}</td>
                                                    <td>
                                                        {{ $isMatched ? $oldValues['comments'] ?? '' : optional($under_comment)->comments ?? '' }}

                                                    </td>
                                                    <td>
                                                        @if ($under_comment->district_approvals != null)
                                                            @if ($under_comment->district_approvals->district_approval_and_reject == '1')
                                                                تایید
                                                            @elseif($under_comment->district_approvals->district_approval_and_reject == '0')
                                                                رد
                                                            @else
                                                                معلق
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($under_comment->district_approvals != null)
                                                            @if ($under_comment->district_approvals->district_approval_and_reject == '1')
                                                                {{ $under_comment->district_approvals->district_book->volume }}
                                                                - صفحه
                                                                :
                                                                {{ $under_comment->district_approvals->district_book_page_no }}
                                                            @elseif($under_comment->district_approvals->district_approval_and_reject == '0')
                                                                {{ $under_comment->district_approvals->description }}
                                                            @endif
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">تحت مراقبت موجود نیست</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- end under control  -->
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $audits->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function printSection() {
            var printContents = document.getElementById('printSection').innerHTML;
            var originalContents = document.body.innerHTML;

            if (!printContents) {
                alert("محتوای چاپی پیدا نشد!");
                return;
            }

            var printDate = moment();
            var persianDate = printDate.format('YYYY/MM/DD - HH:mm:ss');

            var username = "<?php echo auth()->user()->name; ?>";

            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print</title>');

            printWindow.document.write(
                '<style> body { direction: rtl; font-family: Tahoma, sans-serif; } </style>'
            );

            printWindow.document.write(document.head.cloneNode(true).outerHTML);
            printWindow.document.write('</head><body>');

            printWindow.document.write('<p style="display: flex; justify-content: space-between;">');
            printWindow.document.write('<span> ' + username + '</span>');
            printWindow.document.write('<span> ' + persianDate + '</span>');
            printWindow.document.write('</p>');

            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');

            printWindow.document.close();
        }
    </script>
    <script>
        $(document).ready(function() {
            window.show_img = function(img_path) {
                $('#myframe').attr('src', img_path);
                $('#show_book_img').modal('show');
            };
        });
    </script>
@endpush
