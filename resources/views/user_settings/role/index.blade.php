@extends('layouts.master')
@section('content')
    <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ایجاد دسترسی</h5>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form action="{{ route('roles.store') }}" method="POST">
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
                                <button class="btn btn-primary rounded-pill submit-btn">ذخیره معلومات</button>
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
                    <a href="#" class="breadcrumb-item">فهرست دسترسی</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-info">
            <h2>فهرست دسترسی</h2>
            <a href="" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#roleModal">
                ایجاد دسترسی <i class="fa fa-plus"></i></a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mt-3 col-sm-8 col-md-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>سطح دسترسی</th>
                                    <th class="text-center">حالت</th>
                                    <th class="text-center">اجازه دسترسی</th>
                                    <th class="text-center">عملیه</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td class="text-center">
                                            {!! $role->status == '1'
                                                ? '<span class="badge light badge-success rounded-pill"><i class="icon-user-check"></i>  فعال </span>'
                                                : '<span class="badge light badge-danger rounded-pill"><i class="icon-user-cancel"></i> غیر فعال </span>' !!}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('roles.show', $role->id) }}"
                                                class="btn btn-info btn-sm rounded-pill"><b></b>
                                                افزودن درسترسی
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-success btn-sm rounded-pill"
                                                data-toggle="modal" data-target="#editRoleModal{{ $role->id }}">
                                                تصحیح <i class="icon-pencil7"></i>
                                            </a>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="delete btn btn-danger btn-sm rounded-pill"><b></b>
                                                    حذف <i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Role for each -->
                                    <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1"
                                        aria-labelledby="editRoleLabel{{ $role->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRoleLabel{{ $role->id }}">تصحیح
                                                        دسترسی</h5>
                                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="basic-form">
                                                        <form action="{{ route('roles.update', $role->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>دسترسی به فارسی <span
                                                                            class="text-danger">*</span></label>
                                                                    <input class="form-control" name="name_fa"
                                                                        type="text" value="{{ $role->name }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>دسترسی به انگلیسی <span
                                                                            class="text-danger">*</span></label>
                                                                    <input class="form-control" name="name_en"
                                                                        type="text" value="{{ $role->description }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>حالت</label>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="status" value="1"
                                                                            {{ $role->status == 1 ? 'checked' : '' }}>
                                                                        <label class="form-check-label">فعال</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="status" value="0"
                                                                            {{ $role->status == 0 ? 'checked' : '' }}>
                                                                        <label class="form-check-label">غیر فعال</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="m-t-20 text-center">
                                                                <button class="btn btn-primary rounded-pill">تصحیح
                                                                    معلومات</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
