@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">افزودن صلاحیت به <b class="text-success">{{ $role->description }}</b></h4>
        </div>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('put')
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">کتگوری</th>
                        <th scope="col">صلاحیت ها</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permission_categories as $key => $permission_category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $permission_category->name }}</td>
                            <td>
                                @foreach ($permission_category->permissions as $permission)
                                    <label class="d-inline-flex align-items-center badge badge-info rounded-round">
                                        {{ $permission->description }}
                                        <input name="permission_id[]" type="checkbox" value="{{ $permission->id }}"
                                            class="form-check-input-styled-success ml-2"
                                            {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                    </label>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-t-20 text-center">
                <button class="btn btn-primary btn-sm rounded-pill submit-btn mb-3">ذخیره معلومات</button>
            </div>
        </form>
    </div>
@endsection
