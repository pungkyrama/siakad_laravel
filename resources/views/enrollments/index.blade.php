@extends('layouts.app')

@section('title', 'Data Enrollments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Enrollments</h2>
    @can('admin')
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Enrollments
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Course</th>
            <th>Tahun Ajaran</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrollments as $enrollment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $enrollment->student->user->name ?? '-' }}</td>
            <td>{{ $enrollment->course->name ?? '-' }}</td>
            <td>{{ $enrollment->academic_year }}</td>
            <td>{{ $enrollment->semester }}</td>
            <td>{{ $enrollment->status }}</td>
            <td>
                <a href="{{ route('enrollments.show', $enrollment->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                @can('admin')
                <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $enrollments->links() }}
@endsection