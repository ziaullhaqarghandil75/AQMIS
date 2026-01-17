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
                            <th>Project Name</th>
                            <th>Project File</th>
                            <th>GIS File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($propertiesvalues as $propertiesvalue)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $propertyValue->Number_of_Floors }}</td>
                                <td>{{ $propertyValue->Scale }}</td>
                                <td>{{ $propertyValue->emarat_type_id }}</td>
                                <td>{{ $propertyValue->building_category_id }}</td>
                                <td>{{ $propertyValue->land_categories_id }}</td>
                                <td>{{ $propertyValue->property_id }}</td>
                                <td>
                                    <a href="{{ route('propertiesValue.edit', $propertiesvalue->id) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('propertiesValue.destroy', $propertiesvalue->id) }}" method="POST"
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
