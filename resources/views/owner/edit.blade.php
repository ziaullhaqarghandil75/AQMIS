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
                <form action="{{ route('owners.update', $owner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-10 mx-lg-auto">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="owner_First_Name" class="form-control" placeholder="First Name"
                                    value="{{ $owner->owner_First_Name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Father Name</label>
                                <input type="text" name="owner_Father_Name" class="form-control"
                                    placeholder="Father Name" value="{{ $owner->owner_Father_Name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Grandfather Name</label>
                                <input type="text" name="owner_GFather_Name" class="form-control"
                                    placeholder="Grandfather Name" value="{{ $owner->owner_GFather_Name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Tazkira Number</label>
                                <input type="number" name="owner_tazkira_Number" class="form-control"
                                    placeholder="Tazkira Number" value="{{ $owner->owner_tazkira_Number ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($owner) ? 'Update' : 'Create' }} <i class="icon-paperplane ml-2"></i>
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
