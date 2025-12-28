<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KM System</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">

<!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />-->

<!-- Global stylesheets -->
<link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">

<!-- Icon stylesheets -->
<link href="{{ asset('global_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('global_assets/css/icons/material/styles.min.css') }}" rel="stylesheet" type="text/css">

<!-- DataTables stylesheet -->
<link href="{{ asset('assets/css/dataTables.dataTables.css') }}" rel="stylesheet" type="text/css">

{{-- <!-- Custom stylesheets -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- External stylesheets --> --}}

{{-- start of kamaDatepicker --}}
<link href="{{ asset('assets/kamaDatepicker/date1/kamadatepicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/kamaDatepicker/date1/kamadatepicker.min.js') }}"></script>
<script src="{{ asset('assets/kamaDatepicker/date1/kamadatepicker.js') }}"></script>
{{-- end of kamaDatepicker --}}
{{-- start of sweet alert --}}
<link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
{{-- end of sweet alert --}}
<style>
    @media print {
        body {
            direction: rtl;
            text-align: right;
            padding: 10px;
        }

        table {
            direction: rtl;

        }

        th,
        td {
            text-align: right;

        }
        table,tr,th {
            font-size: 12px;
            background: #1299d8 !important;
            color: rgb(0, 0, 0) !important;
        }
    }
</style>

