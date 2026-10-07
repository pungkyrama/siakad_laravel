@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Jurusan</h2>
    @can('admin')
    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jurusan
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Jurusan</th>
            <th>Jumlah Dosen</th>
            <th>Jumlah Mahasiswa</th>
            <th>Jumlah Mata Kuliah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($departments as $i => $dept)
        <tr>
            <td>{{ $departments->firstItem() + $i }}</td>
            <td><span class="badge bg-secondary">{{ $dept->code }}</span></td>
            <td>{{ $dept->name }}</td>
            <td>{{ $dept->teachers_count }}</td>
            <td>{{ $dept->students_count }}</td>
            <td>{{ $dept->courses_count }}</td>
            <td>
                <a href="{{ route('departments.show', $dept) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('departments.edit', $dept) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('departments.destroy', $dept) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus?')">
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
            <td colspan="7" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $departments->links() }}
@endsection