@extends('layouts.master')
@push('style')
    <style>
        @media print {
            .no-print {
                display: none;
            }

        }
    </style>
@endpush
@section('content')
    @php
        use Carbon\Carbon;
        use Morilog\Jalali\Jalalian;
    @endphp
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="breadcrumb">
                <a href="javascript:void(0)" class="breadcrumb-item"><i class="icon-circle-down2"></i> تنظیمات توزیع زمین</a>
                <a href="javascript:void(0)" class="breadcrumb-item"><i class="fas fa-history"></i> لاگ</a>
                <span class="breadcrumb-item active"><i class="fas fa-street-view"></i> نمایش</span>
            </div>
            <button onclick="printSection()" type="button" class="btn btn-outline-primary btn-sm no-print"><i
                    class="fas fa-print"></i>
                پرنت معلومات </button>
        </div>
    </div>
    <div id="printSection">
        <div class="card mb-1">
            <div class="card-header align-items-center">
                <h5 class="card-title">نمایش لاگ
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-1">
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">نام کاربر</th>
                                    <th class="text-center">جدول</th>
                                    <th class="text-center">تاریخ تغیرات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tableNames = [
                                        'App\Models\LandDistribution\DistributionBookFile'      => 'فایل کتاب',
                                        'App\Models\LandDistribution\DistributionLandBook'      => 'ثبت کتاب توزیع زمین',
                                        'App\Models\LandDistribution\DistributionBookPerson'    => 'مشخصات شخص',
                                        'App\Models\LandDistribution\DistributionProjectBook'   => 'نام پروژه/ کتاب',
                                        'App\Models\LandDistribution\DistributionBookVolume'    => 'جلد پروژه/ کتاب',
                                        'App\Models\LandDistribution\DistributionDocumentFile'  => 'فایل های ملکیت',
                                        'App\Models\LandDistribution\DistributionFileType'      => 'نوع فایل های ملکیت',
                                    ];
                                @endphp
                                @foreach ($audits as $audit)
                                    <tr>
                                        <td>
                                            @if ($audit->user)
                                                {{ $audit->user->name }} {{ $audit->user->last_name }}
                                            @else
                                                ناشناس
                                            @endif
                                        </td>
                                        <td>
                                            {{ $tableNames[$audit->auditable_type] ?? class_basename($audit->auditable_type) }}
                                        </td>
                                        <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($audit->created_at)->format('Y/m/d') }}
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
                    @foreach ($audits as $audit)
                        @php
                            $isMatched = $distribution_book->id == $audit->property_id;
                            $oldValues = $isMatched ? json_decode($audit->old_values, true) : null;
                        @endphp
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-0">
                                        <div class="p-3 py-2 bg-warning">
                                            <h4 class="text-center">معلومات قبلی</h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr class="text-center">
                                                        <th>پروژه</th>
                                                        <th>جلد</th>
                                                        <th>صفحه</th>
                                                        <th>نوع زمین</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td
                                                            class="{{ highlightChange($oldValues, 'project_name', $distribution_book->file->volume->project_book->project_name) }}">
                                                            {{ $isMatched ? $oldValues['project_name'] ?? $distribution_book->file->volume->project_book->project_name : $distribution_book->file->volume->project_book->project_name }}
                                                        </td>
                                                        <td
                                                            class="{{ highlightChange($oldValues, 'volume_id', $distribution_book->file->volume->volume_no) }}">
                                                            {{ $isMatched ? $oldValues['volume_id'] ?? $distribution_book->file->volume->volume_no : $distribution_book->file->volume->volume_no }}
                                                        </td>
                                                        <td
                                                            class="{{ highlightChange($oldValues, 'page_no', $distribution_book->file->page_no) }}">
                                                            {{ $isMatched ? $oldValues['page_no'] ?? $distribution_book->file->page_no : $distribution_book->file->page_no }}
                                                        </td>
                                                        <td
                                                            class="{{ highlightChange($oldValues, 'land_type', $distribution_book->land_type) }}">
                                                            {{ $isMatched ? $oldValues['land_type' == '1' ? 'تجارتی' : 'رهایشی'] ?? ($distribution_book->land_type == '1' ? 'تجارتی' : 'رهایشی') : ($distribution_book->land_type == '1' ? 'تجارتی' : 'رهایشی') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th colspan="4">تفصیلات</th>
                                                </tr>
                                            </thead>
                                            <thead class="thead-light">
                                                <tr>
                                                    <td colspan="4"
                                                        class="{{ highlightChange($oldValues, 'land_details', $distribution_book->land_details) }}">
                                                        {{ $isMatched ? $oldValues['land_details'] ?? $distribution_book->land_details : $distribution_book->land_details }}
                                                    </td>
                                                </tr>
                                            </thead>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>اسم</th>
                                                    <th colspan="2">ولد</th>
                                                    <th>ولدیت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'name', $distribution_book->book_person->name) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('name', $oldValues)
                                                                ? $oldValues['name']
                                                                : $distribution_book->book_person->name)
                                                            : $distribution_book->book_person->name }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightChange($oldValues ?? [], 'father_name', $distribution_book->book_person->father_name) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('father_name', $oldValues)
                                                                ? $oldValues['father_name']
                                                                : $distribution_book->book_person->father_name)
                                                            : $distribution_book->book_person->father_name }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'grand_father_name', $distribution_book->book_person->grand_father_name) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('grand_father_name', $oldValues)
                                                                ? $oldValues['grand_father_name']
                                                                : $distribution_book->book_person->grand_father_name)
                                                            : $distribution_book->book_person->grand_father_name }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>وظیفه</th>
                                                    <th colspan="2">نمبر تذکره</th>
                                                    <th>سکونت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'job', $distribution_book->book_person->job) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('job', $oldValues)
                                                                ? $oldValues['job']
                                                                : $distribution_book->book_person->job)
                                                            : $distribution_book->book_person->job }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightChange($oldValues ?? [], 'id_card', $distribution_book->book_person->id_card) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('id_card', $oldValues)
                                                                ? $oldValues['id_card']
                                                                : $distribution_book->book_person->id_card)
                                                            : $distribution_book->book_person->id_card }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightChange($oldValues ?? [], 'address', $distribution_book->book_person->address) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('address', $oldValues)
                                                                ? $oldValues['address']
                                                                : $distribution_book->book_person->address)
                                                            : $distribution_book->book_person->address }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>نمبر زمین</th>
                                                    <th>موضوع</th>
                                                    <th>قیمت</th>
                                                    <th>مساحت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_no', $distribution_book->land_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_no', $oldValues)
                                                                ? $oldValues['land_no']
                                                                : $distribution_book->land_no)
                                                            : $distribution_book->land_no }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_area_subject', $distribution_book->land_area_subject) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_area_subject', $oldValues)
                                                                ? $oldValues['land_area_subject']
                                                                : $distribution_book->land_area_subject)
                                                            : $distribution_book->land_area_subject }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_price', $distribution_book->land_price) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_price', $oldValues)
                                                                ? $oldValues['land_price']
                                                                : $distribution_book->land_price)
                                                            : $distribution_book->land_price }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_total_area_size', $distribution_book->land_total_area_size) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_total_area_size', $oldValues)
                                                                ? $oldValues['land_total_area_size']
                                                                : $distribution_book->land_total_area_size)
                                                            : $distribution_book->land_total_area_size }}-
                                                        @php
                                                            if ($distribution_book->land_total_area_size_type == 1) {
                                                                echo 'متر';
                                                            } elseif (
                                                                $distribution_book->land_total_area_size_type == 2
                                                            ) {
                                                                echo 'بسواسه';
                                                            } elseif (
                                                                $distribution_book->land_total_area_size_type == 3
                                                            ) {
                                                                echo 'بسوه';
                                                            } elseif (
                                                                $distribution_book->land_total_area_size_type == 4
                                                            ) {
                                                                echo 'جریب';
                                                            }
                                                        @endphp
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>شمال</th>
                                                    <th>جنوب</th>
                                                    <th>شرق</th>
                                                    <th>غرب</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_north', $distribution_book->land_north) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_north', $oldValues)
                                                                ? $oldValues['land_north']
                                                                : $distribution_book->land_north)
                                                            : $distribution_book->land_north }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_south', $distribution_book->land_south) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_south', $oldValues)
                                                                ? $oldValues['land_south']
                                                                : $distribution_book->land_south)
                                                            : $distribution_book->land_south }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_east', $distribution_book->land_east) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_east', $oldValues)
                                                                ? $oldValues['land_east']
                                                                : $distribution_book->land_east)
                                                            : $distribution_book->land_east }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_west', $distribution_book->land_west) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_west', $oldValues)
                                                                ? $oldValues['land_west']
                                                                : $distribution_book->land_west)
                                                            : $distribution_book->land_west }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>نمبر تعرفه</th>
                                                    <th>تاریخ تعرفه</th>
                                                    <th>نمبر آویز</th>
                                                    <th>تاریخ آویز</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_recept_no', $distribution_book->land_recept_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_recept_no', $oldValues)
                                                                ? $oldValues['land_recept_no']
                                                                : $distribution_book->land_recept_no)
                                                            : $distribution_book->land_recept_no }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange(
                                                            $oldValues ?? [],
                                                            'land_recept_date',
                                                            $distribution_book->land_recept_date
                                                                ? Jalalian::fromCarbon(Carbon::parse($distribution_book->land_recept_date))->format('Y/m/d')
                                                                : '',
                                                        ) }}">
                                                        {{ $oldValues['land_recept_date'] ?? $distribution_book->land_recept_date ? Jalalian::fromCarbon($oldValues['land_recept_date'] ?? $distribution_book->land_recept_date)->format('Y/m/d') : '' }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_awiz_no', $distribution_book->land_awiz_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_awiz_no', $oldValues)
                                                                ? $oldValues['land_awiz_no']
                                                                : $distribution_book->land_awiz_no)
                                                            : $distribution_book->land_awiz_no }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightChange(
                                                            $oldValues ?? [],
                                                            'land_awiz_date',
                                                            $distribution_book->land_awiz_date
                                                                ? Jalalian::fromCarbon(Carbon::parse($distribution_book->land_awiz_date))->format('Y/m/d')
                                                                : '',
                                                        ) }}">
                                                        {{ $oldValues['land_awiz_date'] ?? $distribution_book->land_awiz_date ? Jalalian::fromCarbon($oldValues['land_awiz_date'] ?? $distribution_book->land_awiz_date)->format('Y/m/d') : '' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>نمبر سند ملکیت</th>
                                                    <th colspan="2">تاریخ سند ملکیت</th>
                                                    <th>کتاب</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightChange($oldValues ?? [], 'land_molkyat_no', $distribution_book->land_molkyat_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_molkyat_no', $oldValues)
                                                                ? $oldValues['land_molkyat_no']
                                                                : $distribution_book->land_molkyat_no)
                                                            : $distribution_book->land_molkyat_no }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightChange(
                                                            $oldValues ?? [],
                                                            'land_molkyat_date',
                                                            $distribution_book->land_molkyat_date
                                                                ? Jalalian::fromCarbon(Carbon::parse($distribution_book->land_molkyat_date))->format('Y/m/d')
                                                                : '',
                                                        ) }}">
                                                        {{ $oldValues['land_molkyat_date'] ?? $distribution_book->land_molkyat_date ? Jalalian::fromCarbon($oldValues['land_molkyat_date'] ?? $distribution_book->land_molkyat_date)->format('Y/m/d') : '' }}
                                                    </td>
                                                    @php
                                                        $oldFilePath =
                                                            is_array($oldValues) && isset($oldValues['file_path'])
                                                                ? $oldValues['file_path']
                                                                : null;

                                                        $bookChanged =
                                                            $isMatched &&
                                                            $oldFilePath !== null &&
                                                            $oldFilePath != $distribution_book->file->file_path;

                                                        $Book = asset(
                                                            $isMatched && $oldFilePath !== null
                                                                ? $oldFilePath
                                                                : $distribution_book->file->file_path,
                                                        );
                                                    @endphp
                                                    <td
                                                        class="{{ $bookChanged ? 'bg-warning text-white text-center' : '' }}">
                                                        <a href="javascript:void(0)"
                                                            onclick="showBook('{{ $Book }}')">
                                                            <i class="fas fa-book-open"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th colspan="2">تعدیلات</th>
                                                    <th colspan="2">ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"
                                                        class="{{ highlightChange($oldValues ?? [], 'land_adjustment', $distribution_book->land_adjustment) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_adjustment', $oldValues)
                                                                ? $oldValues['land_adjustment']
                                                                : $distribution_book->land_adjustment)
                                                            : $distribution_book->land_adjustment }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightChange($oldValues ?? [], 'land_remark', $distribution_book->land_remark) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_remark', $oldValues)
                                                                ? $oldValues['land_remark']
                                                                : $distribution_book->land_remark)
                                                            : $distribution_book->land_remark }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if (!function_exists('highlightNewChange'))
                        @php
                            function highlightNewChange($newValues, $key, $currentValue)
                            {
                                return isset($newValues[$key]) && $newValues[$key] == $currentValue
                                    ? 'bg-info text-white'
                                    : '';
                            }
                        @endphp
                    @endif
                    @foreach ($audits as $audit)
                        @php
                            $isMatched = $distribution_book->id == $audit->property_id;
                            $newValues = $isMatched ? json_decode($audit->new_values, true) : null;
                        @endphp
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-0">
                                        <div class="p-3 py-2 bg-info">
                                            <h4 class="text-center">معلومات تصحیح شده</h4>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr class="text-center">
                                                        <th>پروژه</th>
                                                        <th>جلد</th>
                                                        <th>صفحه</th>
                                                        <th>نوع زمین</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td
                                                            class="{{ highlightNewChange($newValues, 'project_name', $distribution_book->file->volume->project_book->project_name) }}">
                                                            {{ $isMatched ? $newValues['project_name'] ?? $distribution_book->file->volume->project_book->project_name : $distribution_book->file->volume->project_book->project_name }}
                                                        </td>
                                                        <td
                                                            class="{{ highlightNewChange($newValues, 'volume_id', $distribution_book->file->volume->volume_no) }}">
                                                            {{ $isMatched ? $newValues['volume_id'] ?? $distribution_book->file->volume->volume_no : $distribution_book->file->volume->volume_no }}
                                                        </td>
                                                        <td
                                                            class="{{ highlightNewChange($newValues, 'page_no', $distribution_book->file->page_no) }}">
                                                            {{ $isMatched ? $newValues['page_no'] ?? $distribution_book->file->page_no : $distribution_book->file->page_no }}
                                                        </td>
                                                        <td
                                                            class="{{ highlightNewChange($newValues, 'land_type', $distribution_book->land_type) }}">
                                                            {{ $isMatched ? $newValues['land_type' == '1' ? 'تجارتی' : 'رهایشی'] ?? ($distribution_book->land_type == '1' ? 'تجارتی' : 'رهایشی') : ($distribution_book->land_type == '1' ? 'تجارتی' : 'رهایشی') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th colspan="4">تفصیلات</th>
                                                </tr>
                                            </thead>
                                            <thead class="thead-light">
                                                <tr>
                                                    <td colspan="4"
                                                        class="{{ highlightNewChange($newValues, 'land_details', $distribution_book->land_details) }}">
                                                        {{ $isMatched ? $newValues['land_details'] ?? $distribution_book->land_details : $distribution_book->land_details }}
                                                    </td>
                                                </tr>
                                            </thead>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>اسم</th>
                                                    <th colspan="2">ولد</th>
                                                    <th>ولدیت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'name', $distribution_book->book_person->name) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('name', $newValues)
                                                                ? $newValues['name']
                                                                : $distribution_book->book_person->name)
                                                            : $distribution_book->book_person->name }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightNewChange($newValues ?? [], 'father_name', $distribution_book->book_person->father_name) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('father_name', $newValues)
                                                                ? $newValues['father_name']
                                                                : $distribution_book->book_person->father_name)
                                                            : $distribution_book->book_person->father_name }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'grand_father_name', $distribution_book->book_person->grand_father_name) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('grand_father_name', $newValues)
                                                                ? $newValues['grand_father_name']
                                                                : $distribution_book->book_person->grand_father_name)
                                                            : $distribution_book->book_person->grand_father_name }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>وظیفه</th>
                                                    <th colspan="2">نمبر تذکره</th>
                                                    <th>سکونت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'job', $distribution_book->book_person->job) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('job', $newValues)
                                                                ? $newValues['job']
                                                                : $distribution_book->book_person->job)
                                                            : $distribution_book->book_person->job }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightNewChange($newValues ?? [], 'id_card', $distribution_book->book_person->id_card) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('id_card', $newValues)
                                                                ? $newValues['id_card']
                                                                : $distribution_book->book_person->id_card)
                                                            : $distribution_book->book_person->id_card }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightNewChange($newValues ?? [], 'address', $distribution_book->book_person->address) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('address', $newValues)
                                                                ? $newValues['address']
                                                                : $distribution_book->book_person->address)
                                                            : $distribution_book->book_person->address }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>نمبر زمین</th>
                                                    <th>موضوع</th>
                                                    <th>قیمت</th>
                                                    <th>مساحت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_no', $distribution_book->land_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_no', $newValues)
                                                                ? $newValues['land_no']
                                                                : $distribution_book->land_no)
                                                            : $distribution_book->land_no }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_area_subject', $distribution_book->land_area_subject) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_area_subject', $newValues)
                                                                ? $newValues['land_area_subject']
                                                                : $distribution_book->land_area_subject)
                                                            : $distribution_book->land_area_subject }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_price', $distribution_book->land_price) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_price', $newValues)
                                                                ? $newValues['land_price']
                                                                : $distribution_book->land_price)
                                                            : $distribution_book->land_price }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_total_area_size', $distribution_book->land_total_area_size) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_total_area_size', $newValues)
                                                                ? $newValues['land_total_area_size']
                                                                : $distribution_book->land_total_area_size)
                                                            : $distribution_book->land_total_area_size }}-
                                                        @php
                                                            if ($distribution_book->land_total_area_size_type == 1) {
                                                                echo 'متر';
                                                            } elseif (
                                                                $distribution_book->land_total_area_size_type == 2
                                                            ) {
                                                                echo 'بسواسه';
                                                            } elseif (
                                                                $distribution_book->land_total_area_size_type == 3
                                                            ) {
                                                                echo 'بسوه';
                                                            } elseif (
                                                                $distribution_book->land_total_area_size_type == 4
                                                            ) {
                                                                echo 'جریب';
                                                            }
                                                        @endphp
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>شمال</th>
                                                    <th>جنوب</th>
                                                    <th>شرق</th>
                                                    <th>غرب</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_north', $distribution_book->land_north) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_north', $newValues)
                                                                ? $newValues['land_north']
                                                                : $distribution_book->land_north)
                                                            : $distribution_book->land_north }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_south', $distribution_book->land_south) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_south', $newValues)
                                                                ? $newValues['land_south']
                                                                : $distribution_book->land_south)
                                                            : $distribution_book->land_south }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_east', $distribution_book->land_east) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_east', $newValues)
                                                                ? $newValues['land_east']
                                                                : $distribution_book->land_east)
                                                            : $distribution_book->land_east }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_west', $distribution_book->land_west) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_west', $newValues)
                                                                ? $newValues['land_west']
                                                                : $distribution_book->land_west)
                                                            : $distribution_book->land_west }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>نمبر تعرفه</th>
                                                    <th>تاریخ تعرفه</th>
                                                    <th>نمبر آویز</th>
                                                    <th>تاریخ آویز</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_recept_no', $distribution_book->land_recept_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_recept_no', $newValues)
                                                                ? $newValues['land_recept_no']
                                                                : $distribution_book->land_recept_no)
                                                            : $distribution_book->land_recept_no }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange(
                                                            $newValues ?? [],
                                                            'land_recept_date',
                                                            $distribution_book->land_recept_date
                                                                ? Jalalian::fromCarbon(Carbon::parse($distribution_book->land_recept_date))->format('Y/m/d')
                                                                : '',
                                                        ) }}">
                                                        {{ $newValues['land_recept_date'] ?? $distribution_book->land_recept_date ? Jalalian::fromCarbon($newValues['land_recept_date'] ?? $distribution_book->land_recept_date)->format('Y/m/d') : '' }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_awiz_no', $distribution_book->land_awiz_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_awiz_no', $newValues)
                                                                ? $newValues['land_awiz_no']
                                                                : $distribution_book->land_awiz_no)
                                                            : $distribution_book->land_awiz_no }}
                                                    </td>
                                                    <td
                                                        class="{{ highlightNewChange(
                                                            $newValues ?? [],
                                                            'land_awiz_date',
                                                            $distribution_book->land_awiz_date
                                                                ? Jalalian::fromCarbon(Carbon::parse($distribution_book->land_awiz_date))->format('Y/m/d')
                                                                : '',
                                                        ) }}">
                                                        {{ $newValues['land_awiz_date'] ?? $distribution_book->land_awiz_date ? Jalalian::fromCarbon($newValues['land_awiz_date'] ?? $distribution_book->land_awiz_date)->format('Y/m/d') : '' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>نمبر سند ملکیت</th>
                                                    <th colspan="2">تاریخ سند ملکیت</th>
                                                    <th>کتاب</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_molkyat_no', $distribution_book->land_molkyat_no) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_molkyat_no', $newValues)
                                                                ? $newValues['land_molkyat_no']
                                                                : $distribution_book->land_molkyat_no)
                                                            : $distribution_book->land_molkyat_no }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightNewChange(
                                                            $newValues ?? [],
                                                            'land_molkyat_date',
                                                            $distribution_book->land_molkyat_date
                                                                ? Jalalian::fromCarbon(Carbon::parse($distribution_book->land_molkyat_date))->format('Y/m/d')
                                                                : '',
                                                        ) }}">
                                                        {{ $newValues['land_molkyat_date'] ?? $distribution_book->land_molkyat_date ? Jalalian::fromCarbon($newValues['land_molkyat_date'] ?? $distribution_book->land_molkyat_date)->format('Y/m/d') : '' }}
                                                    </td>
                                                    @php
                                                        $oldFilePath =
                                                            is_array($newValues) && isset($newValues['file_path'])
                                                                ? $newValues['file_path']
                                                                : null;

                                                        $bookChanged =
                                                            $isMatched &&
                                                            $oldFilePath !== null &&
                                                            $oldFilePath != $distribution_book->file->file_path;

                                                        $Book = asset(
                                                            $isMatched && $oldFilePath !== null
                                                                ? $oldFilePath
                                                                : $distribution_book->file->file_path,
                                                        );
                                                    @endphp
                                                    <td
                                                        class="{{ $bookChanged ? 'bg-warning text-white text-center' : '' }}">
                                                        <a href="javascript:void(0)"
                                                            onclick="showBook('{{ $Book }}')">
                                                            <i class="fas fa-book-open"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th colspan="2">تعدیلات</th>
                                                    <th colspan="2">ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_adjustment', $distribution_book->land_adjustment) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_adjustment', $newValues)
                                                                ? $newValues['land_adjustment']
                                                                : $distribution_book->land_adjustment)
                                                            : $distribution_book->land_adjustment }}
                                                    </td>
                                                    <td colspan="2"
                                                        class="{{ highlightNewChange($newValues ?? [], 'land_remark', $distribution_book->land_remark) }}">
                                                        {{ $isMatched
                                                            ? (array_key_exists('land_remark', $newValues)
                                                                ? $newValues['land_remark']
                                                                : $distribution_book->land_remark)
                                                            : $distribution_book->land_remark }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $audits->links('pagination::bootstrap-4') }}
    </div>
    <div id="showBook" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <iframe src="" id="Book" class="w-100" height="820"></iframe>
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

            printWindow.document.write('<style> body { direction: rtl; font-family: Tahoma, sans-serif; } </style>');

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
            window.showBook = function(e) {
                $('#Book').attr('src', e);
                $('#showBook').modal('show');
            };
        });
    </script>
@endpush
