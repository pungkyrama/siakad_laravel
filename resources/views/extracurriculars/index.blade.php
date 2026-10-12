@extends('layouts.app')

@section('title', 'Data Ekstrakurikuler')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Ekstrakurikuler</h2>
    @can('admin')
    <a href="{{ route('extracurriculars.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Ekstrakurikuler
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Anggota</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($extracurriculars as $i => $extracurricular)
        <tr>
            <td>{{ $extracurriculars->firstItem() + $i }}</td>
            <td>{{ $extracurricular->name }}</td>
            <td>{{ Str::limit($extracurricular->description ?? '-', 50) }}</td>
            <td>{{ $extracurricular->students_count }} / {{ $extracurricular->max_members }}</td>
            <td>
                <a href="{{ route('extracurriculars.show', $extracurricular) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('extracurriculars.edit', $extracurricular) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('extracurriculars.destroy', $extracurricular) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus ekstrakurikuler ini?')">
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
            <td colspan="5" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $extracurriculars->links() }}
@endsection