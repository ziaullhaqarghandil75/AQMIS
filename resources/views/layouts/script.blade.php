{{-- <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/editors/ckeditor/ckeditor.js') }}"></script>
<!-- /core JS files -->
<script src="{{ asset('global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('global_assets/js/plugins/editors/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_pages/dashboard.js') }}"></script>
<!-- /theme JS files -->
<script src="{{ asset('global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_pages/form_layouts.js') }}"></script>
<!-- /theme JS files -->
{{-- start of select2 --}}
<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('global_assets/js/demo_pages/form_select2.js') }}"></script>
{{-- end of select2 --}}
{{-- start of load pdf files --}}
<script src="{{ asset('assets/js/pdf.min.js') }}"></script>
<script pdfjsLib.GlobalWorkerOptions.workerSrc='{{ asset('assets/js/pdf.worker.min.js') }}'></script>
{{-- end of load pdf files --}}
{{-- datatable js file --}}
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
{{-- end of datatable js file --}}
{{-- start of sweet alert --}}
<style>
    .swal2-icon.swal2-warning {
        font-size: 1.5rem !important;
    }
</style>
<script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
<script>
    @php
        $toastType = '';
        $toastMessage = '';
        $bgColor = '';

        if (Session::has('info')) {
            $toastType = 'info';
            $toastMessage = Session::get('info');
            $bgColor = '#17a2b8';
        } elseif (Session::has('warning')) {
            $toastType = 'warning';
            $toastMessage = Session::get('warning');
            $bgColor = '#ff9800';
        } elseif (Session::has('success')) {
            $toastType = 'success';
            $toastMessage = Session::get('success');
            $bgColor = '#28a745';
        } elseif (Session::has('error')) {
            $toastType = 'error';
            $toastMessage = Session::get('error');
            $bgColor = '#dc3545';
        }
    @endphp

    @if ($toastType)
        Swal.fire({
            title: @json($toastMessage),
            icon: @json($toastType),
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            background: @json($bgColor),
            color: '#ffffff',
            customClass: {
                popup: 'custom-toast'
            }
        });
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Swal.fire({
                title: @json($error),
                icon: 'error',
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                background: '#dc3545',
                color: '#ffffff',
                customClass: {
                    popup: 'custom-toast'
                }
            });
        </script>
    @endforeach
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "این عمل قابل بازگشت نیست!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'بلی!',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed && form) {
                    form.submit();
                }
            });
        });
    });
</script>
{{-- end of sweet alert --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // پیدا کردن تمام فیلدهایی که required هستند
        var requiredInputs = document.querySelectorAll('input[required], select[required], textarea[required]');

        // برای هر فیلد required پیام خطای فارسی اضافه می‌کنیم
        requiredInputs.forEach(function(input) {
            input.addEventListener('invalid', function(event) {
                if (input.validity.valueMissing) {
                    input.setCustomValidity('این فیلد الزامی است.');
                }
            });

            input.addEventListener('input', function() {
                input.setCustomValidity(''); // پاک کردن پیام خطا پس از اصلاح
            });
        });
    });
</script>

<script>
    function toaster(toastMessage, toastType, bgColor) {
        Swal.fire({
            title: toastMessage,
            icon: toastType,
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            background: bgColor, // رنگ پس‌زمینه بر اساس نوع نوتیفیکیشن
            color: '#ffffff', // رنگ متن سفید
            customClass: {
                popup: 'custom-toast'
            }
        });
    }
</script>
