@extends('layouts.master')

@push('style')
    <style>
        /* که اړتیا وي دلته CSS اضافه کړئ */
    </style>
@endpush

@section('content')
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <!-- Create / Update Form -->
                <form action="{{ route('buildingCategory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-10 mx-lg-auto">
                            <div class="form-group">
                                <label>building_Category_Type_Name</label>
                                <input type="text" name="building_Category_Type_Name" class="form-control"
                                    placeholder="building_Category_Type_Name"
                                    value="{{ $buildingCategory->building_Category_Type_Name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>building_Category_details</label>
                                <input type="text" name="building_Category_details" class="form-control"
                                    placeholder="building_Category_details"
                                    value="{{ $buildingCategory->building_Category_details ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>building_Category_unit_type</label>
                                <input type="text" name="building_Category_unit_type" class="form-control"
                                    placeholder="building_Category_unit_type"
                                    value="{{ $buildingCategory->building_Category_unit_type ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>building_Category_unit_Price</label>
                                <input type="text" name="building_Category_unit_Price" class="form-control"
                                    placeholder="building_Category_unit_Price"
                                    value="{{ $buildingCategory->building_Category_unit_Pricee ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($buildingCategory) ? 'Update' : 'Create' }} <i class="icon-paperplane ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // که اړتیا وي دلته JS اضافه کړئ
    </script>
@endpush
