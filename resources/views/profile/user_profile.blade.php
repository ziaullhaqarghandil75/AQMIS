@extends('layouts.master')
@section('content')
        <!-- Page header -->
    <div class="page-header page-header-ligh t">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="#" class="breadcrumb-item">
                        <i class="icon-gear mr-2"></i> پروفایل
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="modal fade" id="edit_property_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h3 class="modal-title mt-2 text-white"><b>تغییر رمز عبور</b></h3>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form action="{{ route('profile_change_password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">رمز عبور قبلی <span class="text-danger">*</span></label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control" placeholder="رمز عبور قبلی" required>
                                    @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">رمز عبور جدید <span class="text-danger">*</span></label>
                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                        placeholder="رمز عبور جدید" required>
                                    @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">تائید رمز عبور جدید <span class="text-danger">*</span></label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                        class="form-control" placeholder="تائید رمز عبور جدید" required>
                                    @error('new_password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-2 text-center">
                                <button type="submit" class="btn bg-primary btn-sm text-white rounded-pill"><i
                                        class="icon-checkmark3 mr-2"></i>تغییر رمز عبور</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="text-center">
                        <div class="profile-photo">
                            <img src="{{ asset($user->img ?? 'images/user.png') }}" style="width: 100px; height: 100px;"
                                class="img-fluid rounded-circle" alt="user-img">
                        </div>
                        <h3 class="mt-4 mb-1"><b>{{ $user->name }} "{{ $user->last_name }}"</b></h3>
                        <p class="text-muted">{{ $user->roles->first()->description }}</p>
                        <p class="text-muted">ایمیل: {{ $user->email }}</p>
                        <p class="text-muted">شماره تماس: {{ $user->phone }}</p>
                        <div class="d-flex gap-2 justify-content-center">
                            @can('reset_password_user')
                                <form action="{{ route('reset_password', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary rounded-pill btn-sm">ریست کردن پسورد</button>
                                </form>
                            @endcan
                            @can('change_password_user')
                                <a href="javascript.void(0)" class="btn btn-outline-primary btn-sm rounded-pill" data-toggle="modal"
                                    data-target="#edit_property_modal">تغیر رمز عبور</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-0 pb-0 text-center">
                    <div class="row">
                        <div class="col-6 pt-2 pb-2">
                            <h4 class="mb-1">حالت</h4>
                            @if ($user->status == '0')
                                <span class="badge badge-danger rounded-pill">غیر فعال</span>
                            @else
                                <span class="badge badge-success rounded-pill">فعال</span>
                            @endif
                        </div>
                        <div class="col-6 pt-2 pb-2 border-end">
                            <h4 class="mb-1">آنلاین/ آفلاین</h4>
                            @if ($user->isOnline())
                                <span class='badge badge-success rounded-pill'> آنلاین</span>
                            @else
                                <span class='badge badge-danger rounded-pill'> آفلاین</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="card-title">تصحیح معلومات</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">نام <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $user->name) }}" placeholder="نام" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">تخلص <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        value="{{ old('last_name', $user->last_name) }}" placeholder="تخلص" required>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">شماره تماس <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" id="phone" class="form-control"
                                        value="{{ old('phone', $user->phone) }}" placeholder="+93 (0) 7xxxxxxxx"
                                        required>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">فایل <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-2 text-center">
                                <button type="submit" class="btn bg-primary btn-sm text-white rounded-pill"><i
                                        class="icon-checkmark3 mr-2"></i>تصحیح معلومات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('srcipt')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const usernameInput = document.querySelector("input[name='username']");
            const lastNameInput = document.querySelector("input[name='last_name']");
            const phoneInput = document.querySelector("input[name='phone']");
            const imgInput = document.querySelector("input[name='img']");

            form.addEventListener("submit", function(event) {
                let isValid = true;

                clearErrors();

                if (usernameInput.value.trim() === "") {
                    showError(usernameInput, "اسم نمی‌تواند خالی باشد.");
                    isValid = false;
                }

                if (phoneInput.value.trim() !== "" && (!/^\d{10,20}$/.test(phoneInput.value.trim()))) {
                    showError(phoneInput, "شماره تماس باید بین 10 تا 20 رقم باشد.");
                    isValid = false;
                }

                if (imgInput.files.length > 0) {
                    const file = imgInput.files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!allowedTypes.includes(file.type)) {
                        showError(imgInput, "فقط فایل‌های تصویری با فرمت‌های jpeg, png, jpg مجاز هستند.");
                        isValid = false;
                    }
                }

                if (!isValid) {
                    event.preventDefault();
                } else {
                    form.submit();
                }
            });


            function showError(input, message) {
                // ایجاد یک عنصر div برای نمایش پیام خطا
                const errorElement = document.createElement('div');
                errorElement.classList.add('text-danger');
                errorElement.textContent = message;

                // بررسی می‌کنیم که آیا پیغام خطا قبلاً زیر این فیلد وجود دارد
                if (!input.parentElement.querySelector('.text-danger')) {
                    const parentDiv = input.closest('.input-group');
                    const errorDiv = document.createElement('div');
                    errorDiv.classList.add('input-group-append');
                    errorDiv.classList.add('col-12');
                    errorDiv.appendChild(errorElement);
                    parentDiv.appendChild(errorDiv);
                }
            }

            function clearErrors() {
                const errorElements = document.querySelectorAll('.text-danger');
                errorElements.forEach(error => error.remove());
            }
        });
    </script>
@endpush
