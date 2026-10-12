@extends('layouts.app')

@section('title', 'Data Grades')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Grades</h2>
    @can('admin')
    <a href="{{ route('grades.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Grades
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
            <th>Grade Letter</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $grade->student->user->name ?? '-' }}</td>
            <td>{{ $grade->course->name ?? '-' }}</td>
            <td>{{ $grade->academic_year }}</td>
            <td>{{ $grade->grade_letter }}</td>
            <td>
                <a href="{{ route('grades.show', $grade->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                @can('admin')
                <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline">
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
{{ $grades->links() }}
@endsection