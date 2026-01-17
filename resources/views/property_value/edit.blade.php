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
                <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-10 mx-lg-auto">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" name="Project_Name" class="form-control" placeholder="Project Name"
                                    value="{{ $project->Project_Name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label>Project File</label>
                                <input type="file" name="Project_File_Path" class="form-control">
                                @if (isset($project) && $project->Project_File_Path)
                                    <a href="{{ asset($project->Project_File_Path) }}" target="_blank">View File</a>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>GIS Shape File</label>
                                <input type="file" name="Project_GIS_Shape_File_Path" class="form-control">
                                @if (isset($project) && $project->Project_GIS_Shape_File_Path)
                                    <a href="{{ asset($project->Project_GIS_Shape_File_Path) }}" target="_blank">View GIS
                                        File</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($project) ? 'Update' : 'Create' }} <i class="icon-paperplane ml-2"></i>
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
