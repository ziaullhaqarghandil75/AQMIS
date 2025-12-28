@extends('layouts.master')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-ligh t">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item">
                        <i class="icon-gear mr-2"></i> تنظیمات کاربران
                    </a>
                    <a href="#" class="breadcrumb-item">فهرست کاربران</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-info">
            <h2>فهرست کاربران</h2>
            <a href="#" data-toggle="modal" data-target="#create_user_modal"
                class="btn btn-sm btn-success mt-1 rounded-pill">
                <i class="fa fa-plus-circle"></i>
                ایجاد کاربر
            </a>
        </div>
        <div id="create_user_modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="text-center">
                                    <i id="defaultIcon"
                                        class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                    <img class="rounded-circle mt-2 d-none" id="showImage" width="90px" height="90px"
                                        src="">
                                </div>
                                <h5 class="mb-0">مشخصات کاربر جدید</h5>
                                <span class="d-block text-muted">تمام فیلد ها الزامی میباشد</span>
                            </div>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                <i class="icon-clipboard3 mr-3 icon-1x"></i>
                                مشخصات کاربر جدید
                                <a class="float-right text-default" data-toggle="collapse" data-target="#demo2">
                                    <i class="icon-circle-down2"></i>
                                </a>
                            </legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>اسم <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control" placeholder="اسم" name="name"
                                            value="{{ old('name') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user icon-1x text-muted"></i>
                                        </div>
                                        @error('name')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>تخلص <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control" placeholder="تخلص" name="last_name"
                                            value="{{ old('last_name') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-plus icon-1x text-muted"></i>
                                        </div>
                                        @error('last_name')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>ایمیل <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="email" class="form-control" placeholder="example@email.com"
                                            name="email" value="{{ old('email') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-mailbox icon-1x text-muted"></i>
                                        </div>
                                        @error('email')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>شماره تماس <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="number" class="form-control" placeholder="شماره تماس" name="phone"
                                            value="{{ old('phone') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-mobile icon-1x text-muted"></i>
                                        </div>
                                        @error('phone')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>تصویر</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="file" id="image" class="form-control" name="image"
                                            value="{{ old('image') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-camera icon-1x text-muted"></i>
                                        </div>
                                        @error('image')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>سطح درسترسی (Role) <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <select name="role_id" id="faculty" class="form-control">
                                            <option value="">-- انتخاب (Role) --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('faculty')
                                            <span style="color: red;">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center ">
                                        <label class="mr-3 mb-3">حالت‌ ها <span class="text-danger">*</span></label>
                                        <div
                                            class="form-group form-group-feedback form-group-feedback-right d-flex align-items-center">
                                            <div class="form-check form-check-inline me-2">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="active" value="1"
                                                    {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active">فعال</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inactive" value="0"
                                                    {{ old('status') == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inactive">غیر فعال</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div style="color: red;">* {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <div class="form-check form-switch mb-2">
                                        <input type="checkbox" name="password_status"
                                            class="form-check-input @error('password_status') is-invalid @enderror"
                                            id="customCheckBox3" {{ old('password_status', false) ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2">حالت رمز عبور </label>
                                    </div>
                                    @error('password_status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center mt-2">
                                    <button type="submit"
                                        class="btn bg-info-400 btn-labeled btn-labeled-right rounded-pill">
                                        <b><i class="icon-plus3"></i></b> ثبت معلومات جدید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="edit_user_modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" id="editUserForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <input type="hidden" id="edit_user_id" name="id">
                            <div class="text-center mb-3">
                                <div class="text-center">
                                    <i id="editDefaultIcon"
                                        class="icon-pencil6 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
                                    <img class="rounded-circle mt-2 d-none" id="showEditImage" width="90px"
                                        height="90px" src="">
                                </div>
                                <h5 class="mb-0">تصحیح مشخصات کاربر</h5>
                                <span class="d-block text-muted">تمام فیلد ها الزامی میباشد</span>
                            </div>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                <i class="icon-clipboard3 mr-3 icon-1x"></i>
                                تصحیح مشخصات کاربر
                                <a class="float-right text-default" data-toggle="collapse" data-target="#demo2">
                                    <i class="icon-circle-down2"></i>
                                </a>
                            </legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>اسم <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control" placeholder="اسم" id="name"
                                            name="name" value="{{ old('name') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user icon-1x text-muted"></i>
                                        </div>
                                        @error('name')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>تخلص <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" class="form-control" placeholder="تخلص" name="last_name"
                                            id="last_name" value="{{ old('last_name') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-plus icon-1x text-muted"></i>
                                        </div>
                                        @error('last_name')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>ایمیل <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="email" class="form-control" placeholder="example@email.com"
                                            id="email" name="email" value="{{ old('email') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-mailbox icon-1x text-muted"></i>
                                        </div>
                                        @error('email')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>شماره تماس <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="number" id="phone" class="form-control"
                                            placeholder="شماره تماس" name="phone" value="{{ old('phone') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-mobile icon-1x text-muted"></i>
                                        </div>
                                        @error('phone')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>تصویر</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="file" id="editImage" class="form-control" name="image"
                                            value="{{ old('image') }}">
                                        <div class="form-control-feedback">
                                            <i class="icon-camera icon-1x text-muted"></i>
                                        </div>
                                        @error('image')
                                            <span style="color: red;">* {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>سطح درسترسی (Role) <span class="text-danger">*</span></label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <select name="role_id" id="editRole_id" class="form-control">
                                            <option value="">-- انتخاب (Role) --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('editRole_id')
                                            <span style="color: red;">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center ">
                                        <label class="mr-3 mb-3">حالت‌ ها <span class="text-danger">*</span></label>
                                        <div
                                            class="form-group form-group-feedback form-group-feedback-right d-flex align-items-center">
                                            <div class="form-check form-check-inline me-2">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="active" value="1"
                                                    {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="active">فعال</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="inactive" value="0"
                                                    {{ old('status') == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inactive">غیر فعال</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div style="color: red;">* {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <div class="form-check form-switch mb-2">
                                        <input type="checkbox" name="password_status"
                                            class="form-check-input @error('password_status') is-invalid @enderror"
                                            id="password_status" {{ old('password_status', false) ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2">حالت رمز عبور </label>
                                    </div>
                                    @error('password_status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center mt-2">
                                    <button type="submit"
                                        class="btn bg-info-400 btn-labeled btn-labeled-right rounded-pill">
                                        <b><i class="icon-plus3"></i></b> ثبت معلومات </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const defaultIcon = document.getElementById('defaultIcon');
            const showImage = document.getElementById('showImage');
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    showImage.src = e.target.result;
                    showImage.classList.remove('d-none');
                    defaultIcon.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                showImage.classList.add('d-none');
                defaultIcon.style.display = 'inline-block';
            }
        });
    </script>
    <script>
        $(document).on('click', '.editUserBtn', function() {
            var userId = $(this).data('id');
            $('#edit_user_id').val(userId);

            $.ajax({
                url: '/users/' + userId + '/edit',
                type: 'GET',
                success: function(data) {
                    let roleIds = data.roles.map(role => role.id);

                    $('#name').val(data.name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#editRole_id').val(roleIds).trigger('change');
                    $('input[name="status"][value="' + data.status + '"]').prop('checked', true);

                    if (data.password_change_status == 1) {
                        $('#password_status').prop('checked', true);
                    } else {
                        $('#password_status').prop('checked', false);
                    }

                    if (data.image) {
                        $('#showEditImage').attr('src', "{{ url('/') }}/" + data.image)
                            .removeClass('d-none');
                        $('#editDefaultIcon').addClass('d-none');
                    } else {
                        $('#showEditImage').addClass('d-none');
                        $('#editDefaultIcon').removeClass('d-none');
                    }

                    $('#editUserForm').attr('action', '/users/' + userId);
                },
                error: function() {
                    alert('مشکلی هنگام بارگذاری اطلاعات رخ داد!');
                }
            });
        });

        document.getElementById('editImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const editDefaultIcon = document.getElementById('editDefaultIcon');
            const showImage = document.getElementById('showEditImage');
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    showImage.src = e.target.result;
                    showImage.classList.remove('d-none');
                    editDefaultIcon.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                showImage.classList.add('d-none');
                editDefaultIcon.style.display = 'inline-block';
            }
        });
    </script>
@endsection
