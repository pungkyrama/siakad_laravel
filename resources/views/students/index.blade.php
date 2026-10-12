@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Mahasiswa</h2>
    @can('admin')
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Jurusan</th>
            <th>Semester</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $i => $student)
        <tr>
            <td>{{ $students->firstItem() + $i }}</td>
            <td>{{ $student->nim }}</td>
            <td>{{ $student->user->name }}</td>
            <td>{{ $student->department->name }}</td>
            <td>{{ $student->semester }}</td>
            <td>
                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus? Data KRS, tugas, dan nilai mahasiswa ini ikut terhapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
                @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $students->links() }}
@endsection