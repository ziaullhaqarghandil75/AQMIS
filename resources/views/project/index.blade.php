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
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project->Project_Name }}</td>
                                <td>
                                    @if ($project->Project_File_Path)
                                        <a href="{{ asset($project->Project_File_Path) }}" target="_blank">PDF</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($project->Project_GIS_Shape_File_Path)
                                        <a href="{{ asset($project->Project_GIS_Shape_File_Path) }}" target="_blank">GIS</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
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
