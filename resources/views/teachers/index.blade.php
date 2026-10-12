@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Dosen</h2>
    @can('admin')
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Dosen
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>Jurusan</th>
            <th>Spesialisasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($teachers as $i => $teacher)
        <tr>
            <td>{{ $teachers->firstItem() + $i }}</td>
            <td>{{ $teacher->nip }}</td>
            <td>{{ $teacher->user->name }}</td>
            <td>{{ $teacher->department->name }}</td>
            <td>{{ $teacher->specialization ?? '-' }}</td>
            <td>
                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus? Jadwal mengajar dosen ini ikut terhapus.')">
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

{{ $teachers->links() }}
@endsection