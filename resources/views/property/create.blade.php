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
                <form action="{{ route('properties.store') }}" method="POST" id="frmProperties" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">

                        <div class="col-lg-6 mx-lg-auto">
                            <div class="form-group">
                                <label>project</label>
                                <select class="form-control select-search" data-fouc name="project_id" id="project">
                                    <option value="">پروژه وټاکئ</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">
                                            {{ $project->Project_Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mx-lg-auto">
                            <div class="form-group">
                                <label>owner</label>
                                <select class="form-control select-search" data-fouc name="owner_id" id="owner">
                                    <option value="">مالک وټاکئ</option>
                                    @foreach ($owners as $owner)
                                        <option value="{{ $owner->id }}">
                                            {{ $owner->owner_First_Name }} {{ $owner->owner_Father_Name }}
                                            {{ $owner->owner_GFather_Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>District</label>
                                <select class="form-control select-search" data-fouc id="district">
                                    <option value="">ناحیه وټاکئ</option>
                                    @foreach ($disticts as $distict)
                                        <option value="{{ $distict->id }}">
                                            {{ $distict->district_Name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>Guzar</label>
                                <select class="form-control select-search" data-fouc id="guzar">
                                    <option value="">ګوزر وټاکئ</option>
                                    {{-- When a district is selected, all related Guzars are loaded --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>Block</label>
                                <select class="form-control select-search" data-fouc name="block_id" id="block">
                                    <option value="1">بلاک وټاکئ</option>
                                    {{-- When a Guzar is selected, all related Blocks are loaded --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>ParcelNo</label>
                                <input type="text" name="property_Parcel_Number" class="form-control"
                                    placeholder="ParcelNo" value="{{ $property->ParcelNo ?? '' }}">
                            </div>
                        </div>
                        {{-- property --}}
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>property_Location</label>
                                <input type="text" name="property_Location" class="form-control"
                                    placeholder="property_Location" value="{{ $property->property_Location ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2 mx-lg-auto">
                            <div class="form-group">
                                <label>property_house_Number </label>
                                <input type="text" name="property_house_Number" class="form-control"
                                    placeholder="property_house_Number"
                                    value="{{ $property->property_house_Number ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2 mx-lg-auto">
                            <div class="form-group">
                                <label>property_plan_Number</label>
                                <input type="text" name="property_plan_Number" class="form-control"
                                    placeholder="property_plan_Number" value="{{ $property->property_plan_Number ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2 mx-lg-auto">
                            <div class="form-group">
                                <label>Property_Pricing_Date</label>
                                <input type="date" name="Property_Pricing_Date" class="form-control"
                                    placeholder="Property_Pricing_Date"
                                    value="{{ $property->Property_Pricing_Date ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>property_sketch_image</label>
                                <input type="file" name="property_sketch_image" class="form-control"
                                    placeholder="property_sketch_image"
                                    value="{{ $property->property_sketch_image ?? '' }}">
                            </div>
                        </div>

                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>property_North</label>
                                <input type="text" name="property_North" class="form-control"
                                    placeholder="property_North" value="{{ $property->property_North ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2 mx-lg-auto">
                            <div class="form-group">
                                <label>property_South</label>
                                <input type="text" name="property_South" class="form-control"
                                    placeholder="property_South" value="{{ $property->property_South ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2 mx-lg-auto">
                            <div class="form-group">
                                <label>property_East</label>
                                <input type="text" name="property_East" class="form-control" placeholder="property_East"
                                    value="{{ $property->property_East ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-2 mx-lg-auto">
                            <div class="form-group">
                                <label>property_West</label>
                                <input type="text" name="property_West" class="form-control"
                                    placeholder="property_West" value="{{ $property->property_West ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-3 mx-lg-auto">
                            <div class="form-group">
                                <label>property_Code_Number</label>
                                <input type="text" name="property_Code_Number" class="form-control"
                                    placeholder="property_Code_Number"
                                    value="{{ $property->property_Code_Number ?? '' }}">
                            </div>
                        </div>
                        <div class="col-lg-12 mx-lg-auto">
                            <div class="form-group">
                                <label>property_remarks</label>
                                <textarea name="property_remarks" class="form-control" placeholder="property_remarks" rows="7"
                                    value="{{ $property->property_remarks ?? '' }}"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($property) ? 'Update' : 'Create' }} <i class="icon-paperplane ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('script')
    {{--  dependent dropdowns script for guzar, block, zone, land categories --}}
    <script>
        let guzarUrl = "{{ route('dependent.district.guzars', ':id') }}";
        let blockUrl = "{{ route('dependent.guzar.blocks', ':id') }}";
        let ownerUrl = "{{ route('dependent.project.owners', ':id') }}";
        $('#district').on('change', function() {

            let districtId = $(this).val();

            $('#guzar').html('<option value="">— ګذر انتخاب کړئ —</option>');

            if (!districtId) return;

            $.get(guzarUrl.replace(':id', districtId), function(data) {
                $.each(data, function(i, item) {
                    $('#guzar').append(
                        `<option value="${item.id}">${item.guzar_number}</option>`
                    );
                });
            });
        });
        $('#guzar').on('change', function() {

            let guzarId = $(this).val();

            $('#block').html('<option value="">— بلاک انتخاب کړئ —</option>');

            if (!guzarId) return;

            $.get(blockUrl.replace(':id', guzarId), function(data) {
                $.each(data, function(i, item) {
                    $('#block').append(
                        `<option value="${item.id}">${item.block_Number}</option>`
                    );
                });
            });
        });

        $('#project').on('change', function() {

            let projectId = $(this).val();

            $('#owner').html('<option value="">— مالک انتخاب کړئ —</option>');

            if (!projectId) return;

            $.get(ownerUrl.replace(':id', projectId), function(data) {
                console.log(data);

                $.each(data, function(i, item) {
                    $('#owner').append(
                        `<option value="${item.id}">${item.owner_First_Name}-${item.owner_Father_Name}-${item.owner_GFather_Name}</option>`
                    );
                });
            });
        });
    </script>
@endpush
