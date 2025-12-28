@extends('layouts.master')
@section('content')
    <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد صلاحیت</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>دسترسی به فارسی <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name_fa" type="text" value="{{ old('name_fa') }}"
                                        required>
                                </div>
                                @error('name_fa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>دسترسی به انگلیسی <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name_en" type="text" value="{{ old('name_en') }}"
                                        required>
                                </div>
                                @error('name_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>کتگوری صلاحیت <span class="text-danger">*</span></label>
                                    <select name="permission_category_id" class="me-sm-2 default-select form-control wide"
                                        id="inlineFormCustomSelect">
                                        <option selected>-- انتخاب کتگوری --</option>
                                        @foreach ($permission_categories as $permission_category)
                                            <option value="{{ $permission_category->id }}"
                                                {{ old('permission_gategory_id') == $permission_category->id ? 'selected' : '' }}>
                                                {{ $permission_category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('permission_category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>حالت</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="active"
                                                value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="active">فعال</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="inactive"
                                                value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inactive">غیر فعال</label>
                                        </div>
                                        @error('status')
                                            <div style="color: red;">* {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary rounded-pill btn-sm submit-btn">ذخیره معلومات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="permissionCategoryModal" tabindex="-1" aria-labelledby="permissionCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionCategoryModalLabel">ایجاد کتگوری صلاحیت</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form action="{{ route('add_permission_category') }}" method="POST">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>کتگوری صلاحیت <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" type="text" value="{{ old('name') }}"
                                        required>
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary rounded-pill btn-sm submit-btn">ذحیره معلومات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page header -->
    <div class="page-header page-header-ligh t">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item">
                        <i class="icon-gear mr-2"></i> تنظیمات کاربران
                    </a>
                    <a href="#" class="breadcrumb-item">فهرست کتگوری وصلاحیت ها</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-info">
            <h2>فهرست کتگوری وصلاحیت ها</h2>
            <div class="d-flex gap-3">

                <a href="" class="btn btn-success rounded-pill btn-sm" data-toggle="modal"
                    data-target="#permissionModal"> ایجاد صلاحیت <i class="fa fa-plus"></i></a>
                <a href="" class="btn btn-success rounded-pill btn-sm" data-toggle="modal"
                    data-target="#permissionCategoryModal"> ایجاد کتگوری صلاحیت <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mt-3 col-sm-8 col-md-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>کتگوری صلاحیت ها</th>
                                    <th class="text-center">صلاحیت ها</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permission_categories as $key => $permission_category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $permission_category->name }}</td>
                                        <td>
                                            @php
                                                $descriptions = $permission_category->permissions
                                                    ->pluck('description')
                                                    ->map(function ($description) {
                                                        return ' <span class="d-inline-flex align-items-center badge badge-info rounded-round">' .
                                                            $description .
                                                            '</span>';
                                                    });
                                            @endphp
                                            {!! implode($descriptions->toArray()) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
