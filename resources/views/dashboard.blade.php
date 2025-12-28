@extends('layouts.master')
@section('content')
    <div class="page-header page-header-light">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex justify-content-between align-items-center w-100" style="direction: rtl;">
                <nav aria-label="breadcrumb" class="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}"><i class="icon-home2 mr-2"></i> داشبورد</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
