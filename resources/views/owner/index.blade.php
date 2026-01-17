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
                            <th>owner Name</th>
                            <th>Project File</th>
                            <th>GIS File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($owners as $owner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $owner->owner_First_Name }}</td>
                                <td>{{ $owner->owner_Father_Name }}</td>
                                <td>{{ $owner->owner_GFather_Name }}</td>
                                <td>{{ $owner->owner_tazkira_Number }}</td>
                                <td>
                                    <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('owners.destroy', $owner->id) }}" method="POST"
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
