@extends('layouts.master')

@push('style')
    <style>
        /* که اړتیا وي دلته CSS اضافه کړئ */
    </style>
@endpush

@section('content')
    <div class="card">

        <div class="card-body">

            <div class="card card-table table-responsive shadow-0 mb-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>building_Category_Type_Name</th>
                            <th>building_Category_details</th>
                            <th>building_Category_unit_type</th>
                            <th>building_Category_unit_Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($building_categories as $building_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $building_category->building_Category_Type_Name }}</td>
                                <td>{{ $building_category->building_Category_details }}</td>
                                <td>{{ $building_category->building_Category_unit_type }}</td>
                                <td>{{ $building_category->building_Category_unit_Price }}</td>
                                <td>
                                    <a href="{{ route('buildingCategory.edit', $building_category->id) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('buildingCategory.destroy', $building_category->id) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // که اړتیا وي دلته JS اضافه کړئ
    </script>
@endpush
