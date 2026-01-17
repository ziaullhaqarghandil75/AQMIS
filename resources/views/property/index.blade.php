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
                            <th>property_Location</th>
                            <th>property_house_Number</th>
                            <th>property_plan_Number</th>
                            <th>property_remarks</th>
                            <th>property_sketch_image</th>
                            <th>property_North</th>
                            <th>property_South</th>
                            <th>property_East</th>
                            <th>property_West</th>
                            <th>property_Parcel_Number</th>
                            <th>property_Code_Number</th>
                            <th>owner_id</th>
                            <th>project_id</th>
                            <th>block_id</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($properties as $property)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $property->property_Location }}</td>
                                <td>{{ $property->property_house_Number }}</td>
                                <td>{{ $property->property_plan_Number }}</td>
                                <td>{{ $property->property_remarks }}</td>
                                <td>{{ $property->property_sketch_image }}</td>
                                <td>{{ $property->property_North }}</td>
                                <td>{{ $property->property_South }}</td>
                                <td>{{ $property->property_East }}</td>
                                <td>{{ $property->property_West }}</td>
                                <td>{{ $property->property_Parcel_Number }}</td>
                                <td>{{ $property->property_Code_Number }}</td>
                                <td>{{ $property->owner_id }}</td>
                                <td>{{ $property->project_id }}</td>
                                <td>{{ $property->block_id }}</td>
                                <td>
                                    <a href="{{ route('properties.edit', $property->id) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('propertiesValue.show', $property->id) }}"
                                        class="btn btn-sm btn-pramary">property value</a>
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
                                        style="display:inline-block;">
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
