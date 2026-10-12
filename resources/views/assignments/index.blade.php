@extends('layouts.app')

@section('title', 'Data Assignments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Assignments</h2>
    @can('admin')
    <a href="{{ route('assignments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Assignments
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Course</th>
            <th>Judul</th>
            <th>Due Date</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assignments as $assignment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $assignment->course->name ?? '-' }}</td>
            <td>{{ $assignment->title }}</td>
            <td>{{ $assignment->due_date ? $assignment->due_date->format('Y-m-d H:i') : '' }}</td>
            <td>
                <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                @can('admin')
                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" class="d-inline">
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
{{ $assignments->links() }}
@endsection