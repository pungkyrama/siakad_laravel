@extends('layouts.app')

@section('title', 'Data Ruang Kelas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Ruang Kelas</h2>
    @can('admin')
    <a href="{{ route('classrooms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Ruangan
    </a>
    @endcan
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Ruangan</th>
            <th>Gedung</th>
            <th>Kapasitas</th>
            <th>Jumlah Jadwal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($classrooms as $i => $classroom)
        <tr>
            <td>{{ $classrooms->firstItem() + $i }}</td>
            <td>{{ $classroom->name }}</td>
            <td>{{ $classroom->building }}</td>
            <td>{{ $classroom->capacity }} orang</td>
            <td>{{ $classroom->schedules_count }}</td>
            <td>
                <a href="{{ route('classrooms.show', $classroom) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-eye"></i> Detail
                </a>
                @can('admin')
                <a href="{{ route('classrooms.edit', $classroom) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('classrooms.destroy', $classroom) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus? Jadwal di ruangan ini ikut terhapus.')">
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

{{ $classrooms->links() }}
@endsection